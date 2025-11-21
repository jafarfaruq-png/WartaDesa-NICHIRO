<?php
if (
    filter_has_var(INPUT_POST, 'judul') &&
    filter_has_var(INPUT_POST, 'konten') &&
    filter_has_var(INPUT_POST, 'tempat') &&
    filter_has_var(INPUT_POST, 'tgl_publish') &&
    filter_has_var(INPUT_POST, 'jam_publish')
) {

    $judul   = filter_input(INPUT_POST, 'judul', FILTER_UNSAFE_RAW);
    $konten  = filter_input(INPUT_POST, 'konten', FILTER_UNSAFE_RAW);
    $tempat  = filter_input(INPUT_POST, 'tempat', FILTER_UNSAFE_RAW);
    $status  = 1;
    $penulisID = $userID ?? 0;

    $tgl = filter_input(INPUT_POST, 'tgl_publish', FILTER_UNSAFE_RAW);
    $jam = filter_input(INPUT_POST, 'jam_publish', FILTER_UNSAFE_RAW);

    $tglFull = $tgl . " " . $jam . ":00";

    $q = $dbh->prepare("INSERT INTO WDnotif 
        (Judul, Ket, Tempat, Status, authorID, TglAcara) 
        VALUES (?, ?, ?, ?, ?, ?)");

    $q->execute([$judul, $konten, $tempat, $status, $penulisID, $tglFull]);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    title: "Pengunguman berhasil disimpan!",
    icon: "success",
    confirmButtonText: "OK",
    customClass: { confirmButton: "btn btn-success" }
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "?x=0.3.10.0.0.0"; 
    }
  });
</script>';
}
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Tambah Pengunguman</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Pengunguman</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Tambah Pengunguman</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Pengunguman</h4>
                </div>
                <div class="card-body">

                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="judul">Judul Pengunguman</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul pengunguman..." required>
                        </div>

                        <div class="form-group">
                            <label for="konten">Keterangan Pengunguman</label>
                            <textarea name="konten" class="form-control" rows="5" placeholder="Tulis isi keterangan..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" name="tempat" class="form-control" placeholder="Masukkan tempat pengumuman..." required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_publish">Tanggal Acara</label>
                            <input type="date" name="tgl_publish" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jam_publish">Jam Acara</label>
                            <input type="time" name="jam_publish" class="form-control" required>
                        </div>


                        <button type="submit" name="simpan" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>

                    </form>

                    <a href="?x=0.3.10.0.0.0"><button type="button" name="back" class="btn btn-secondary float-end">
                            Kembali
                        </button></a>

                </div>
            </div>
        </div>
    </div>
</div>