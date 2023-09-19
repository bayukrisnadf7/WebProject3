<?php
include 'koneksi.php';

$query = "SELECT * FROM tb_siswa;";
$sql = mysqli_query($conn, $query);
$no = 0;
?>

<!DOCTYPE php>
<php>

  <head>
    <meta charset="UTF-8">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <title>SDN JUMERTO 02</title>
  </head>

  <body>
    <nav class="navbar navbar-light bg-primary">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">
          <strong>
            &nbsp;MySchool
          </strong> - Sistem Informasi Akademik Sekolah
        </a>
      </div>
    </nav>

    <!-- Judul -->
    <div class="container">
      <h1 class="mt-4">Data Siswa</h1>
      <figure>
        <blockquote class="blockquote">
          <p>Halaman Untuk Mengelola Data Siswa</p>
        </blockquote>
      </figure>

      <!-- Button Tambah Data -->
      <a href="kelola.php" type="button" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i>
        Tambah Data
      </a>

      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <!-- Tabel -->
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>
                <center>No.</center>
              </th>
              <th>
                <center>NISN</center>
              </th>
              <th>
                <center>Nama Siswa</center>
              </th>
              <th>
                <center>Jenis Kelamin</center>
              </th>
              <th>
                <center>Foto Siswa</center>
              </th>
              <th>
                <center>Alamat</center>
              </th>
              <th>
                <center>Aksi</center>
              </th>
            </tr>
          </thead>

          <!-- Tabel Body -->
          <tbody>
            <?php
            while ($result = mysqli_fetch_assoc($sql)) {
              ?>
              <tr>
                <td>
                  <center>
                    <?php echo ++$no; ?>.
                  </center>
                </td>
                <td>
                  <?php echo $result['nisn']; ?>
                </td>
                <td>
                  <?php echo $result['nama_siswa']; ?>
                </td>
                <td>
                  <?php echo $result['jenis_kelamin']; ?>
                </td>
                <td>
                  <img src="img/<?php echo $result['foto_siswa']; ?>" style="width: 150px; height: 100px;">
                </td>
                <td>
                  <?php echo $result['alamat']; ?>
                </td>
                
                <!-- Button UBAH dan HAPUS-->
                <td>
                  <center>
                    <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button"
                      class="btn btn-success btn-sm">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" type="button"
                      class="btn btn-danger btn-sm" onClick="return confirm('Ingin menghapus data tersebut?')">
                      <i class="fa fa-trash"></i>
                    </a>
                </td>
                </center>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</php>