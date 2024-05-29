<?php
// error_reporting(false);
date_default_timezone_set('Asia/Kolkata');
// echo date('H:i:s');
try {
    $conn = new mysqli('localhost', 'root', '', 'ai_web_builder');
} catch (\Throwable $th) {
    echo "Oops! Something went wrong with server...";
    return;
}

$serverPath = 'http://localhost'. $_SERVER['PHP_SELF'];
$websitePath = 'http://localhost/diploma-final-year-project/Project-Website/';

function getUserDetails($conn, $email) {
    $sql_Q = "SELECT * FROM `user_data` WHERE `email` = '".$email."' ;";
    $res = $conn->query($sql_Q);
    while($row = $res->fetch_assoc()) {
        return $row;
    }
    return array();
}

function getAllGeneratedWebsites($conn, $email) {
    $sql = "SELECT * FROM `generated_websites` WHERE `user_id` = '$email';";
    return ($conn->query($sql));
}
function getCredits($conn, $val, $email) {
    $sql_Q = "UPDATE `user_data` SET `tokens` =  ((SELECT `tokens` FROM `user_data` WHERE `email` = '".$email."' ) + ".$val.") WHERE `email` = '".$email."' ;";
    $res = $conn->query($sql_Q);
}

function isPost() {
    return (($_SERVER['REQUEST_METHOD'] == 'POST')? true: false);
}



// Email functions...
function sendEmail($task, $otp, $email) {
    $message = "";
    // print_r($otp['name']);
    if($task == 'reset-password') {
        $subject = "Reset Password";
        $resetLink = $GLOBALS['serverPath']."?task=reset-password&otp=".$otp."&email=".$email;
        
        
        $message = "Here is the link to reset your password...<br><br><a class='btn' style='color: white !important;' href='".$resetLink."'>Reset Password</a><br><br>If you are not able to click the button above then use this url...<br>".$resetLink;
    } else if($task == 'get-in-touch') {
        $subject = "Get in touch";
        $name = $otp['name'];
        $userEmail = $otp['email'];
        $userMessage = $otp['message'];
        $message = "Hello, ".$name."(".$userEmail.")! <br><br> We have received this<br><br><b>Message: </b>".$userMessage."<br><hr>";
    } else if($task == 'send-otp') {
        $subject = "OTP for Payment!";
        $message = "Hello, ".$email."! <br><br> Your opt for the transaction of tokens is<br><br>OTP: <b>".$otp."</b><br><hr>";
    }


    $emailBody = (string) "<!DOCTYPEhtml><html><head><style>#body{width: 100%; min-height: 200px; border-radius: 5px; border: 2px dashed blue; padding: 5px;} .btn{padding: 5px 10px; background-color: blue; border-radius: 8px; color: white !important; margin: 15px 0; text-decoration: none;}</style></head> <body><div id='body'><h1>DiAIGen...</h1><br>".$message."<h3>ANURAG VISHWAKARMA<br>Lead Developer @DiAIGen...<br><br></h3><sapn>A final year project developed by Anurag Vishwakarma, Anuj Gupta & Aditya Bhist in the guidance of Dr. Saurabh Kare.<br><br><br></span></div></body></html>";
    // echo $emailBody;
    try {
        sendMail($email, $subject, $emailBody);
    } catch (\Throwable $th) {
        // echo "not sent";
    }
}


function getOtp() {
    return ((string) rand(100000, 999999));
}
function sendOTPforForgetPassword($conn, $email, $otp) {
    $sql = "DELETE FROM `password_otps` WHERE `email` = '$email' ;";
    $res = $conn->query($sql);
    $sql = "INSERT INTO `password_otps`(`otp`, `email`) VALUES ('$otp','$email');";
    $res = $conn->query($sql);

    sendEmail('reset-password', $otp, $email);
}
// Email functions...




// FUNCTIONS FOR STORING THE DATA OF AI GENERATED WEBSITES... START
function notAlreadyExists($conn, $pagename) {
    $sql_Q = "SELECT `page_id` FROM `".$_POST['brandName']."` WHERE `page_id` = '".$pagename."';";
    $res = $conn->query($sql_Q);
    while($row = $res->fetch_assoc()) {
        return false;
    }
    return true;
}

function storeDataInDB($conn, $pagename, $textdata) {
    if(notAlreadyExists($conn, $pagename)) {
        $ins_Q = "INSERT INTO `".$_POST['brandName']."` (`page_id`, `page_heading`, `page_description`) VALUES ('".$pagename."','".$pagename."','".$textdata."');";
        $conn->query($ins_Q);
    }
}

function storeImagelinkInDB($conn, $pagename, $textdata) {
    $image_data = file_get_contents($textdata);
    // echo $image_data;
    $image_url = "./assets/images/name-".$pagename."-id".$_POST['brandName'].".png";
    $image_url_store = "../../dist/assets/images/name-".$pagename."-id".$_POST['brandName'].".png";
    $ins_Q = "UPDATE `".$_POST['brandName']."` SET `hero_image`='".$image_url."' WHERE `page_id` = '".$pagename."';";
    // $image_Q = "INSERT INTO `images_data`(`id`, `data`, `name`) VALUES ('".$_POST['brandName']."', '".$image_data."', '".$pagename."');";
    $conn->query($ins_Q);
    $x = file_put_contents($image_url_store, $image_data);
    // $conn->query($image_Q);
}

function storeGeneratedWebsiteInRecord($conn, $webName, $webURL, $email) {
    $sql = "INSERT INTO `generated_websites`(`website_name`, `website_url`, `user_id`) VALUES ('$webName','$webURL','$email');";
    $res = $conn->query($sql);
}
// FUNCTIONS FOR STORING THE DATA OF AI GENERATED WEBSITES... END

?>