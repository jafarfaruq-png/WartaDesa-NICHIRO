<?php
//total warga
$qUser = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDuser WHERE Status = 6");
$qUser->execute();
$totalUser = $qUser->fetch(PDO::FETCH_ASSOC)['jml'];
//permohonan masuk
$qMasuk1 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDpermohonansurat WHERE statAdmin = 0");
$qMasuk1->execute();
$masuk1 = $qMasuk1->fetch(PDO::FETCH_ASSOC)['jml'];

$qMasuk2 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDlapor WHERE Status = 0");
$qMasuk2->execute();
$masuk2 = $qMasuk2->fetch(PDO::FETCH_ASSOC)['jml'];

$totalSurat = $masuk1 + $masuk2;

//permohonan selsai
$qDone1 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDpermohonansurat WHERE statAdmin = 3");
$qDone1->execute();
$done1 = $qDone1->fetch(PDO::FETCH_ASSOC)['jml'];

$qDone2 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDlapor WHERE Status = 3");
$qDone2->execute();
$done2 = $qDone2->fetch(PDO::FETCH_ASSOC)['jml'];

$suratSelesai = $done1 + $done2;

//permohonan ditolak
$qTolak1 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDpermohonansurat WHERE statAdmin = 2");
$qTolak1->execute();
$tolak1 = $qTolak1->fetch(PDO::FETCH_ASSOC)['jml'];

$qTolak2 = $dbh->prepare("SELECT COUNT(*) AS jml FROM WDlapor WHERE Status = 2");
$qTolak2->execute();
$tolak2 = $qTolak2->fetch(PDO::FETCH_ASSOC)['jml'];

$suratDitolak = $tolak1 + $tolak2;

//permohonan baru
$tglNow = date("Y-m-d");

$qDaily1 = $dbh->prepare("SELECT COUNT(*) AS jml 
    FROM WDpermohonansurat 
    WHERE DATE(TglPengajuan) = ?");
$qDaily1->execute([$tglNow]);
$d1 = $qDaily1->fetch(PDO::FETCH_ASSOC)['jml'];

$qDaily2 = $dbh->prepare("SELECT COUNT(*) AS jml 
    FROM WDlapor 
    WHERE DATE(TglLapor) = ?");
$qDaily2->execute([$tglNow]);
$d2 = $qDaily2->fetch(PDO::FETCH_ASSOC)['jml'];

$dailySurat = $d1 + $d2;

//grafik
$qChart = $dbh->prepare("
    SELECT tgl, SUM(jml) AS total
    FROM (
        SELECT DATE(TglPengajuan) AS tgl, COUNT(*) AS jml
        FROM WDpermohonansurat
        GROUP BY DATE(TglPengajuan)
        
        UNION ALL
        
        SELECT DATE(TglLapor) AS tgl, COUNT(*) AS jml
        FROM WDlapor
        GROUP BY DATE(TglLapor)
    ) AS x
    GROUP BY tgl
    ORDER BY tgl ASC
    LIMIT 7
");
$qChart->execute();
$chart = $qChart->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$values = [];
foreach ($chart as $c) {
    $labels[] = $c['tgl'];
    $values[] = $c['total'];
}

//warga daftar baru
$qNew = $dbh->prepare("
    SELECT Nama,Nowa, TglDaftar 
    FROM WDuser 
    WHERE Status = 6 
    ORDER BY ID DESC 
    LIMIT 5
");
$qNew->execute();
$penggunaBaru = $qNew->fetchAll(PDO::FETCH_ASSOC);

?>



<div class="page-inner">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Dashboard Admin</h3>
            <h6 class="op-7 mb-2">Warta Desa - Admin Panel</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-label-info btn-round me-2">Kelola Data</a>
            <a href="#" class="btn btn-primary btn-round">Tambah Pengguna</a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total Pengguna</p>
                                <h4 class="card-title"><?= $totalUser ?? 0 ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Permohonan Masuk</p>
                                <h4 class="card-title"><?= $totalSurat ?? 0 ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Selesai</p>
                                <h4 class="card-title"><?= $suratSelesai ?? 0 ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Ditolak</p>
                                <h4 class="card-title"><?= $suratDitolak ?? 0 ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Statistik Permohonan Surat</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 350px">
                        <canvas id="chartSurat"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-primary card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Permohonan Hari Ini</div>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <h1><?= $dailySurat ?? 0 ?></h1>
                    <div class="pull-in">
                        <canvas id="dailyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <h4 class="card-title">Pengguna Terbaru</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nomor WA</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penggunaBaru ?? [] as $p): ?>
                            <tr>
                                <td><?= $p['Nama'] ?></td>
                                <td><?= $p['Nowa'] ?></td>
                                <td><?= $p['TglDaftar'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
