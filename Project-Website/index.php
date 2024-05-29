<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiAIGen... AI Based Website Builder... Final Year Engineering Diploma Project.</title>
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">

</head>
<body class="bg-default-indigo">

    <?php include('./components/header.php'); ?>

    <!-- Hero-Section -->
    <div class="hero-section my-5 container  border-bottom border-info pb-5 d-flex flex-column-reverse flex-md-row align-items-center justify-content-between w-100 flex-wrap">
      <div class="hero-left w-100 w-md-50">
        <h2 class="h2 orbitron-simple fw-bold text-secondary">
          <b class="h1 text-dark">Take your business online</b><br> via custom website within some minutes... 
        </h2>
        <p class="small">We help small & medium businesses to make their presence online, so that they can grab the attention of the audiance across the globe. We offers variety of AI Generated Websites along with customization.</p>

        <div class="hero-section-main-btns w-100 d-flex justify-content-start ">
          <a class="btn  btn-dark w-25 m-2 py-3 d-flex align-items-center  justify-content-center fw-bold fs-5" href="choose-template.php">Explore Now</a>
          <a class="btn btn-light w-25 m-2 d-flex align-items-center justify-content-start gap-2" href="#">
            <img src="./src/assets/images/Play-Store.webp" class="w-25 " alt="Play-Store">
            <span>Get  it on <br><b>Play Store</b></span>
          </a>
        </div>
      </div>
      <div class="hero-right w-100 w-md-50">
        <img src="./src/assets/images/hero-img.png" class="w-100" alt="">
      </div>
    </div>
    <!-- Hero-Section -->

    <!-- About-US-Section -->
    <div class="container about-us-section" id="About-Us">
      <div class="section-headings h1 orbitron-simple fw-bold">
        About Us
      </div>

      <div class="about-us-hero-section py-5 mt-md-5 d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="about-us-left w-100 w-md-40">
          <img src="./src/assets/images/mobiles-img.png" class="w-100" alt="About-Us-image">
          
        </div>
        <div class="about-us-right w-100 w-md-50">
          <div class="about-us-parts">
            <div class="h2 fw-bold orbitron-simple">
            We understand your business need.
            </div>
            <p class="small">
              We have developed this website builder which is powered by AI. Via building website from our website builder tool, you can reduce your cost, time, efforts, etc.
            </p>
          </div>
          <div class="about-us-parts">
            <div class="h2 fw-bold orbitron-simple">
            AI based website builder tool for all.
            </div>
            <p class="small">
              We value every business and understand your business needs. Any business including small, medium & even large businesses can build their own website with the help of AI to get an online presence.
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- About-US-Section -->
    
    <!-- Our-Services-Section -->
    <div class="our-services-section paper-cut-look  bg-light py-3 container-fluid shadow rounded " id="Our-Services">
      <div class="  py-md-3 mt-5 mt-md-1 section-headings h1 orbitron-simple fw-bold w-100 d-flex justify-content-md-end justify-content-center align-items-center px-md-5">
        Our Services
      </div>
      
      <div class="about-us-hero-section container py-5 mt-md-5 d-flex flex-column-reverse flex-md-row justify-content-between align-items-center">
        
        <div class="about-us-right w-100 w-md-50">
          <div class="about-us-parts">
            <div class="h2 fw-bold orbitron-simple">
            Get Your Business Online in few minutes
          </div>
          <p class="small">
            We help small & medium businesses to make their presence online, so that they can grab the attention of the audiance across the globe. We offers variety of AI Generated Websites along with customization.
          </p>
        </div>
        <div class="about-us-parts">
          <div class="h2 fw-bold orbitron-simple">
            Build Your own website without coding.
          </div>
          <p class="small">
            Get your business online within few minutes without hiring any software developers and even without coding...
          </p>
          </div>
        </div>
        <div class="about-us-left w-100 w-md-40">
          <img src="./src/assets/images/hero-img.png" class="w-100" alt="About-Us-image">
          
        </div>
      </div>
      <div class="my-md-5 "></div>
      
    </div>
    <!-- Our-Services-Section -->
    
    <?php include('./components/footer.php'); ?>
    
    
    <script src="./src/bootstrap/js/bootstrap.bundle.min.js" defer ></script>
  </body>
  </html>
  
  
  