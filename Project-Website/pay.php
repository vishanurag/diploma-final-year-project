<?php
include('./components/check-session.php');
include('./components/dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
        <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./src/css/style.css">
    </head>
<body>
    <?php include('./components/header.php'); ?>
    <div class="container">
        <div class="p-5 my-5 border border-success rounded">
            <?php
            if(isset($_POST['submit'])) {
                getCredits($conn, $_POST['credits'], $_SESSION['email']);
            ?>
                <div action="" class="d-flex flex-column align-items-center justify-content-center w-100">
                <img class=" rounded-circle" width="200" height="200" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8Ac_cMZEYU9h76yMxdTFowdENWCfi18oYPg&usqp=CAU">
                <div class="text-success fw-bold fs-3">Success</div>
                </div>
                <?php
            } else {
                ?>
                
                <form action="./razorpay.php" method="GET" class="d-flex w-100">
                    <input type="text" name="token-no" value="<?php echo md5(rand(20, 1200)); ?>" class="d-none">
                    <input type="number" name="credits" class="form-control form-control-lg" placeholder="How many tokens???" min="1" required max="5">
                    <button type="submit" name="submit" value="get-credits" class="btn btn-success w-25 mx-2">Get Tokens</button>
            </form>
            <?php
            }
            ?>

        </div>
    </div>
    <?php include('./components/footer.php'); ?>

    <script src="./src/bootstrap/js/bootstrap.bundle.min.js" defer ></script>
</body>
</html>