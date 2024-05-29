<!-- NavBar -->
<nav class="navbar navbar-expand-lg pt-3">
    <div class="container">
      <a class="navbar-brand d-flex  flex-row gap-md-3 gap-2  align-items-center justify-content-center gap-0" href="./">
      <img src="./src/assets/images/di-ai-gen-logo.png" alt="DiAIGen Logo by Anurag Vishwakarma" class="img header-logo">  
      <div class="">
      <div class="p-0  h2 lobster-regular" > DiAIGen...</div>
      <span class=" pt-0  orbitron-simple brand-slogen-navbar">An AI Based Website Builder.</span>
       
      </div> 
      </a>
      <div class="shadow">
        <button class="navbar-toggler collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
          </button>
      </div>
      <div class="navbar-collapse collapse  d-lg-flex justify-content-end" id="navbarNav" >
        <ul class="navbar-nav ">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./#About-Us">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./#Our-Services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./plans.php">Pricing</a>
          </li>
          <li class="nav-item ">
            <?php
              if(isset($_SESSION['email'])) {
                echo '<a class="btn btn-outline-danger mx-2" href="./sign-out.php">Sign Out</a> <a class="btn rounded-circle border shadow mx-2 p-1" href="./profile.php"><img src="./src/assets/images/user-icon.png" width="30" class="rounded-circle border"></a>';
              } else {
                ?>
              <a href="./sign-in.php" class="btn btn-outline-dark mx-2">Sign In</a>
              <a href="./sign-up.php" class="btn btn-dark mx-2">Sign Up</a>
                <?php
              }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!-- NavBar -->