<?php
// Koneksi ke dtaabase
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

   // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

     //query insert data
        $query = "INSERT INTO mahasiswa
             VALUES
           ('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')
            ";
        mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //check apakah ada gambar yang diupload
    if( $error === 4) {
        echo "<sccript>
            alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    // cek apakaah yang diupload adlah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('-', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar) );
    if( !in_array($ekstensiGambar, $ekstensiGambarValid ))
    
        echo "<sccript>
            alert('yang anda upload bukan gambar!');
            </script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if ( $ukuranfile > 1000000 ) {
        echo "<sccript>
            alert('ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    // lolod pengecekan gambar siap diuloaf
    move_uploaded_file($tmpName, 'img/' . $namafile);
    return $namafile;



function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    // ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $nrp = htmlspecialchars($data["nrp"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

     //query insert data
        $query = "UPDATE mahasiswa SET
                    nrp = '$nrp',
                    nama = '$nama',
                    email = '$email',
                    jurusan = '$jurusan',
                    gambar = '$gambar'
                WHERE id = $id
                    ";
        mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM  mahasiswa
            WHERE
            nama LIKE '$keyword%' OR
            nrp LIKE '$keyword%' OR
            email LIKE '$keyword%' OR
            jurusan LIKE '$keyword%' 
                ";
    return query($query);
}


?>