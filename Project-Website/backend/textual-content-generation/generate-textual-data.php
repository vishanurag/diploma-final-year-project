                                                                                                                                                                                                                                                                                                                                                                         
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Generated Text</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        *{
            transition: all .2s linear ;
        }
        body {
            height: 90vh !important;
            width: 100vw !important;
        }
        .loading {
            width: 150px !important;
            height: 150px !important;
        }
        .loading-box {
            border: 15px dashed blue;
            width: 100px;
            height: 100px;
            animation: round 1s 0s infinite;
        }
        .result-box {
            min-height: 500px !important;
            filter: blur(10) !important;
        }
        .main-container {
            height: 90vh !important;
        }
        @keyframes round {
            from {
                transform: rotate(-360deg);
                width: 100px;
                height: 100px;
                border: 15px dashed blue;
            }
            to {
                transform: rotate(180deg);
                width: 150px;
                height: 150px;
                border: 25px solid aqua ;
            } 
        }
    </style>
</head>
<body class="overflow-hidden">
    <div class="container py-3 d-flex main-container align-items-center">

<!-- PHP SCRIPT -->
<?php
$isReq = false;
$pagesCnt = 0;
$prompt = "";
    function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == "POST")? true: false;
    }

    if(isPost()) {
        $isReq = true;

        $brandName = $_POST['business-name'];
        $pagesCnt = (int) $_POST['total-pages'];
        $template = $_POST['template'];
        $prompt = filter_var($_POST['user-prompt'], FILTER_SANITIZE_STRING);
        $prompt = trim($prompt);
        $web_logo = "../src/assets/images/di-ai-gen-logo.png";
        
        if(isset($_FILES['business-logo'])) { 
           $web_logo = "../../dist/assets/images/logo-".$brandName.".png";
           file_put_contents($web_logo, $_FILES['business-logo']['tmp_name']);
        }
?>

<!-- PHP SCRIPT -->


    <div class="result-box shadow bg-transparent  w-100 py-3 px-2 my-5 border d-flex align-items-center justify-content-center flex-column rounded" id="result-box">
        <div class="loading d-flex w-100 align-items-center justify-content-center flex-column" id="loading">
            <div class="loading-box  d-flex  align-items-center justify-content-center rounded-circle"></div>
        </div>
        <h1 class="h1 fs-1 text-info mt-2">awrer</h1>
    </div>
    <div class="images-box" id="result-box"></div>
 </div>


 <style>
    .overley-main-container {
        top: 0 !important;
        right: 0 !important;
        left: 0 !important;
        bottom: 0 !important;
        z-index: -1 !important;
    }
    .ball-blue {
        --shadow-color: blue;
        top: -10vh !important;
    }
    .ball-pink {
        --shadow-color: red;
        left: -10vw !important;
    }
    .ball-aqua {
        --shadow-color: green;
        right: -10vw !important;
    }
    .ball-orange {
        --shadow-color: orange;
        bottom: -10vh !important;
    }
    .animated-circles {
        width: 300px !important;
        height: 300px !important;
        opacity: 0.4 !important;
        background-color: transparent;
        box-shadow: 50vw 25vh 100px 5px var(--shadow-color);
    }
 </style>

 <div class="overley-main-container bg-light position-absolute">
    <div class="animated-circles position-absolute rounded-circle  ball-blue"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-pink"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-aqua"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-orange"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-blue"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-pink"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-aqua"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-orange"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-blue"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-pink"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-aqua"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-orange"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-blue"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-pink"></div>
    <div class="animated-circles position-absolute rounded-circle  ball-aqua"></div>
    
 </div>


<script>
    let box = document.getElementById('result-box');
    let loading = document.getElementById('loading');
    let resBox = document.getElementById('result-box');
    


    const generateWebsiteForUser = async()=> {

        try {
            let res = await fetch(`./generate-website-content.php`, {
                method: "POST",
                body: JSON.stringify(
                    {
                        brandName: '<?php echo $brandName; ?>',
                        prompt: '<?php echo $prompt; ?>',
                        totalPages: '<?php echo $pagesCnt; ?>',
                        template: '<?php echo $template; ?>',
                        webLogo: '<?php echo $web_logo; ?>',
                        pages: [
                            <?php
                            for($i = 0; $i < $pagesCnt; $i++) {
                                $pageName = "page-name-".($i+1);
                                $currPageName = str_replace('-', '', $pageName);
                                echo "{".$currPageName. ": '". $_POST[$pageName]."'}, ";
                            }
                            ?>
                        ]
                    }
                ),
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }
            });
            let data = await res.json();
            console.log(data.siteurl + " \n"+ data.message);
            if(data.result == 'success') {
                
                resBox.innerHTML = `<div><a  href="${data.siteurl}">View Site</a><br><br>${data.message}</div>`;
            } else {
                resBox.innerHTML = `<div><a  href="./">Try again after some time</a><br><br>${data.message}</div>`;
                
            }
            
        } catch (error) {
            resBox.innerHTML = `<div><a  href="./">Try again after some time</a><br><br>Oops! Something went worng...</div>`;
            console.log("ERROR OCCURED->\n\n"+error);
        }
        
    }
    generateWebsiteForUser();


    // Script written for the shadow animations...
    let animatedCircles = document.getElementsByClassName('animated-circles');
    let changePosition = (i)=> {
        animatedCircles[i].style.transform = `rotate(${Math.random()*500}deg)`;
        animatedCircles[i].style.transition = `all ${Math.random()*20}s linear`;
    }

    setInterval(() => {
        for(let i = 0; i < animatedCircles.length; i++) {
            changePosition(i);
        }
    }, 500);

</script>
<?php

} else {
    // echo "GET METHOD";
}

?>
</body>
</html>