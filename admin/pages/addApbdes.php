<?php

if (filter_has_var(INPUT_POST, 'simpan')) {

    $kode     = trim(filter_input(INPUT_POST, 'Kode', FILTER_SANITIZE_SPECIAL_CHARS));
    $uraian   = trim(filter_input(INPUT_POST, 'Uraian', FILTER_SANITIZE_SPECIAL_CHARS));
    $jenis    = filter_input(INPUT_POST, 'Jenis', FILTER_VALIDATE_INT);
    $kategori = trim(filter_input(INPUT_POST, 'Kategori', FILTER_SANITIZE_SPECIAL_CHARS));
    $jumlah   = filter_input(INPUT_POST, 'Jumlah', FILTER_VALIDATE_INT);
    $tahun    = filter_input(INPUT_POST, 'Tahun', FILTER_VALIDATE_INT);

 
    if ($kode && $uraian && $jenis && $kategori && $jumlah && $tahun) {

        $q = $dbh->prepare("
            INSERT INTO WDapbdes (Kode, Uraian, Jenis, Kategori, Jumlah, Tahun, TglInput)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");

        if ($q->execute([$kode, $uraian, $jenis, $kategori, $jumlah, $tahun])) {
            echo '<div class="alert alert-success">Data APBDes berhasil ditambahkan!</div>';
        } else {
            echo '<div class="alert alert-danger">Gagal menambah data.</div>';
        }

    } else {
        echo '<div class="alert alert-warning">Semua field wajib diisi!</div>';
    }
}
?>

<div class="page-inner">
    <div class="page-header">
        <h4 class="fw-bold">Tambah Data APBDes</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Input APBDes</h4>
                </div>

                <div class="card-body">
                    <form method="post">

                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" name="Kode" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Uraian</label>
                            <textarea name="Uraian" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="Jenis" class="form-control" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="1">Pendapatan</option>
                                <option value="2">Belanja</option>
                                <option value="3">Pembiayaan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kategori</label>
                            <input type="text" name="Kategori" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Jumlah (Rp)</label>
                            <input type="number" name="Jumlah" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="Tahun" class="form-control" value="<?= date('Y') ?>" required>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            Simpan Data
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
