
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Generated Text</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .loading-box {
            border: 15px dashed blue !important;
            width: 100px;
            height: 100px;
            animation: round 1s 0s infinite;
        }
        @keyframes round {
            from {
                transform: rotate(180deg);
                border: 15px solid aqua;
            } 
            to {
                transform: rotate(360deg);
                border: 15px solid green;
            }
        }
    </style>
</head>
<body>
    <div class="container py-3">

<!-- PHP SCRIPT -->
<?php
$isReq = false;
$pagesCnt = 0;
$prompt = "";
    function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == "POST")? true: false;
    }

    if(isPost()) {
        echo "POST METHOD<br><br>";
        $isReq = true;

        $pagesCnt = (int) $_POST['total-pages'];
        $prompt = filter_var($_POST['user-prompt'], FILTER_SANITIZE_STRING);
        $prompt = trim($prompt);
        echo $pagesCnt." Pages<br><br>";
        echo "Prompt: ".$prompt." <br><br>";

        for($i = 0; $i < $pagesCnt; $i++) {
            $pageName = "page-name-".($i+1);
            echo $_POST[$pageName].", ";
        }
    } else {
        echo "GET METHOD";
    }

    echo "<br><br><b><a href='./'>Go Back</a></b>";
?>

<!-- PHP SCRIPT -->


    <div class="result-box shadow w-100 py-3 px-2 my-5 border rounded" id="result-box">
        <div class="loading d-flex w-100 align-items-center justify-content-center " id="loading">
            <div class="loading-box  d-flex  align-items-center justify-content-center rounded-circle"></div>
        </div>
    </div>
    <div class="images-box" id="images-box"></div>
 </div>



<script>
    let box = document.getElementById('result-box');
    let loading = document.getElementById('loading');
    let imgBox = document.getElementById('images-box');
    // let spPrompt = "";
    // loading.classList.add('d-none');
    // box.innerText = "Loading...";



    const askGPT =(q, page, i)=> {
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../../../../faltu/chat%20gpt%20api/api.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('asked='+q);
        xhttp.onreadystatechange=()=> {
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                loading.classList.add('d-none');
                let getImg = "";
                
                box.innerHTML += `<br><hr><br><h2> ${page} </h2> ${getImg}  ${xhttp.responseText}`;
            }
        } 

    }
    const askDELLE3 =(q, page)=> {
        let xhttp = new XMLHttpRequest();
        xhttp.open('GET', '../../../../faltu/delle3/api.php?p='+q, true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
        xhttp.onreadystatechange=()=> {
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                
                imgBox.innerHTML += `<img src='${xhttp.responseText}' alt='${page}' />`;
            }
        } 

    }
<?php
  if($isReq) {
    for($i = 0; $i < $pagesCnt; $i++) {
        $pageName = "page-name-".($i+1);
?>

    let spPrompt<?php echo trim($i+1); ?> = "<?php echo trim($prompt); ?>Based on the above quote write a brief seo friendly html discription for putting it on our website on <?php echo $_POST[$pageName]; ?>  section. provide a very short and crisp discription based on the above quote and must br related to <?php echo trim($_POST[$pageName]); ?> only. Also remove the irrelevent details if possible since we have already extrected other details.";

    setTimeout(async() => {
        askGPT(spPrompt<?php echo  trim($i+1); ?>, '<?php echo $_POST[$pageName]; ?>', <?php echo  (int)($i+1); ?> );
        askDELLE3(spPrompt<?php echo  trim($i+1); ?>, '<?php echo $_POST[$pageName]; ?>');
        
    }, <?php echo ((int) trim($i+5))*1000; ?>);

<?php
    }
  }

  ?>
</script>
</body>
</html>
  <!-- await fetch(`../../../../faltu/delle3/api.php?p=${spPrompt<?php echo trim($i+1); ?>}`) -->