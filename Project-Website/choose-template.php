<?php
error_reporting(false);
include('./components/dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiAIGen...</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <style>
        .templates-cards {
            width: 300px !important;
            height: 400px !important;
            transition: all 0.1s linear !important;
        }
        .templates-cards:hover {
            width: 310px !important;
            height: 410px !important;
        }
        .preview-template {
            width: 90% !important;
            height: 350px;
            transform: translateY(-800px);
            filter: opacity(0.6);
            background-image: url('./src/assets/animations/constalations.gif');
        }
        .templates-cards:hover > .preview-template {
            
            transform: translateY(-350px);
        }
        #next-btn {
            bottom: 50px; 
            right: 50px;
        }
    </style>

</head>
<body>
    <div class="container">
        <h2 class="h2 border-bottom pb-2 orbitron-simple fw-bold text-center" >
            Choose one of the template from the given options.
        </h2>

        <div class="py-3 available-templates-parent d-flex flex-wrap gap-5 justify-content-evenly">
<?php
$query = "SELECT * FROM templates WHERE 1;";
$res = $conn->query($query);
while ($row = $res->fetch_assoc()) {
?>
            <div data-templateId="template-<?php echo $row['template_id']; ?>" class="templates-cards overflow-y-hidden rounded shadow border p-3 position-relative">
                <img src="<?php echo $row['template_image']; ?>" class="w-100 templates-images rounded shadow" alt="<?php echo $row['template_id']; ?>">
                <a href="<?php echo $row['template_url']; ?>" class="position-absolute fs-3 rounded shadow preview-template text-decoration-none text-light bg-dark d-flex flex-row align-items-center justify-content-center gap-2">
                    Preview <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>
<?php
}
?>
            <!-- <div data-templateId="template-3" class="templates-cards overflow-y-hidden rounded shadow border p-3 position-relative">
                <img src="./src/assets/images/template-1.png" class="w-100 templates-images rounded shadow" alt="Template Image">
                <a href="./templates/template-1.php" class="position-absolute fs-3 rounded shadow preview-template text-decoration-none text-light bg-dark d-flex flex-row align-items-center justify-content-center gap-2">
                    Preview <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div> -->
        </div>

        <button class="btn btn-dark fs-3 px-5 position-fixed" id="next-btn" >Next</button>
    </div>
    
    <form action="get-website-details.php" method="GET" class="d-none" id="template-form">
        <input type="text" name="template" value="" required>
    </form>

<script>
    const templates = document.querySelectorAll('.templates-cards');
    const form = document.querySelector('#template-form');
    const next = document.querySelector('#next-btn');

    let isCardSelected = null;


    for (let i = 0; i < templates.length; i++) {
        templates[i].addEventListener('click', (e)=> {
            if(isCardSelected != null) {
                isCardSelected.classList.toggle('border-info');
                isCardSelected.classList.toggle('border-3'); 
            }

            const templateId = templates[i].getAttribute('data-templateId');
            templates[i].classList.toggle('border-info');
            templates[i].classList.toggle('border-3');
            isCardSelected = templates[i];
        });
    }

    next.addEventListener('click', (e)=> {
        const templateId = document.querySelector('.templates-cards.border-info').getAttribute('data-templateId');
        console.log(templateId)
        if(templateId == null) {
            return;
        }
        form.querySelector('input[name="template"]').value = templateId;
        form.submit();

    });

</script>
</body>
</html>