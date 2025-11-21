<?php
$q = $dbh->query("SELECT ID, Nama, Gender, TglLahir, Nowa, Kode, Status, fotoPP, desaID, TglDaftar, TglOtp 
                  FROM WDuser WHERE Status = 6 ORDER BY ID DESC");
$anggota = $q->fetchAll(PDO::FETCH_ASSOC);

// Mapping desa
$desaNama = [
    '3517142005' => 'Pagertanjung',
    '3517142011' => 'Ploso',
    '3517142003' => 'Kabuh'
];
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Data Anggota</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tables</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Daftar Anggota</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Semua Anggota</h4>
                </div>
                <div class="card-body">
                                        <a href="?x=5.0.0.0">
                        <button class="btn btn-primary mb-3">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Warga
                        </button>
                    </a>

                    <div class="table-responsive">
                        <table id="anggotaTable" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>No WA</th>
                                    <th>Desa</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($anggota as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>

                                    <td>
                                        <img src="../img/profil/<?= $foto;?> ?>" 
                                             class="rounded-circle" 
                                             style="width:40px;height:40px;object-fit:cover;">
                                    </td>

                                    <td><?= htmlspecialchars($a['Nama']) ?></td>

                                    <td><?= $a['Gender']==0 ? 'Laki-laki' : 'Perempuan' ?></td>

                                    <td><?= htmlspecialchars($a['Nowa']) ?></td>

                                    <td>
                                        <?= $desaNama[$a['desaID']] ?? $a['desaID'] ?>
                                    </td>

                                    <td><?= date('d-m-Y', strtotime($a['TglDaftar'])) ?></td>

                                    <td>
                                        <a href="?x=5.<?= $a['ID'] ?>.0.0" class="btn btn-icon btn-round btn-info">
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

