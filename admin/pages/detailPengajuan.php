<?php
$id = isset($get[1]) ? (int)$get[1] : 0;

// List jenis surat
$jenisSurat = [
    1 => 'Surat Domisili',
    2 => 'Surat Keterangan Tidak Mampu',
    3 => 'Surat Keterangan Usaha'
];

// Status Admin
$statusAdmin = [
    0 => '<span class="badge bg-warning">Pending</span>',
    1 => '<span class="badge bg-success">Disetujui</span>',
    2 => '<span class="badge bg-danger">Ditolak</span>'
];

// Query Data Utama
$q = $dbh->prepare("
    SELECT p.*, u.Nama 
    FROM WDpermohonansurat p
    INNER JOIN WDuser u ON p.userID = u.ID
    WHERE p.ID = ?
");
$q->execute([$id]);
$data = $q->fetch(PDO::FETCH_ASSOC);

$q2 = $dbh->prepare("SELECT nmFile, Ket FROM WDberkassurat WHERE permintaanID = ?");
$q2->execute([$id]);
$files = $q2->fetchAll(PDO::FETCH_ASSOC);


if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    exit;
}
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Preview Permohonan Surat</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Preview</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Pengajuan</h4>
                </div>

                <div class="card-body">

                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="fw-bold">Nama Pemohon</label>
                        <div class="form-control bg-light"><?= htmlspecialchars($data['Nama']) ?></div>
                    </div>

                    <!-- Jenis Surat -->
                    <div class="mb-3">
                        <label class="fw-bold">Jenis Surat</label>
                        <div class="form-control bg-light"><?= $jenisSurat[$data['jnsSurat']] ?? 'Tidak diketahui' ?></div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="fw-bold">Status Admin</label>
                        <div class="form-control bg-light"><?= $statusAdmin[$data['statAdmin']] ?></div>
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div class="mb-3">
                        <label class="fw-bold">Dokumen Pendukung</label>

                        <div class="p-3 border rounded bg-light">

                            <?php if (!$files): ?>
                                <div class="text-muted">Tidak ada dokumen.</div>
                            <?php endif; ?>

                            <?php foreach ($files as $f): ?>
                                <div class="mb-3">
                                    <p class="m-0 fw-bold"><?= htmlspecialchars($f['Ket']) ?></p>

                                    <?php 
                                        $file = "uploads/surat/" . $f['nmFile'];

                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    ?>

                                    <?php if (in_array($ext, ['jpg','jpeg','png','heif','heic'])): ?>
                                        <img src="<?= $file ?>" 
                                             class="img-fluid rounded mt-1"
                                             style="max-width:200px;">
                                    <?php elseif ($ext == 'pdf'): ?>
                                        <a href="<?= $file ?>" target="_blank" class="btn btn-sm btn-dark mt-1">
                                            Lihat PDF
                                        </a>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4">

                        <a href="?x=approve_surat&id=<?= $data['ID'] ?>" 
                           class="btn btn-success">Setujui</a>

                        <a href="?x=konfirmasi_kades&id=<?= $data['ID'] ?>" 
                           class="btn btn-warning">Konfirmasi Kades</a>

                        <a href="?x=reject_surat&id=<?= $data['ID'] ?>" 
                           class="btn btn-danger">Tolak</a>

                       <a href="?x=0.3.1.0.0.0" class="btn btn-secondary float-end">Kembali</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
