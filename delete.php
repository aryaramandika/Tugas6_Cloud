<?php
$conn = mysqli_connect("localhost", "root", "", "guided_php2") or die("Koneksi ke DB gagal");
$id = $_GET["id"];
$sql = "DELETE FROM pendaftaran WHERE id=$id";
if(mysqli_query($conn, $sql)){
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}