<?php
require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa")
// ambil data dari tabel mahasiswa / query dtaa mahasiswa
$result = mysqli_query($conn, "SELECT * FROM mahasiswa");

// ambil data (fetch) mahasiswa dari object result
// mysqli_fetch_row() // mengembalikan array numerik
// mysqli_fetch_assoc() // mengembalikan array associative
// mysqli_fetch_array() // mengembalikan keduanya
// mysqli_fetch_object()

// while( $mhs = mysqli_fetch_assoc($result) ) {
//     var_dump($mhs);
// }


?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman admin</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>

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
    <?php foreach( $mahasiswa as $row ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="">Ubah</a> |
                <a href="">hapus</a>
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