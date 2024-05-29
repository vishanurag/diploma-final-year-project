<?php
  include('./data-file.php');
  $page = (isset($page))? $page: "Home";
  $businessname = (isset($businessname))? $businessname: "pages";
  $logoLink = (isset($logoLink))? $logoLink: "../src/assets/images/di-ai-gen-logo.png";

    

    $q = "SELECT * FROM `".$businessname."` WHERE 1;";
    $links_Q = "SELECT `page_id` FROM `".$businessname."` WHERE 1;";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .hero-section, .about-section  {
            height: 90vh;
        }
        .hero-section img, .about-section img {
            height: 50vh;
        }

        html,
        body {
            width: 100%;
            height: 100%;
        }
        body {
            position: relative;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

    </style>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="30" class="bg-dark">
    <nav class="navbar navbar-expand-lg fixed-top bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $logoLink; ?>" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
<?php
while($row = $linksRes->fetch_assoc()) { 
?>
        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>#<?php echo $row['page_id']; ?>" class="nav-link px-2 link-secondary"><?php echo $row['page_id']; ?></a></li>
<?php
}
?>

                </ul>
            </div>
        </div>
    </nav>

<?php

while($row = $res->fetch_assoc()) {
?>

<section id="<?php echo $row['page_id']; ?>">
    <div class="container my-5 pt-3 hero-section  d-flex justify-content-md-between align-items-center flex-column flex-md-row" >
        <div class="home__data ">
            <h5 class="h5 "><?php echo $row['page_heading']; ?></h5>
            <h3 class="text-white home__subtitle"> <?php echo $row['page_description']; ?></h3>
        </div>

        <img src="<?php echo $row['hero_image']; ?>" class="rounded " alt="<?php echo $row['page_heading']; ?>">
</section>

<?php
}
?>


    <section class=" py-3 py-md-5">
        <div class="container" id="section3">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center text-white font-weight-bold">Contact</h2>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-lg-center">
                <div class="col-12 col-lg-9">
                    <div class="bg-white border rounded shadow-sm overflow-hidden">

                        <form action="#!">
                            <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                                <div class="col-12">
                                    <label for="fullname" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" value=""
                                        required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                            </svg>
                                        </span>
                                        <input type="email" class="form-control" id="email" name="email" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                                <path
                                                    d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                            </svg>
                                        </span>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="message" name="message" rows="3"
                                        required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <img src="<?php echo $logoLink; ?>" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                </a>
                <span class="mb-3 mb-md-0 text-body-secondary">© 2024 <?php echo $businessname." | ".$page; ?></span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#twitter"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#instagram"></use>
                        </svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24">
                            <use xlink:href="#facebook"></use>
                        </svg></a></li>
            </ul>
        </footer>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</html>