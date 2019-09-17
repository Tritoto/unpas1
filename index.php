<?php
require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa"); // ORDER BY id ASC unruk atas yang paling lama, DESC untuk data yang baru diinput diatas

// jika tombol cari di klik 
if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" medthod="post">
        <input type="text" name="keyword" size="30" autofocus placeholder="masukan keyword pencarian" autocomplete="off">
        <button type="submit" name="cari">Cari!</button>
    </form>
    <br>


    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No. </th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>NRP</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

    <?php $i = 1 ; ?>
    <?php foreach( $mahasiswa as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>">hapus</a>
            </td>
            <td><img src="img/logoweb.png" width="50px"></td>
            <td><?= $row["nrp"] ?></td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["jurusan"] ?></td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
    

    </table>
    

</body>
</html>