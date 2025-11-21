<?php
if (filter_has_var(INPUT_POST, 'Nama') && filter_has_var(INPUT_POST, 'Nowa')) {

    $Nama      = filter_input(INPUT_POST, 'Nama', FILTER_SANITIZE_SPECIAL_CHARS);
    $Gender    = filter_input(INPUT_POST, 'Gender', FILTER_SANITIZE_SPECIAL_CHARS);
    $TglLahir  = filter_input(INPUT_POST, 'TglLahir', FILTER_SANITIZE_SPECIAL_CHARS);
    $Nowa      = filter_input(INPUT_POST, 'Nowa', FILTER_SANITIZE_SPECIAL_CHARS);
    $desaID    = filter_input(INPUT_POST, 'desaID', FILTER_SANITIZE_SPECIAL_CHARS);

    // Pastikan WA mulai dengan angka 8
    if (!preg_match('/^8[0-9]{7,15}$/', $Nowa)) {
        $err = "Nomor WhatsApp harus dimulai angka 8!";
    } else {

        // Upload fotoPP (opsional)
        $fotoPP = "";
        if (!empty($_FILES['fotoPP']['name'])) {
            $fotoPP = time() . "_" . basename($_FILES['fotoPP']['name']);
            $dir = "uploads/pp/" . $fotoPP;
            move_uploaded_file($_FILES['fotoPP']['tmp_name'], $dir);
        }

        // Status default 6
        $status = 6;

        $q = $dbh->prepare("INSERT INTO WDuser 
            (Nama, Gender, TglLahir, Nowa, Status, desaID, fotoPP, TglDaftar)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

        $q->execute([$Nama, $Gender, $TglLahir, $Nowa, $status, $desaID, $fotoPP]);

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          Swal.fire({
            title: "Warga berhasil ditambahkan!",
            icon: "success",
            confirmButtonText: "OK",
            customClass: {
              confirmButton: "btn btn-success"
            }
          }).then((result) => {
            if (result.isConfirmed) {
              location.href = "?x=16.0.0.0";
            }
          });
        </script>';
    }
}
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tambah Warga</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Warga</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tambah Warga</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="card-title">Form Tambah Warga</h4></div>
                <div class="card-body">

                    <?php if (!empty($err)): ?>
                        <div class="alert alert-danger"><?= $err ?></div>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group mb-3">
                            <label for="Nama">Nama Warga</label>
                            <input type="text" name="Nama" class="form-control" placeholder="Masukkan nama..." required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="Gender">Jenis Kelamin</label>
                            <select name="Gender" class="form-select" required>
                                <option value="">Pilih...</option>
                                <option value="1">Laki-laki</option>
                                <option value="0">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="TglLahir">Tanggal Lahir</label>
                            <input type="date" name="TglLahir" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="Nowa">Nomor WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" name="Nowa" class="form-control" placeholder="81234567890" required>
                            </div>
                            <small class="text-muted">Nomor WA harus dimulai dari angka 8, tanpa 0 di depan</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="desaID">Desa</label>
                            <select name="desaID" class="form-select" required>
                                <option value="">Pilih Desa...</option>
                                <option value="3517142005">Pagertanjung</option>
                                <option value="3517142006">Karangpakel</option>
                                <option value="3517142007">Kabuh</option>
                                <option value="3517142008">Pengampon</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fotoPP">Foto Profil (Opsional)</label>
                            <input type="file" name="fotoPP" class="form-control">
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <button type="submit" name="draft" class="btn btn-warning">
                            Draft
                        </button>

                        <a href="?x=16.0.0.0">
                            <button type="button" class="btn btn-secondary float-end">Kembali</button>
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
