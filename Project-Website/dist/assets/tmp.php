<?php

$conn = new mysqli('localhost', 'root', '', 'test');
$Q = "SELECT * FROM `images_data` WHERE 1;";
$res = $conn->query($Q);

while($row = $res->fetch_assoc()) {    
    echo base64_encode($row['id']) . "   ->  ". ($row['name']) . "<br><br>";
}