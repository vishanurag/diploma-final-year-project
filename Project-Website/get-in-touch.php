<?php
// error_reporting(false);
include('./components/email-credentials.php');
include('./components/email.php');
include('./components/dbconn.php');

if(isPost() && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message']) && isset($_POST['which']) && ($_POST['which'] == 'get-in-touch')) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $data = array(
        'name'=> $name,
        'email'=> $email,
        'message'=> $message
    );
    // return;
    
    try {
        sendEmail('get-in-touch', $data, $email);
        sendEmail('get-in-touch', $data, $GLOBALS['hostEmail']);
        echo '<span class="text-success">Success</span>';
    } catch (\Throwable $th) {
        echo '<span class="text-danger">Failed</span>';
    }
} else {
    echo '<span class="text-danger">Failed</span>';
}
?>