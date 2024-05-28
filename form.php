<?php
$conn = mysqli_connect("127.0.0.1","root","","guided_php2") or die("Koneksi ke DB gagal");
$id = null;
if($_GET){
    $id = $_GET["id"];
    $sql = "SELECT * FROM pendaftaran WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $oldName = $row["nama"];
        $oldTglLahir = $row["tgl_lahir"];
        $oldIpk = $row["ipk"];
        $oldSemester = $row["semester"];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML 2</title>
    <style>
        body, input, select, option{
            font-size:2rem;
        }
        body{
            margin:auto;
            max-width: max-content;
            font-family: Trebuchet MS, sans-serif;
        }
        h2{
            text-align:center;
        }
        TD{
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <h2>Pendaftaran BEM</h2>
    <a href="index.php">Back to home</a>
    <form action="form.php" method="POST">
        <input type="hidden" name="id" value=<?php if($id != null){echo $id;}?>>
        <table>
            <tr>
                <td><label for="nama">Nama :</label> </td>
                <td><input type="text" id="nama" name="nama" value=<?php if($id != null){echo "'".$oldName."'";} else{echo "";} ?>></td>
            </tr>
            <tr>
                <td><label for="tgl_lahir">Tanggal Lahir : </label></td>
                <td><input type="date" id="tgl_lahir" name="tgl_lahir" value=<?php if($id != null){echo $oldTglLahir;} else{echo "";} ?>></td>
            </tr>
            <tr>
                <td><label for="ipk">IPK : </label></td>
                <td><input type="number" id="ipk" min="2.75" step="0.05" name="ipk" value=<?php if($id != null){echo $oldIpk;} else{echo "";} ?>></td>
            </tr>
            <tr>
                <td><label for="smt">Semester : </label></td>
                <td>
                    <select name="semester" id="smt">
                        <option value="x" disabled selected>Pilih Semester...</option>
                        <option value="3" <?php if($id != null && $oldSemester = 3){echo 'selected';} ?>>Semester 3</option>
                        <option value="4" <?php if($id != null && $oldSemester = 4){echo 'selected';} ?>>Semester 4</option>
                        <option value="5" <?php if($id != null && $oldSemester = 5){echo 'selected';} ?>>Semester 5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <input type="submit">
                    <input type="reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    if($_POST and $_POST["id"] ==""){
        $nama = $_POST["nama"];
        $tgl_lahir = $_POST["tgl_lahir"];
        $ipk = $_POST["ipk"];
        $semester = $_POST["semester"];
        $sql = "INSERT INTO pendaftaran (nama, tgl_lahir, ipk, semester) VALUES ('$nama', '$tgl_lahir', '$ipk', '$semester')";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Data berhasil ditambahkan";
        }else{
            echo "Data gagal ditambahkan";
        }
    }else if($_POST and $_POST["id"] != ""){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $tgl_lahir = $_POST["tgl_lahir"];
        $ipk = $_POST["ipk"];
        $semester = $_POST["semester"];
        $sql = "UPDATE pendaftaran SET nama='$nama', tgl_lahir='$tgl_lahir', ipk='$ipk', semester='$semester' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "Data berhasil diubah";
        }else{
            echo "Data gagal diubah";
            echo mysqli_error($conn);
        }
    }
    ?>
</body>
</html>