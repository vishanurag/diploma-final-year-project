<?php
include('./components/dbconn.php');
$wrongData = false;

    session_start();
    if(isset($_SESSION['email'])) {
      header('Location: ./');
    } else {
      session_destroy();
    }

    // Validating the user login details...
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['email'])  && isset($_POST['password'])) {

      $checkUserExesits_Q = "SELECT * FROM `login_data` WHERE `email` = '".$_POST['email']."';";
      $userExesists_Res = $conn->query($checkUserExesits_Q);
      $user_Row = $userExesists_Res->fetch_assoc();
      if(isset($user_Row)) {
        
        if($user_Row['email'] == $_POST['email'] && md5($_POST['password']) == $user_Row['password']) {
            include "./components/start-session.php";
            header('Location: ./profile.php');
        } else {
            $wrongData = true;
        }
      } else {
          $wrongData = true;
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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

                           <h3 class="mb-5" > Please Sign In... </h3>
                            <form action="" method="post">

                                <div class="form-outline mb-2">
                                    <input type="email" id="typeEmailaddressX-2" name="email" required placeholder="Email address" class="form-control form-control-lg">
                                    <label class="form-label" for="typeEmailaddressX-2"></label>
                                </div>

                                <div class="form-outline mb-1">
                                    <input type="password" id="typePasswordX-2" name="password" required placeholder="Password" class="form-control form-control-lg">
                                    <label class="form-label" for="typePasswordX-2"></label>
                           </div>

                           <div class="form-check d-flex justify-content-start mb-4">
                               <input class="form-check-input" type="checkbox" value="" id="form1Example3">
                               <label class="form-check-label" for="form1Example3" style="color: black;"> Remember me </label>
                            </div>
                            
                            <button class="btn btn-primary btn-lg btn-block w-100" type="submit" > Sign in </button> <br>
                            <span class="text-danger <?php echo ($wrongData == true)? '': 'd-none'; ?>" >
                            Invalid Login Credentials...
                           </span>    
                        </form>
                            
                           <h6 class="mb-2 " >Forgot Password? <a href="./forgot-password.php">Reset Password</a></h6>
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