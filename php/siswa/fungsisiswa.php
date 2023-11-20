<?php
include '../../koneksi.php';
function tambah_data($data, $files)
{

    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $kelas = $data['id_kelas'];
    $tahun_ajaran = $data['id_tahunajaran'];
    $no_telp = $data['no_telp'];
    $tanggal_lahir = $data['tanggal_lahir'];
    $username = $data['username'];
    $password = $data['password'];

    // Cek apakah NISN sudah ada
    $queryCekNISN = "SELECT * FROM tb_siswa WHERE nisn = '$nisn'";
    $resultCekNISN = mysqli_query($GLOBALS['conn'], $queryCekNISN);

    if (mysqli_num_rows($resultCekNISN) > 0) {
        $_SESSION['eksekusi'] = "Gagal menambahkan data. NISN sudah terdaftar.";
        header("location: indexsiswa.php");
        return false;
    }

    $split = explode('.', $files['foto']['name']);
    $ekstensi = $split[count($split) - 1];

    $foto = $nisn . '.' . $ekstensi;

    //destination
    $dir = "../../img/";
    //filename
    $tmpFile = $files['foto']['tmp_name'];
    //memindahkan
    move_uploaded_file($tmpFile, $dir . $foto);

    $query = "INSERT INTO tb_siswa VALUES('$nisn', '$nama_siswa', '$kelas', '$tahun_ajaran', '$no_telp', '$tanggal_lahir', '$username', '$password', '$foto')";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function ubah_data($data, $files)
{
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $kelas = $data['id_kelas'];
    $tahun_ajaran = $data['id_tahunajaran'];
    $no_telp = $data['no_telp'];
    $tanggal_lahir = $data['tanggal_lahir'];
    $username = $data['username'];
    $password = $data['password'];
    
    $queryShow = "SELECT * FROM tb_siswa WHERE nisn = '$nisn';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($files['foto']['name'] == "") { //kosong
        $foto = $result['foto_siswa'];
    } else { //ada isi/foto/file

        $split = explode('.', $files['foto']['name']);
        $ekstensi = $split[count($split) - 1];

        $foto = $result['nisn'] . '.' . $ekstensi;
        unlink("../../img/" . $result['foto_siswa']);
        move_uploaded_file($files['foto']['tmp_name'], '../../img/' . $foto);
    }

    $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', id_kelas='$kelas', id_tahunajaran='$tahun_ajaran',  no_telp='$no_telp', tanggal_lahir='$tanggal_lahir', username='$username', password='$password', foto_siswa='$foto' WHERE nisn='$nisn';";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function hapus_data($data)
{
    $nisn = $data['hapus'];

    //foto
    $queryShow = "SELECT * FROM tb_siswa WHERE nisn = '$nisn';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    //var_dump($result);

    //menghapus
    unlink("../../img/" . $result['foto_siswa']);


    $query = "DELETE FROM tb_siswa WHERE nisn = '$nisn';";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;

}

?>