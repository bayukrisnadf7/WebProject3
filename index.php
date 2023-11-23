<?php
include 'koneksi.php';
session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
//     header("Location: php/login/indexlogin.php");
//     exit();
// }

// $result1 = mysqli_query($conn, "SELECT COUNT(*) as total_guru FROM tb_guru");
// $row = mysqli_fetch_assoc($result1);
// $total_guru = $row['total_guru'];

// $result2 = mysqli_query($conn, "SELECT COUNT(*) as total_siswa FROM tb_siswa");
// $row = mysqli_fetch_assoc($result2);
// $total_siswa = $row['total_siswa'];

$query = "SELECT tb_jadwal.id_jadwal, tb_guru.nama_guru, tb_kelas.nama_kelas, tb_mapel.nama_mapel, tb_jadwal.hari, tb_jadwal.jam_mulai, tb_jadwal.jam_selesai
            FROM tb_jadwal JOIN tb_guru on tb_jadwal.nip = tb_guru.nip
            JOIN tb_kelas on tb_jadwal.id_kelas = tb_kelas.id_kelas
            JOIN tb_mapel on tb_jadwal.id_mapel = tb_mapel.id_mapel;";
$sql = mysqli_query($conn, $query);
$no = 0;
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Reporthing</title>
    <link href="img/logo_putih.png" rel="shortcut icon">
    <!-- Bootstrap -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="asset/fontawesome/css/all.min.css">
    <!-- Data Tables-->
    <link rel="stylesheet" type="text/css" href="asset/datatables/datatables.css">
    <script type="text/javascript" src="asset/datatables/datatables.js"></script>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" /> -->
    <!-- <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="asset/css/style.css" />
</head>

<script type="text/javascript">
    $(document).ready(function () {
        $('#dt').DataTable();
    });
</script>

<body>
    <!-- ======== Main wrapper for dashboard =========== -->
    <div class="wrapper">
        <!-- =========== Sidebar for admin dashboard =========== -->
        <aside id="sidebar">
            <!-- ======== Content For Sidebar ========-->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#"><img src="img/logo_putih.png" alt="homepage" class="dark-logo"
                            style="width: 10%; margin-right: 2px; margin-bottom: 3px;" /> Reporthing</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link active">
                            <i class="fa-solid fa-gauge pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/guru/indexguru.php" class="sidebar-link">
                            <i class="fa-solid fa-user-tie pe-2"></i>
                            Guru
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/siswa/indexsiswa.php" class="sidebar-link">
                            <i class="fa-solid fa-user-graduate pe-2"></i>
                            Siswa
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/kelas/indexkelas.php" class="sidebar-link">
                            <i class="fa-solid fa-chalkboard pe-1"></i>
                            Kelas
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/mapel/indexmapel.php" class="sidebar-link">
                            <i class="fa-solid fa-book pe-2"></i>
                            Mata Pelajaran
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/tahunajaran/indexajaran.php" class="sidebar-link">
                            <i class="fa-solid fa-graduation-cap pe-1"></i>
                            Tahun Ajaran
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="php/jadwal/indexjadwal.php" class="sidebar-link">
                            <i class="fa-solid fa-calendar-days pe-2"></i>
                            Jadwal
                        </a>
                    </li>
                    <!-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-list pe-2"></i>
                            Pengguna
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="php/pengguna/guru/indexpenggunaguru.php" class="sidebar-link">
                                    <i class="fa-regular fa-circle pe-2"></i> Guru</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="php/pengguna/siswa/indexpenggunasiswa.php" class="sidebar-link">
                                    <i class="fa-regular fa-circle pe-2"></i> Siswa</a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
                <!-- ======= Navigation links for sidebar ======== -->
                <ul class="sidebar-nav"></ul>
            </div>
        </aside>

        <!-- ========= Main section of dashboard ======= -->
        <div class="main">
            <!-- ========= Main navbar section of dashboard ======= -->
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="img/profile1.png" class="avatar img-fluid rounded-circle" alt="" />
                                <i class="fas fa-caret-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal">Profile</a>
                                <a href="logout.php" class="dropdown-item"
                                    onClick="return confirm('Anda yakin ingin logout?')">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Modal untuk Profile -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk mengedit profil -->
                            <form action="editprofile.php" method="post">
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Admin</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========= Main content section of dashboard ======= -->
            <main class="content px-3 py-2">
                <div class="content-fluid">
                    <div class="mb-3">
                        <h4>Dashboard Admin</h4>
                    </div>
                    <div class="row">
                        <style>
                            .custom-card {
                                position: relative;
                                overflow: hidden;
                                border: none;
                                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                                width: 250px;
                                /* Atur lebar card sesuai keinginan Anda */
                                height: 80px;
                                /* Atur tinggi card sesuai keinginan Anda */
                                text-indent: 5px;
                                line-height: 20px;
                            }

                            .custom-bg-danger,
                            .custom-bg-primary,
                            .custom-bg-warning,
                            .custom-bg-success {
                                position: absolute;
                                top: 0;
                                left: 0;
                                bottom: 0;
                                width: 3%;
                            }

                            .custom-bg-danger {
                                background-color: #dc3545;
                            }

                            .custom-bg-primary {
                                background-color: #0d6efd;
                            }

                            .custom-bg-warning {
                                background-color: #ffc107;
                            }

                            .custom-bg-success {
                                background-color: #198754;
                            }

                            .card-title {
                                font-size: 20px;
                            }
                        </style>

                        <div class="col-12 col-md-3 d-flex">
                            <div class="card flex-fill border-0 custom-card">
                                <div class="card-body position-relative">
                                    <i class="fas fa-user fa-3x"
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #D0D4CA"></i>
                                    <p class="card-title">100</p>
                                    <h6 class="card-text" style="color: #0d6efd">Pengguna Guru</h6>
                                </div>
                                <div class="custom-bg-primary"></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 d-flex">
                            <div class="card flex-fill border-0 custom-card">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-group fa-3x"
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #D0D4CA"></i>
                                    <p class="card-title">100</p>
                                    <h6 class="card-text" style="color: #198754">Pengguna Siswa</h6>
                                </div>
                                <div class="custom-bg-success"></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 d-flex">
                            <div class="card flex-fill border-0 custom-card">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-tie fa-3x"
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #D0D4CA"></i>
                                    <p class="card-title">100</p>
                                    <h6 class="card-text" style="color: #ffc107">Jumlah Guru</h6>
                                </div>
                                <div class="custom-bg-warning"></div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3 d-flex">
                            <div class="card flex-fill border-0 custom-card">
                                <div class="card-body">
                                    <i class="fa-solid fa-user-graduate fa-3x"
                                        style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); color: #D0D4CA"></i>
                                    <p class="card-title">100</p>
                                    <h6 class="card-text" style="color: #dc3545">Jumlah Siswa</h6>
                                </div>
                                <div class="custom-bg-danger"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header mt-2" style="background-color: #FFFFFF;">
                            <h6>Jadwal</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dt" class="table table-hover">
                                    <thead class="custom-header">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Hari</th>
                                            <th scope="col">Jam</th>
                                            <th scope="col">Nama Pelajaran</th>
                                            <th scope="col">Guru</th>
                                            <th scope="col">Kelas</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($result = mysqli_fetch_assoc($sql)) {
                                            ?>
                                            <td>
                                                <?php echo ++$no; ?>.
                                            </td>
                                            <td>
                                                <?php echo $result['hari']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['jam_mulai'] . ' - ' . $result['jam_selesai']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['nama_mapel']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['nama_guru']; ?>
                                            </td>
                                            <td>
                                                <?php echo $result['nama_kelas']; ?>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="asset/js/script.js"></script>
</body>

</html>