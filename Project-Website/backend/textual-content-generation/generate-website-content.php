<?php
error_reporting(false);
include('../../components/check-session.php');
include('../../components/api-key.php');
include('../../components/dbconn.php');
include('../../components/api-functions.php');


$connGen = new mysqli('localhost', 'root', '', 'output_websites');

 $imageprompt = "";


if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Getting the Data provided by the user into PHP REQUEST_METHOD variable ($_POST) for methods of GET & POST...
    $_POST = json_decode(file_get_contents('php://input'), true);
    // Got the data in $_POST variable...

    $data = $_POST['prompt'];
    $data2 = $_POST['totalPages'];
    $n = $_POST['totalPages'];
    $web_logo = $_POST['webLogo'];

    // Creating the table for the website output...
    $createTable_Q = "CREATE TABLE IF NOT EXISTS `".$_POST['brandName']."` (
        `page_id` VARCHAR(255) NOT NULL,
        `page_heading` VARCHAR(500),
        `page_description` VARCHAR(1000),
        `hero_image` VARCHAR(5000),
        PRIMARY KEY (`page_id`)
    );";
    $connGen->query($createTable_Q);

     
    
    try {

        $imageprompt = askGPT2($api_key);
        
        for ($i = 0; $i < $n; $i++) { 
            $pagename = ($_POST['pages'][$i]['pagename'.$i+1]);
            $textdata = askGPT($api_key, $pagename);
            $imagelink = askDELLE3($api_key, $pagename);
    
        //    Storing the AI Generated Details in the DBMS for using them in the final websites... 
            storeDataInDB($connGen, $pagename, $textdata);
            storeImagelinkInDB($connGen, $pagename, $imagelink);
        }


        $str = '<?php  $page = "Home"; $businessname = "'.$_POST['brandName'].'"; $logoLink = "'.$web_logo.'"; ?>';
        $diaigen_footer = '<div class="footer bg-black text-light text-center p-3">
        This website is generated with <a class="text-info fs-4 text-decoration-none" href="../">DiAIGen</a> - An AI Based Website Builder. </div>';

        // File Handeling for Cloning the existing templates... START
        $templatePath = '../../templates/'.$_POST['template'].'.php';
        $template = fopen($templatePath, "r") or die("Unable to open file!");
        $data_from_read= fread($template,filesize($templatePath));
        fclose($template);
        
        $websitePath = '../../dist/'.$_POST['brandName'].'.php';
        $myfile = fopen($websitePath, "w") ;
        fwrite($myfile, $str.$data_from_read.$diaigen_footer);
        fclose($myfile);
        // File Handeling for Cloning the existing templates... END

        storeGeneratedWebsiteInRecord($conn, $_POST['brandName'], './dist/'.$_POST['brandName'].'.php', $_SESSION['email']);
        


        
        // Making the final data object...
        $obj = array(
            'result'=> 'success',
            'message'=> 'Wohoo! Your site is created successfully...',
            'siteurl'=> '../../dist/'.$_POST['brandName'].'.php'
        );
        // Reducing the token count by 1. because user has created 1 website...
        getCredits($conn, -1, $_SESSION['email']);
    } catch (\Throwable $th) {
        
        $drop_Q = "DROP TABLE `".$_POST['brandName']."`;";
        $connGen->query($drop_Q);
        
        
        $obj = array(
            'result'=> 'failed',
            'message'=> 'Oops! Something went wrong...',
            'siteurl'=> '../../dist/none/'
        );
    }
        
            
   
    echo json_encode($obj);
    return;
}

echo "403";
?>