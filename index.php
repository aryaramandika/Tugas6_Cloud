<?php
$conn = mysqli_connect("127.0.0.1","root","","guided_php2") or die("Koneksi ke DB gagal");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran</title>
    <style>
        body{
            font-family: Trebuchet MS, sans-serif;
            margin:auto;
            max-width: max-content;
        }
        table, th,td{
            border-collapse: collapse;
            border: 2px solid black;
            padding:0.5rem;
        }
    </style>
</head>
<body>
    <h1>Data Pendaftaran BEM FTI</h1>
    <a href="form.php">Tambah Data</a>

    <table>
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>IPK</th>
            <th>Semester</th>
            <th>Aksi</th>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pendaftaran";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $i = 1;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$row["nama"]."</td>";
                    echo "<td>".$row["tgl_lahir"]."</td>";
                    echo "<td>".$row["ipk"]."</td>";
                    echo "<td>".$row["semester"]."</td>";
                    echo "<td><a href='form.php?id=".$row["id"]."'>Ubah</a>&nbsp;<a href='delete.php?id=".$row["id"]."'>Hapus</a></td>";
                    echo "</tr>";
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>