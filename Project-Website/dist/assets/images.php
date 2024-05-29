<?php

$conn = new mysqli('localhost', 'root', '', 'test');
$Q = "SELECT `data` FROM `images_data` WHERE id = '".$_GET['id']."' AND name = '".$_GET['id']."';";
$res = $conn->query($Q);

while($row = $res->fetch_assoc()) {    
    echo base64_encode($row['data']);
}