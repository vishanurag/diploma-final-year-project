<?php
include('./components/check-session.php');
include('./components/dbconn.php');

$user = getUserDetails($conn, $_SESSION['email']);
$generatedWebsites = getAllGeneratedWebsites($conn, $_SESSION['email']);
// print_r($generatedWebsites->num_rows);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $user['name']; ?></title>
        <link rel="stylesheet" href="./src/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./src/css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
    <?php include('./components/header.php'); ?>
    <div class="container d-flex flex-column align-items-center justify-content-center gap-3 my-5 overflow-x-hidden">
        <img src="./src/assets/images/user-icon.png" alt="<?php echo $user['name']; ?>" width="200" class="rounded-circle border p-3 border-info shadow">
        <div class="h2 text-secondary mt-3">
            Welcome: <span class="text-primary "><?php echo $user['name']; ?></span>
        </div>
        <div class="h2 text-drak my-2">
            Tokens: <span class="text-danger "><?php echo $user['tokens']; ?>🪙</span>
        </div>
        <div class="my-1">
            <a href="./pay.php" class="btn btn-outline-success fs-4 mx-1">Get Tokens</a>
            <a href="./choose-template.php" class="btn btn-primary fs-4 mx-1 <?php echo ($user['tokens'] > 0)? '': 'disabled'; ?>">Generate Website</a>
        </div>
<?php
if($generatedWebsites->num_rows) {
?>
        <div class="my-3 all-generated-websites-till-now border rounded shadow overflow-x-scroll p-3">
           <h2 class="h2">Your Websites...</h2>
           <table class="table table-striped ">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Live Link</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>
<?php
$i = 1;
while($row = $generatedWebsites->fetch_assoc()) {
    ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['website_name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><a href="<?php echo $row['website_url']; ?>" class="btn btn-dark">View</a></td>
                    <td><span onclick="shareTheLink('<?php echo $row['website_url']; ?>')" class="btn "><i class="bi bi-share-fill"></i></span></td>
                </tr>
<?php
}
?>
            </tbody>
           </table>
        </div>
<?php
}
?>
        <?php 

// ."<br>";
// echo $user['email']."<br>";
// echo $user['user_type']."<br>";
// echo $user['profile_image']."<br>";

?>
    
    </div>
    <?php include('./components/footer.php'); ?>
    
    <script src="./src/bootstrap/js/bootstrap.bundle.min.js" defer ></script>

    <script>
        
        const shareTheLink = ((link) => {
 
            // Fallback, Tries to use API only
            // if navigator.share function is
            // available
            if (navigator.share) {
                navigator.share({
 
                    // Title that occurs over
                    // web share dialog
                    title: 'GeeksForGeeks',
 
                    // URL to share
                    url: link
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(err => {
 
                    // Handle errors, if occurred
                    console.log(
                    "Error while using Web share API:");
                    console.log(err);
                });
            } else {
 
                // Alerts user if API not available 
                alert("Browser doesn't support this API !");
            }
        })
    </script>
</body>
</html>