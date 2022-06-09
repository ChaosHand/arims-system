<?php 

    $conn = mysqli_connect("localhost", "root", "", "arims");

    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>