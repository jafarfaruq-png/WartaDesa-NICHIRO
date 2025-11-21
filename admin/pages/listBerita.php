<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Daftar Berita</h3>
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
                <a href="#">Daftar Berita</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Daftar Berita</h4>
                </div>

                <div class="card-body">
                    <a href="?x=5.0.0.0">
                        <button class="btn btn-primary mb-3">
                            <span class="btn-label">
                                <i class="fa fa-plus"></i>
                            </span>
                            Berita
                        </button>
                    </a>

                    <div class="table-responsive">
                        <table id="berita-table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $q = $dbh->prepare("SELECT ID, Judul, Konten, Status FROM WDberita ORDER BY ID DESC");
                                    $q->execute();
                                    $no = 1;

                                    while ($r = $q->fetch(PDO::FETCH_ASSOC)) {

                                        // badge status
                                        if ($r['Status'] == 1) {
                                            $badge = '<span class="badge badge-success">Published</span>';
                                            $btn = '<a href="?x=7.' . $r['ID'] . '.0.0" class="btn btn-icon btn-round btn-danger" title="Unpublish">
                                                        <i class="fas fa-times"></i>
                                                    </a>';
                                        } else if($r['Status'] == 2){
                                            $badge = '<span class="badge badge-warning">Draft</span>';
                                            $btn = '<a href="?x=7.' . $r['ID'] . '.0.0" class="btn btn-icon btn-round btn-success" title="Draft">
                                                        <i class="fas fa-upload"></i>
                                                    </a>';
                                            
                                        } else {
                                            $badge = '<span class="badge badge-danger">Unpublished</span>';
                                            $btn = '<a href="?x=7.' . $r['ID'] . '.0.0" class="btn btn-icon btn-round btn-success" title="Publish">
                                                        <i class="fas fa-upload"></i>
                                                    </a>';
                                        }

                                        $ket = substr(strip_tags($r['Konten']), 0, 50) . '...';

                                        echo '
                                        <tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $r['Judul'] . '</td>
                                            <td>' . $ket . '</td>
                                            <td>' . $badge . '</td>
                                            <td>
                                                <a href="?x=6.' . $r['ID'] . '.0.0" class="btn btn-icon btn-round btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                ' . $btn . '
                                            </td>
                                        </tr>';
                                    }
                                    ?>


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


