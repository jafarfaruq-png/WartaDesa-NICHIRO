<?php
// Jenis surat
$jenisSurat = [
    1 => 'Surat Domisili',
    2 => 'Surat Keterangan Tidak Mampu',
    3 => 'Surat Keterangan Usaha'
];

// Status Admin
$statusAdmin = [
    0 => '<span class="badge badge-warning">Pending</span>',
    1 => '<span class="badge badge-success">Disetujui</span>',
    2 => '<span class="badge badge-danger">Ditolak</span>'
];

// Query daftar surat
$q = $dbh->prepare("
    SELECT p.ID, p.jnsSurat, p.statAdmin, p.statKades, 
           p.TglPengajuan, p.TglSelesai, u.Nama
    FROM WDpermohonansurat p
    INNER JOIN WDuser u ON p.userID = u.ID
    ORDER BY p.TglPengajuan DESC
");
$q->execute();
$surat = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Daftar Surat Masuk</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Administrasi</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Surat Masuk</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Permohonan Surat</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="permohonan-surattable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Tgl Selesai</th>
                                    <th>Detail</th>
                                    <th>Setujui</th>
                                    <th>Tolak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($surat as $r): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($r['Nama']) ?></td>
                                    <td><?= $jenisSurat[$r['jnsSurat']] ?? 'Tidak diketahui' ?></td>
                                    <td><?= $statusAdmin[$r['statAdmin']] ?></td>
                                    <td><?= date('d-m-Y', strtotime($r['TglPengajuan'])) ?></td>
                                    <td>
                                        <?= $r['TglSelesai'] ? date('d-m-Y', strtotime($r['TglSelesai'])) : '-' ?>
                                    </td>

                                    <td>
                                        <a href="?x=2.<?= $r['ID'] ?>.0.0" 
                                           class="btn btn-icon btn-round btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?x=approve_surat&id=<?= $r['ID'] ?>" 
                                           class="btn btn-icon btn-round btn-success">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?x=reject_surat&id=<?= $r['ID'] ?>" 
                                           class="btn btn-icon btn-round btn-danger" 
                                           onclick="return confirm('Tolak permohonan ini?')">
                                            <i class="fas fa-times"></i>
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
