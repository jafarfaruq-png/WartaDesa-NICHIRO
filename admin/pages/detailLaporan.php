<?php
$id = isset($fa[1]) ? (int)$fa[1] : 0;

$q = $dbh->prepare("SELECT L.*, U.Nama 
                    FROM WDlapor L 
                    LEFT JOIN WDuser U ON U.ID = L.userID 
                    WHERE L.ID = ? LIMIT 1");
$q->execute([$id]);
$r = $q->fetch(PDO::FETCH_ASSOC);

if (!$r) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    exit;
}

// array jenis fasilitas
$jenisList = [
    1 => "Jalan",
    2 => "Air Bersih",
    3 => "Penerangan",
    4 => "Sarana Umum"
];

// status badge
$statusText = [
    0 => "<span class='badge badge-warning'>Pending</span>",
    1 => "<span class='badge badge-success'>Selesai</span>",
    2 => "<span class='badge badge-danger'>Ditolak</span>",
];

if (filter_has_var(INPUT_GET, 'status')) {

    // Ambil status dari GET
    $newStatus = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);
    $id        = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    // Pastikan valid
    if ($newStatus !== false && $id !== false) {
        $up = $dbh->prepare("UPDATE WDlapor SET Status=? WHERE ID=?");
        $up->execute([$newStatus, $id]);
    }

    echo "<script>location.href='?x=8.$id.0.0'</script>";
}
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Detail Laporan Warga</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item">Laporan Warga</li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item">Detail</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Laporan</h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pelapor</th>
                            <td><?= $r['Nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Fasilitas</th>
                            <td><?= $jenisList[$r['Jenis']] ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= nl2br($r['Desk']) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $statusText[$r['Status']] ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lapor</th>
                            <td><?= date("d-m-Y H:i", strtotime($r['TglLapor'])) ?></td>
                        </tr>
                    </table>

                    <h5 class="mt-4">Foto Bukti</h5>
                    <?php if ($r['Foto']) { ?>
                        <img src="uploads/lapor/<?= $r['Foto'] ?>" class="img-fluid rounded" style="max-height:350px;">
                    <?php } else { ?>
                        <div class="alert alert-secondary">Tidak ada foto bukti.</div>
                    <?php } ?>

                </div>
            </div>

        </div>

        <!-- Form Admin -->
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Aksi Admin</h4>
                </div>

                <div class="card-body">

                    <div class="mb-3">
                        <a href="?x=0.3.9.<?= $id ?>.0.0&status=1" 
                           class="btn btn-success w-100 mb-2">
                            <i class="fas fa-check"></i> Tandai Selesai
                        </a>

                        <a href="?x=0.3.9.<?= $id ?>.0.0&status=0" 
                           class="btn btn-warning w-100 mb-2">
                            <i class="fas fa-clock"></i> Jadikan Pending
                        </a>

                        <a href="?x=0.3.9.<?= $id ?>.0.0&status=2" 
                           class="btn btn-danger w-100 mb-3">
                            <i class="fas fa-times"></i> Tolak Laporan
                        </a>
                    </div>

                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Balasan Admin</label>
                            <textarea class="form-control" name="balasan" rows="4" placeholder="Tulis balasan admin..."></textarea>
                        </div>
                        <button class="btn btn-primary w-100">Kirim Balasan</button>
                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
