<?php  $page = "Home"; $businessname = "dcricks"; ?>
<?php
  // include('./data-file.php');

  $page = ($page)? $page: "Home";
  $businessname = ($businessname)? $businessname: "pages";
  $logoLink = ($logoLink)? $logoLink: "https://static.vecteezy.com/system/resources/thumbnails/027/254/720/small/colorful-ink-splash-on-transparent-background-png.png";


    if(isset($_GET['page']))
        $page = $_GET['page'];

    $conn = new mysqli('localhost', 'root', '', 'test');

    $q = "SELECT * FROM `".$businessname."` WHERE `page_id` = '".$page."';";
    $links_Q = "SELECT `page_id` FROM `pages` WHERE 1;";

    $res = $conn->query($q);
    $linksRes = $conn->query($links_Q);
    $linksRes2 = $conn->query($links_Q);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $businessname." | ".$page; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        *{
            transition: all 0.2s linear !important;
        }
        .heros {
            height: 70vh;
        }

        @media screen and (min-width: 800px) {
            .w-md-50 {
                width: 50% !important;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom  border-secondary">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="<?php echo $logoLink; ?>" style="height: 50px;" alt="">
        <b>
        <?php echo $businessname; ?>
      </b>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">

      <?php
        while($row = $linksRes->fetch_assoc()) {
            
            
      ?>

        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $row['page_id']; ?>" class="nav-link px-2 link-secondary"><?php echo $row['page_id']; ?></a></li>

      <?php
}
      ?>
        
      </ul>
    </header>
  </div>

    <?php

        while($row = $res->fetch_assoc()) {
        ?>

    <div class="container d-flex justify-content-evenly flex-column-reverse flex-md-row w-100 align-items-center ">
            <div class="heros w-100 w-md-50 bg-light d-flex  justify-content-center flex-column align-items-start gap-2 px-3">
                <h2 class="h2 text-primary">
                <?php echo $row['page_heading']; ?>
                </h2>
                <p class="text-dark">
                    <?php echo $row['page_description']; ?>
                </p>

            </div>
            <img class="heros w-100 w-md-50  bg-light" src="<?php echo $row['hero_image']; ?>" alt="tmp" />
    </div>

    <?php
        }

    ?>
    

    <div class="container">
  <footer class="py-5 border-top border-secondary">
    <div class="row">
      <div class="col-6 col-md-2 mb-3">
        <h5><?php echo $businessname; ?></h5>
        <ul class="nav flex-column">
          <img src="<?php echo $logoLink; ?>" style="height: 50px; width: 100px;" alt="<?php echo $page; ?>">
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Important Links</h5>
        <ul class="nav flex-column">
        <?php

            while($row = $linksRes2->fetch_assoc()) {
        ?>
        
        <li class="nav-item mb-2"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $row['page_id']; ?>#" class="nav-link p-0 text-muted"><?php echo $row['page_id']; ?></a></li>
        
        <?php
            }
        ?>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
          </div>
        </form>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
      <p>© 2022 Company, Inc. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
      </ul>
    </div>
  </footer>
</div>
</body>
</html>