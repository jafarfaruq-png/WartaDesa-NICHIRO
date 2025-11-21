<?php
$jenisFasilitas = [
    1 => 'Jalan',
    2 => 'Air Bersih',
    3 => 'Penerangan',
    4 => 'Sarana Umum'
];

// Mapping Status
$statusLabel = [
    0 => '<span class="badge badge-warning">Pending</span>',
    1 => '<span class="badge badge-success">Selesai</span>',
    2 => '<span class="badge badge-danger">Ditolak</span>'
];

// Ambil data laporan
$q = $dbh->prepare("
    SELECT l.ID, l.Jenis, l.Desk, l.Foto, l.Status, l.TglLapor, u.Nama 
    FROM WDlapor l
    INNER JOIN WDuser u ON l.userID = u.ID
    ORDER BY l.TglLapor DESC
");
$q->execute();
$laporan = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Cepat Lapor</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Tables</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Daftar Laporan</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Laporan Warga</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
    <table id="permohonan-surattable" class="display table table-striped table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Jenis Fasilitas</th>
                <th>Keterangan</th>
                <th>Tanggal Laporan</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($laporan as $r): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($r['Nama']) ?></td>
                <td><?= $jenisFasilitas[$r['Jenis']] ?? 'Lainnya' ?></td>
                <td><?= htmlspecialchars($r['Desk']) ?></td>
                <td><?= date('d-m-Y', strtotime($r['TglLapor'])) ?></td>
                <td><?= $statusLabel[$r['Status']] ?? '<span class="badge badge-secondary">Unknown</span>' ?></td>
                <td>
                    <a href="?x=8.<?= $r['ID'] ?>.0.0" class="btn btn-icon btn-round btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
                </div>
            </div>
        </div>
    </div>
</div>