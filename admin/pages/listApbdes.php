<?php
$jenisApbdes = [
    1 => 'Pendapatan',
    2 => 'Belanja',
    3 => 'Pembiayaan'
];

$q = $dbh->prepare("
    SELECT ID, Kode, Uraian, Jenis, Kategori, Jumlah, Tahun, TglInput
    FROM WDapbdes
    ORDER BY TglInput DESC
");
$q->execute();
$apb = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">APBDes</h3>
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
                <a href="#">Daftar APBDes</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data APBDes</h4>
                </div>

                <div class="card-body">
                    <a href="?x=15.0.0.0">
                        <button class="btn btn-primary mb-3">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            APBDes
                        </button>
                    </a>
                    <div class="table-responsive">
                        <table id="apbdes-table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Uraian</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Tahun</th>
                                    <th>Tanggal Input</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($apb as $r): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($r['Kode']) ?></td>
                                    <td><?= htmlspecialchars($r['Uraian']) ?></td>
                                    <td><?= $jenisApbdes[$r['Jenis']] ?? 'Lainnya' ?></td>
                                    <td><?= htmlspecialchars($r['Kategori']) ?></td>
                                    <td>Rp <?= number_format($r['Jumlah'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($r['Tahun']) ?></td>
                                    <td><?= date('d-m-Y', strtotime($r['TglInput'])) ?></td>
                                    <td>
                                        <a href="?x=8.<?= $r['ID'] ?>.0.0" class="btn btn-icon btn-round btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- card-body -->

            </div>
        </div>
    </div>
</div>
