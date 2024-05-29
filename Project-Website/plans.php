<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing of Tokens</title>
        <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
<?php include('./components/header.php'); ?>
<div class="container my-3 d-flex align-items-center justify-content-center">
    <div class="pnal-boxes-deatils w-md-40 p-3 shadow border rounded my-3">
        <div class="h3">Token Plan</div>
        <h2 class="h2">
            <span class="text-danger">
            1 Token 🪙
            </span> = 
            <span class="text-success">
            ₹ 20 💵
            </span>
            <br>
            <span class="text-danger">
                1 Token 🪙
            </span> = 
            <span class="text-info">
                1 Website 💻
            </span>
            <div class="small fs-6 ">
                You can buy upto 5 Tokens at a time. The price will be calculated according to the no. of tokens you buy.
            </div>
            <a href="./pay.php" class="btn btn-success my-3 w-100 ">Buy Tokens</a>
        </h2>
    </div>
</div>
<?php include('./components/footer.php'); ?>


<script src="./src/bootstrap/js/bootstrap.bundle.min.js" defer ></script>
</body>
</html>