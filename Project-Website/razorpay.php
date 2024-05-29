<?php
include('./components/check-session.php');
include('./components/email-credentials.php');
include('./components/email.php');
include('./components/dbconn.php');

if(!isset($_GET['submit']) || !isset($_GET['credits'])) {
    header('Location: ./');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razor Pay - Payment API</title>
    <link rel="shortcut icon" href="https://blog.razorpay.in/blog-content/uploads/2020/10/rzp-glyph-positive.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
            font-weight: 400;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gateway {
            border: 2px solid #ebebeb;
            border-radius: 10px;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
        }

        .header {
            background-color: #045BF2;
            color: #fff;
            gap: 1.5rem;
            padding: 20px 20px 0;
            border-radius: 10px 10px 0 0;
        }

        h3 {
            font-weight: 600;
        }

        span {
            color: #444447;
            font-weight: 500;
            font-size: 1rem;
        }

        p {
            color: #444447;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .header p {
            background-color: #296CF2;
            margin-top: 5px;
            padding: 3px;
            color: #fff;
            font-size: .85rem;
        }

        .cardPay,
        .upiPay {
            margin: 20px 0;
            padding-inline: 15px;
        }

        .cardComponent,
        .upiComponent {
            border: 2px solid #e8e8e8;
            padding-inline: 20px;
            margin-top: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .cardComponent div,
        .upiComponent div {
            gap: 10px;
        }

        .fa-angle-right {
            align-self: center;
        }

        .footer {
            margin-top: 8rem;
        }

        .secured {
            align-items: center;
            padding-inline: 15px;
            background-image: linear-gradient(to bottom, #fefeff, #f6f6f7, #eeeeef, #e7e7e7, #dfdfdf);
            box-shadow: inset 0px 10px 2px 0px rgba(240, 239, 243, 1);
        }

        .secured p {
            font-size: .95rem;
        }

        .fade {
            align-items: center;
        }

        .fade img {
            width: 100px;
        }

        .pay {
            padding: 20px;
        }

        .bill {
            font-weight: 600;
            color: #000;
        }

        #viewDetails {
            font-size: .7rem;
            color: #757577;
            margin-top: 5px;
        }

        button {
            background-image: linear-gradient(to bottom, #256af6, #0655dc);
            border-radius: 8px;
            font-family: Arial;
            color: #ffffff;
            font-size: 18px;
            padding: 15px 40px 15px 40px;
            text-decoration: none;
            border: none;
        }

        button:hover {
            background-image: linear-gradient(to bottom, #2966e2, #0049c0);
            text-decoration: none;
        }
    </style>
</head>

<body>
<?php
if(isPost() && isset($_POST['submit']) && ($_POST['submit'] == 'get-otp')) {
    $email = $_SESSION['email'];
    $otp = (string)rand(1000, 9999);
    sendEmail('send-otp', $otp, $email);

?>
<form class="gateway p-3 shadow" action="./pay.php" method="POST">
    <h2>Verify OTP</h2>
    <input type="text" required name="otp" class="form-control form-control-lg my-3">
    <input type="number" name="credits" value="<?php echo ($_GET['credits']); ?>" class="d-none">
    <button type="submit" name="submit" >Verify</button>
</form>
<?php
} else {
?>
    <section class="gateway">
        <div class="header d-flex">
            <img src="./src/assets/images/di-ai-gen-logo.png" width="40px" height="50px" alt="projectLogo">
            <div>
                <h3>DiAIGen...</h3>
                <p><i class="fa-solid fa-shield" style="color: #69df95;"></i> Rozaypay Trusted Bussiness <i
                        class="fa-solid fa-circle-info"></i></p>
            </div>
        </div>

        <div class="cardPay" onclick="showCard()">
            <h3>Pay Via Card</h3>
            <div class="cardComponent d-flex">
                <div class="d-flex">
                    <i class="fa-solid fa-credit-card" style="color: #1149aa;"></i>
                    <p>Pay using Card <br> <span>All card Supported</span></p>
                </div>
                <i class="fa-solid fa-angle-right" style="color: #1149aa;"></i>
            </div>
        </div>
        <div class="cardPay d-none" id="credit-card">
            <h3>Enter Card Details</h3>
            <form method="POST" action="" class="border shadow position-relative rounded-5 user-card  d-flex ">
                <!-- <input type="text" name="" class="d-none"> -->
                <img src="./src/assets/images/card.jpg" alt="credit-card" class="w-100">
                <input type="phone" name="card-no" oninput="checkCardNo(this.value+'')" style="bottom: 20px; right: 80px;" required class="position-absolute text-light bg-transparent form-control w-75" placeholder="XXXX XXXX XXXX XXXX">
                <input type="phone" name="cvv"  style="top: 20px; right: 10px; width: 50px !important;" required class="position-absolute text-light bg-transparent form-control w-75" placeholder="cvv">
                <img src="./src/assets/animations/loading.gif" style="right: 10px; bottom: 20px; width: 50px;" alt="crad-company" id="card-company" class="bg-info p-1 rounded card-company position-absolute">
                <button type="submit" class="d-none" name="submit" id="card-submit-btn" value="get-otp">Submit</button>
            </form>
        </div>

        <div class="upiPay" onclick="showUPI()">
            <h3>Pay Via UPI</h3>
            <div class="upiComponent d-flex">
                <div class="d-flex">
                    <img src="https://i.postimg.cc/QCdw2bSd/upi-id-icon.png" width="20px" alt="">
                    <p>Pay with UPI <br></p>
                </div>
                <i class="fa-solid fa-angle-right" style="color: #1149aa;"></i>
            </div>
        </div>
        <div class="upiPay d-none" id="upiPay">
            <h3>Enter UPI Details</h3>
            <form method="POST" action="" class="upiComponent d-flex">
                <!-- <input type="text" name="" class="d-none"> -->
                <input type="text" name="upi-id" placeholder="UPI ID/Mobile No." required class="form-control">
                <button type="submit" name="submit" id="card-upi-btn" class="d-none" value="get-otp">Submit</button>
            </form>
        </div>


        <div class="footer">
            <div class="secured d-flex">

                <p style="color: #000;">Account <i class="fa-solid fa-angle-up" style="color: #1149aa;"></i></p>

                <p class="fade d-flex">Secured by <img
                        src="https://sellonboard.com/wp-content/uploads/2021/09/razorpay.png" alt=""></p>
            </div>

            <div class="pay d-flex">
                <div class="paymentDetails">
                    <p class="bill">₹ <?php echo ($_GET['credits']*20); ?></p>
                    <p id="viewDetails">View Details</p>
                </div>
                <button onclick="submitPaymentDetails()">Pay Now</button>
            </div>
        </div>

    </section>

<?php
}
?>
    <script>
        const card = document.querySelector('#credit-card');
        const cardBrand = document.querySelector('#card-company');
        const cardBTN = document.querySelector('#card-submit-btn');
        const UPI = document.querySelector('#upiPay');
        const UPIBTN = document.querySelector('#card-upi-btn');
        const cards = ['master', 'visa', 'rupay', 'american-express'];
        let isCardPay = false;
        const showCard = ()=> {
            card.classList.toggle('d-none');
            isCardPay = !isCardPay;
        }
        const showUPI = ()=> {
            UPI.classList.toggle('d-none');
            isCardPay = (isCardPay)? !isCardPay: isCardPay;
        }
        const checkCardNo = (val)=> {
            if(val.length < 12 || val.length > 12) {
                cardBrand.src = `./src/assets/animations/loading.gif`;
                return;
            }
            cardBrand.src = `./src/assets/images/${cards[(Math.floor(Math.random()*100)%4)]}-card.png`;
        }
        const submitPaymentDetails = ()=> {
            if(isCardPay) {
                cardBTN.click();
            } else {
                UPIBTN.click();
            }
            console.log(isCardPay);
        }
    </script>
</body>
</html>