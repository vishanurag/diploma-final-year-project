<?php
include('./components/email-credentials.php');
include('./components/email.php');
include('./components/dbconn.php');

session_start();
if(isset($_SESSION['email'])) {
  header('Location: ./profile.php');
  return;
} else {
  session_destroy();
}
$wrongData = false;

if(isPost() && isset($_POST['which']) && isset($_POST['email']) && ($_POST['which'] == 'send-otp')) {

    $email = $_POST['email'];
    
    if(count(getUserDetails($conn, $email))) {
        $otp = getOtp();
        sendOTPforForgetPassword($conn, $email, $otp);
    } else {
        $wrongData = true;
    }
}
if(isset($_GET['task']) && isset($_GET['email']) && isset($_GET['otp'])) {
    $isValid = false;
     $email = $_GET['email'];
     $otp = $_GET['otp'];
     $sql = "SELECT * FROM `password_otps` WHERE `email` = '$email' AND `otp` = '$otp';";
     $res = $conn->query($sql);
     while ($row = $res->fetch_assoc()) {
        $isValid = true;
        break;
     }
     if($isValid && isPost() && isset($_POST['new-password'])) {
        $newPassword = md5($_POST['new-password']);
        $sql = "DELETE FROM `password_otps` WHERE `email` = '$email' AND `otp` = '$otp';";
        $conn->query($sql);

        $updatePassword = "UPDATE `login_data` SET `password` = '$newPassword' WHERE `email` = '$email';";
        $res = $conn->query($updatePassword);
        header('location: ./sign-in.php');
        return;
     } else {
        // header('location: ./');
     }
    //  echo $isValid;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password? Reset it...</title>
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
<?php include('./components/header.php'); ?>

<section class="vh-80" >
        <div class="container py-5 h-100">
           <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-12 col-md-8 col-lg-6 col-xl-5 d-flex align-items-center justify-content-center ">
                   <div class="card shado-2-strong shadow rounded sign-in-up-box " >
                       <div class="card-body px-3 py-5 " >

                           <h3 class="mb-5" > Forgot Password... </h3>
                            <form action="" method="post">
<?php
if(isset($isValid)) {
    // echo "fssdf";
?>
                        <div class="form-outline mb-2">
                            <input type="password" id="typeEmailaddressX-2" name="new-password" required placeholder="Password" class="form-control form-control-lg">
                            <label class="form-label" for="typeEmailaddressX-2"></label>
                        </div>
                        <div class="form-outline mb-2">
                            <input type="password" id="typeEmailaddressX-2" name="confirm-password" required placeholder="Confirm Password" class="form-control form-control-lg">
                            <label class="form-label" for="typeEmailaddressX-2"></label>
                        </div>
                        <input type="text" value="reset-password" name="task" class="d-none" required>
                        <button class="btn btn-primary btn-lg btn-block w-100" type="submit" > Update  Password </button> <br>

<?php
} else {
?>

                            <div class="form-outline mb-2">
                                <input type="email" id="typeEmailaddressX-2" name="email" required placeholder="Email address" class="form-control form-control-lg">
                                <label class="form-label" for="typeEmailaddressX-2"></label>
                            </div>
                            <input type="text" value="send-otp" name="which" class="d-none" required>

                            <button class="btn btn-primary btn-lg btn-block w-100" type="submit" > Reset Password </button> <br>
                            <span class="text-danger <?php echo ($wrongData == true)? '': 'd-none'; ?>" >
                            User doesn't exists...
                           </span>    
                            <span class="text-success <?php echo ($wrongData == false && isPost())? '': 'd-none'; ?>" >
                            Password Reset link has been sent...
                           </span>    
<?php
}
?>
                        </form>
                            
                           <h6 class="mb-2 " >Already know password? <a href="./sign-in.php">Sign In</a></h6>
                           <h6 class="mb-2 " >Don't have account? <a href="./sign-up.php">Sign Up</a></h6>
                       </div>
                   </div>
               </div>
           </div>
        </div>
       </section>

<?php include('./components/footer.php'); ?>
<script src="./src/bootstrap/js/bootstrap.bundle.min.js" defer ></script>
</body>
</html>