<!-- *************************************************
    Project   : Warta Desa
    License   : All Rights Reserved
    Team      : NICHIRO SMKN KABUH
    Authors   : Jessica Arjeti Ramadhani,
                Aulia Mayninda Arini,
                Nur Indah Farahfansyah,
                Fikri Busyra Jalaludin,
                Ja’far Faruq
    Year      : 2025
    Note      : This project is proprietary and may not be copied,
                redistributed, or used by anyone without explicit
                permission from the authors.
************************************************** -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Dashboard</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

        <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

        <script src="assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {
                    families: ["Public Sans:300,400,500,600,700"]
                },
                custom: {
                    families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                    urls: ['assets/css/fonts.min.css']
                },
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/plugins.min.css" rel="stylesheet">
        <link href="assets/css/kaiadmin.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">

            <?php include "pages/sidebar.php"; ?>

            <div class="main-panel">
                <div class="main-header">
                    <?php include "pages/navbar.php"; ?>
                </div>

                <div class="container">
                    <?php
                    if (filter_has_var(INPUT_GET, 'x')) {
                        $fx = filter_input(INPUT_GET, 'x');
                        $ff = preg_replace('/[^0-9\.]/', '', $fx);
                        $get = explode(".", $ff);
                        if (count($get) > 3) {
                            $x1 = $get[0]; //andro
                            $x2 = $get[1]; //switch 
                            $x3 = $get[2]; //
                            $x4 = $get[3]; //
                            switch ($x1) {
                                case 1:
                                    include 'pages/listSurat.php';
                                    break;

                                case 2:
                                    include 'pages/detailPengajuan.php';
                                    break;

                                case 3:
                                    include 'pages/listLapor.php';
                                    break;

                                case 4:
                                    include 'pages/listBerita.php';
                                    break;

                                case 5:
                                    include 'pages/addBerita.php';
                                    break;

                                case 6:
                                    include 'pages/editBerita.php';
                                    break;

                                case 7:
                                    include 'pages/upStatBerita.php';
                                    break;

                                case 8:
                                    include 'pages/detailLaporan.php';
                                    break;

                                case 9:
                                    include 'pages/dashboard.php';
                                    break;

                                case 10:
                                    include 'pages/listNotif.php';
                                    break;

                                case 11:
                                    include 'pages/addNotif.php';
                                    break;

                                case 12:
                                    include 'pages/editNotif.php';
                                    break;

                                case 13:
                                    include 'pages/kirimNotif.php';
                                    break;

                                case 14:
                                    include 'pages/listApbdes.php';
                                    break;

                                case 15:
                                    include 'pages/addApbdes.php';
                                    break;
                                    
                                case 16:
                                    include 'pages/listWarga.php';
                                    break;
                                    
                                case 17:
                                    include 'pages/addWarga.php';
                                    break;

                                default:
                                    echo 'ts';
                                    //include 'pages/dashboard.php';
                                    break;
                            }
                        } else {
                            echo 'x kurang, buka halaman depan';
                        }
                    } else {
                        echo 'tidak ada x, buka halaman depan';
  
                    }
                    ?>
                </div>

                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                        <nav class="pull-left">
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="#">ThemeKita</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Licenses</a></li>
                            </ul>
                        </nav>
                        <div class="copyright">
                            2024 — Made with ❤️
                        </div>
                        <div>
                            Distributed by ThemeWagon.
                        </div>
                    </div>
                </footer>

            </div>
        </div>

        <script src="assets/js/core/jquery-3.7.1.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/plugin/datatables/datatables.min.js"></script>
        <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <script src="assets/js/plugin/moment/moment.min.js"></script>
        <script src="assets/js/plugin/chart.js/chart.min.js"></script>
        <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
        <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
        <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
        <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
        <script src="assets/js/kaiadmin.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#berita-table").DataTable({
                    pageLength: 10
                });
            });

            $(document).ready(function () {
                $("#permohonan-surattable").DataTable({
                    pageLength: 10,
                    ordering: true
                });
            });
            
            $(document).ready(function () {
                $("#anggotaTable").DataTable({
                    pageLength: 10,
                    ordering: true
                });
            });


            const labelData = <?= json_encode($labels) ?>;
            const valueData = <?= json_encode($values) ?>;

            // Grafik Statistik Surat
            new Chart(document.getElementById("chartSurat"), {
                type: "line",
                data: {
                    labels: labelData,
                    datasets: [{
                            label: "Jumlah Permohonan",
                            data: valueData,
                            borderWidth: 3,
                            tension: 0.3
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            new Chart(document.getElementById("dailyChart"), {
                type: "bar",
                data: {
                    labels: ["Hari Ini"],
                    datasets: [{
                            label: "Permohonan",
                            data: [<?= $dailySurat ?>],
                            borderWidth: 2
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        </script>
    </body>

</html>