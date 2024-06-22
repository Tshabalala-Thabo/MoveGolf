<?php
// Tell Payfast that this page is reachable by triggering a header 200
header( 'HTTP/1.0 200 OK' );
flush();

define( 'SANDBOX_MODE', true );
$pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
// Posted variables from ITN
$pfData = $_POST;



/*$data2 = $_POST;
$file = "data.txt";

$fp = fopen($file, "w") or die("Couldn't open $file for writing!");
fwrite($fp, $data2) or die("Couldn't write values to file!");

fclose($fp);*/


// Strip any slashes in data
foreach( $pfData as $key => $val ) {
    $pfData[$key] = stripslashes( $val );
}

// Convert posted variables to a string
foreach( $pfData as $key => $val ) {
    if( $key !== 'signature' ) {
        $pfParamString .= $key .'='. urlencode( $val ) .'&';
    } else {
        break;
    }
}

$pfParamString = substr( $pfParamString, 0, -1 );


//signature check
function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = "jt7NOE43FZPn" ) {
    // Calculate security signature
    if($pfPassphrase === null) {
        $tempParamString = $pfParamString;
    } else {
        $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
    }

    $signature = md5( $tempParamString );
    return ( $pfData['signature'] === $signature );
}


//validate IP
function pfValidIP() {
    // Variable initialization
    $validHosts = array(
        'www.payfast.co.za',
        'sandbox.payfast.co.za',
        'w1w.payfast.co.za',
        'w2w.payfast.co.za',
        );

    $validIps = [];

    foreach( $validHosts as $pfHostname ) {
        $ips = gethostbynamel( $pfHostname );

        if( $ips !== false )
            $validIps = array_merge( $validIps, $ips );
    }

    // Remove duplicates
    $validIps = array_unique( $validIps );
    $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
    if( in_array( $referrerIp, $validIps, true ) ) {
        return true;
    }
    return false;
}

//compare payment data
function pfValidPaymentData( $cartTotal, $pfData ) {
    return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
}

//Perform a server request to confirm the details
function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
    // Use cURL (if available)
    if( in_array( 'curl', get_loaded_extensions(), true ) ) {
        // Variable initialization
        $url = 'https://'. $pfHost .'/eng/query/validate';

        // Create default cURL object
        $ch = curl_init();
    
        // Set cURL options - Use curl_setopt for greater PHP compatibility
        // Base settings
        curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
        curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
        
        // Standard settings
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
        if( !empty( $pfProxy ) )
            curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
    
        // Execute cURL
        $response = curl_exec( $ch );
        curl_close( $ch );
        if ($response === 'VALID') {
            return true;
        }
    }
    return false;
}

//create logs file
$myFile = fopen('notify.txt', 'a') or die();

// Bringing the checks together
$check1 = pfValidSignature($pfData, $pfParamString);
$check1 ? fwrite($myFile, "Is a valid signature\n"): (fwrite($myFile, "Is not a valid signature\n"));
$check2 = pfValidIP();
$check2 ? fwrite($myFile, "Is a valid IP\n"): (fwrite($myFile, "Is not a valid IP\n"));
$check3 = pfValidPaymentData("10.00", $pfData);
$check3 ? fwrite($myFile, "Is a valid Data\n"): (fwrite($myFile, "Is not a valid Data\n"));
$check4 = pfValidServerConfirmation($pfParamString, $pfHost);
$check4 ? fwrite($myFile, "Is a valid confirmation\n"): (fwrite($myFile, "Is not a valid confirmation\n"));

if($check1 && $check2 && $check3 && $check4) {
    // All checks have passed, the payment is successful
    fwrite($myFile, "All checks have passed, the payment is successful 7\n");  
} else {
    // Some checks have failed, check payment manually and log for investigation
    fwrite($myFile, " Some checks have failed, check payment manually and log for investigation 7\n");
} 

$email = $_POST['email_address'];
$id = $_POST['m_payment_id'];

date_default_timezone_set('Africa/Johannesburg');
$datetime = '2024-05-26 12:30:00';
$timestamp = strtotime($datetime);
fwrite($myFile,date('Y-m-d H:i:s', $timestamp));

fwrite($myFile, "email: ". $email);
fwrite($myFile, "\nuser id: ".$id);

try {
    $db_name = 'mysql:host=localhost;dbname=movegolf_db';
    $user_name = 'movegolf_db';
    $user_password = 'Y5PPd2DwsqVWky8YR2TN';
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $check_cart = $conn->prepare("SELECT * FROM `cart`, `users` WHERE user_id = ? AND user_id = users.id");
    $check_cart->execute([$id]);

    if ($check_cart->rowCount() > 0) {
    $row = $check_cart->fetch(PDO::FETCH_ASSOC);
    $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, payment_status) VALUES(?,?,?,?,?,?,?,?,?)");
    $insert_order->execute([$id, $row['name'], $row['phone'], $email, "Online", $row['address'], $_POST['item_name'], $_POST['amount_gross'], "confirmed"]);

    // Check if the order was successfully inserted
    if ($insert_order->rowCount() > 0) {
        // If the order is inserted successfully, delete the cart
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$id]);

        fwrite($myFile, "Order placed successfully!\n");
    } else {
        fwrite($myFile, "Failed to insert order!\n");
    }
} else {
    fwrite($myFile, "Cart is empty\n<<<<<<<<<<<End of transaction\n\n");
}
} catch (PDOException $e) {
    // Handle PDOException
    $error_message = "Error: " . $e->getMessage();
    // Open the file for appending
    $myFile = fopen("error_log.txt", "a");
    // Write the error message to the file
    fwrite($myFile, $error_message . "\n");
    // Close the file
    fclose($myFile);
}
