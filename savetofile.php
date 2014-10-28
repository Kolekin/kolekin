<?php
if (isset($_FILES['myFile'])) {
    // Example:
    move_uploaded_file($_FILES['myFile']['tmp_name'], "uploads/" . $_FILES['myFile']['name']);
    // $_FILES['myFile']['name'])."png";
    echo 'successful';
}

?>