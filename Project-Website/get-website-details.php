<?php
include('./components/check-session.php');
include('./components/dbconn.php');

if(!isset($_GET['template'])) {
    header('Location: ./');
    return;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textual Content Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">

    <style>
        #next-btn {
            bottom: 50px; 
            right: 50px;
        }
        #back-btn {
            bottom: 50px; 
            left: 50px;
        }
        .user-details-section {
            height: 90vh !important;
        }
        .vw-100 {
            min-width: 90vw !important;
        }
        .left-covering {
            left: 0;
            top: 0;
            bottom: 50px;
        }
        .right-covering {
            right: 0;
            top: 0;
            bottom: 50px;
        }
        .cirle-balls {
            width: 200px;
            height: 200px;
        }
        #circle-ball-1 {
            top: -100px;
            left: -100px;
            box-shadow: 200px 200px 50px 50px rgba(0, 208, 255, 0.227);
        }
        #circle-ball-2 {
            bottom: 200px;
            right: -100px;
            box-shadow: -200px 200px 50px 50px rgba(81, 0, 255, 0.227);
        }
        
    </style>
</head>
<body >
    <div class="container overflow-x-hidden">
        <div id="circle-ball-1" class="cirle-balls  rounded-circle position-absolute"></div>
        <div id="circle-ball-2" class="cirle-balls rounded-circle position-absolute"></div>
        <form action="./backend/textual-content-generation/generate-textual-data.php" method="post" id="main-form" class="d-flex  align-items-center justify-content-between  ">
            <div class="business-name-section user-details-section  vw-100 pt-3 d-flex  flex-column justify-content-center gap-5 align-items-center">
                <h1 class="text-center text-dark h2 border-bottom pb-2 orbitron-simple fw-bold">What's your Business Name?</h1>
                <input type="text" class="form-control form-control-lg input-dark w-md-40" name="business-name" placeholder="Business Name">
            </div>
            <div class="business-name-section user-details-section vw-100 pt-3 d-flex   flex-column justify-content-center gap-5 align-items-center" required>
                <h1 class="text-center text-dark h2 border-bottom pb-2 orbitron-simple fw-bold">How many pages do you want in your website?</h1>
                <span class="w-1 ">
                    <select type="number" value="1" name="total-pages" id="pages-count" class="rounded my-2 w-1 form-control form-control-lg" required>
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </span>

            <div id="all-pages-names" class="my-1">
                <div class="my-2">
                    <label for="page-name-1">Page 1</label>
                    <input required type="text" name="page-name-1" value="Home" id="page-name-1" class="form-control my-2 form-control-lg">
                </div>
            </div>
                <!-- <input type="text" class="form-control form-control-lg input-dark w-md-40" placeholder="Business Name"> -->
            </div>
            <div class="business-name-section user-details-section vw-100 pt-3 d-flex   flex-column justify-content-center gap-5 align-items-center">
                <h1 class="text-center text-dark h2 border-bottom pb-2 orbitron-simple fw-bold">Write a brief description about your Business...</h1>
                <textarea type="text" name="user-prompt" class="form-control form-control-lg input-dark w-md-40" cols="30" rows="10" placeholder="Give Your Prompt Here..." required></textarea>
            </div>
            <div class="business-name-section user-details-section vw-100 pt-3 d-flex   flex-column justify-content-center gap-5 align-items-center">
                <h1 class="text-center text-dark h2 border-bottom pb-2 orbitron-simple fw-bold">Provide a logo of your business <span class="text-secondary">(Optional)</span>...</h1>
                <input type="file" name="business-logo" class="form-control form-control-lg input-dark w-md-40" placeholder="Business Logo">
            </div>

            <input type="text" name="template" value="<?php echo $_GET['template']; ?>" class="d-none" required>
            <button type="submit" class="d-none btn btn-dark fs-3 px-5 position-fixed" id="formSubmitBTN">Submit</button>
        </form>
        <div class="left-covering position-absolute bg-light rounded border px-2"></div>
        <div class="right-covering position-absolute bg-light rounded border px-2"></div>
        
        <button class="btn btn-dark fs-3 px-5 position-fixed" id="next-btn" >Next</button>
        <button class="btn btn-outline-dark fs-3 px-5 position-fixed" id="back-btn" >Back</button>
        <!-- <div id="x"></div> -->
    </div>

    
    <script>
    const nextBtn = document.getElementById('next-btn');
    const backBtn = document.getElementById('back-btn');
    const formSubmitBTN = document.getElementById('formSubmitBTN');
    let translateXVal = 0, valToReduce = 90;

    const changeFormPosition = (val)=> {
        let formParent = document.getElementById('main-form');
        formParent.style.transform = `translateX(${val}vw)`;
    }
    const backButtonEffect = ()=> {
        translateXVal += (valToReduce);
        valToReduce += reduceVal(valToReduce);
        changeFormPosition(translateXVal)
    }
    const nextButtonEffect = ()=> {
        translateXVal -= (valToReduce);
        valToReduce -= reduceVal(valToReduce);
        changeFormPosition(translateXVal);
    }
    let reduceVal = (val)=> {
        return val%15;
    }
    let showSubmitBTN = (val)=> {
            nextBtn.innerText = 'Submit';
            formSubmitBTN.click();
    }
    nextBtn.addEventListener('click', (e)=> {
        return (translateXVal > -200)? nextButtonEffect(): showSubmitBTN(translateXVal);
    });
    backBtn.addEventListener('click', (e)=> {
        return (translateXVal < 0)? backButtonEffect(): '';
    });


    // Pages related script...
    let pageCountData = document.getElementById('pages-count');
    let allPagesBox = document.getElementById('all-pages-names');

    let totalPages = 1;

    const getPagesInputFields = (cnt)=> {
        let str = "";
        for(let i = 0; i < cnt; i++) {
            let inputField = `<div class="my-2"> <label for="page-name-${i+1}">Page ${i+1}</label> <input type="text" name="page-name-${i+1}" value="Page ${i+1}" id="page-name-${i+1}" class="form-control form-control-lg my-2"> </div>`;
            str += inputField;
        }
        totalPages = cnt;
        return str;
    };
    const addPageNamesFields = (pagesCnt)=> {
        if(totalPages == pagesCnt) {
            return;
        }
        allPagesBox.innerHTML = getPagesInputFields(pagesCnt);
    };
    pageCountData.addEventListener('input', (e)=> {
        addPageNamesFields(+e.target.value);
    });
    </script>
</body>
</html>