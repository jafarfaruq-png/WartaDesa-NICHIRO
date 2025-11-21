<?php
if (filter_has_var(INPUT_POST, 'judul') && filter_has_var(INPUT_POST, 'konten')) {

    $judul  = filter_input(INPUT_POST, 'judul', FILTER_UNSAFE_RAW);
    $konten = filter_input(INPUT_POST, 'konten', FILTER_UNSAFE_RAW);

    // status
    if (filter_has_var(INPUT_POST, 'simpan')) {
        $status = 1;
    } elseif (filter_has_var(INPUT_POST, 'draft')) {
        $status = 2;
    } else {
        $status = 1;
    }

    // Upload banyak gambar (3 input)
$imgList = [];

if (!empty($_FILES['img']['name'][0])) {
    for ($i = 0; $i < count($_FILES['img']['name']); $i++) {

        if (!empty($_FILES['img']['name'][$i])) {

            $namaBaru = time() . "_" . basename($_FILES['img']['name'][$i]);
            $tujuan = "uploads/berita/" . $namaBaru;

            move_uploaded_file($_FILES['img']['tmp_name'][$i], $tujuan);

            $imgList[] = $namaBaru;
        }
    }
}

$imgJson = json_encode($imgList);
$jmlGbr  = count($imgList);

$penulisID = $userID ?? 0;

$q = $dbh->prepare("INSERT INTO WDberita 
    (Judul, Konten, Img, jmlGbr, Status, penulisID, TglPublish) 
    VALUES (?, ?, ?, ?, ?, ?, NOW())");

$q->execute([$judul, $konten, $imgJson, $jmlGbr, $status, $penulisID]);


    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    title: "Berita berhasil disimpan!",
    icon: "success",
    confirmButtonText: "OK",
    customClass: { confirmButton: "btn btn-success" }
}).then((r) => {
    if (r.isConfirmed) { location.href="?x=4.0.0.0"; }
});
</script>';
}
?>


<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tambah Berita</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Berita</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tambah Berita</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Berita</h4>
                </div>

                <div class="card-body">

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul berita..." required>
                        </div>

                        <div class="form-group">
                            <label for="konten">Konten Berita</label>
                            <textarea name="konten" class="form-control" rows="5" placeholder="Tulis isi berita..." required></textarea>
                        </div>

                        <label for="img">Gambar</label>
                        <div class="row mb-3">
                            <div class="col-4"><input type="file" name="img[]" class="form-control"></div>
                            <div class="col-4"><input type="file" name="img[]" class="form-control"></div>
                            <div class="col-4"><input type="file" name="img[]" class="form-control"></div>
                        </div>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                        <button type="submit" name="draft" class="btn btn-warning">
                            Draft
                        </button>

                        <a href="?x=4.0.0.0" class="btn btn-secondary float-end">Kembali</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
