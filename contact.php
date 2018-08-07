<?php

// Email address verification
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if($_POST) {

    // Enter the email where you want to receive the message
    $emailTo = 'ahmed.nadd@outlook.com';

    $name = addslashes(trim($_POST['name']));
    $phone = addslashes(trim($_POST['phone']));
    $message = addslashes(trim($_POST['message']));
    $clientEmail = addslashes(trim($_POST['email']));
    
    $array = array('nameMessage' => '', 'phoneMessage' => '', 'messageMessage' => '', 'emailMessage' => '');

    if($name == '') {
        $array['nameMessage'] = 'Empty name!';
    }
    if($phone == '') {
        $array['phoneMessage'] = 'Empty phone!';
    }
    if($message == '') {
        $array['messageMessage'] = 'Empty message!';
    }
    if($isEmail($clientEmail)) {
        $array['emailMessage'] = 'Invalid email!';
    }
    if(isEmail($clientEmail) && $name != '' && $phone != '' && $message != '') {
        // Send email
		$headers = "From: " . $clientEmail . " <" . $clientEmail . ">" . "\r\n" . "Reply-To: " . $clientEmail;
		mail($emailTo, $name, $phone . " (bootstrap contact form)", $message, $headers);
    }

    echo json_encode($array);

}

?>
