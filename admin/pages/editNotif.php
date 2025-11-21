<?php
$id = isset($get[1]) ? (int)$get[1] : 0;


$q = $dbh->prepare("SELECT Judul, Ket FROM WDnotif WHERE ID=? LIMIT 1");
$q->execute([$id]);
$d = $q->fetch(PDO::FETCH_ASSOC);

if (!$d) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    return;
}

// proses update
if (filter_has_var(INPUT_POST, 'judul')) {
    $judul = filter_input(INPUT_POST, 'judul', FILTER_UNSAFE_RAW);
    $konten = filter_input(INPUT_POST, 'konten', FILTER_UNSAFE_RAW);

    $u = $dbh->prepare("UPDATE WDnotif SET Judul=?, Ket=? WHERE ID=?");
    $u->execute([$judul, $konten, $id]);

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    title: "Berita berhasil diedit!",
    icon: "success",
    confirmButtonText: "OK",
    customClass: {
      confirmButton: "btn btn-success"  
    }
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "?x=10.0.0.0"; 
    }
  });
</script>';
}
?>

<div class="page-inner">
    <div class="page-header">
        <h3 class="fw-bold mb-3">Edit Berita</h3>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Berita</h4>
        </div>

        <div class="card-body">
            <form method="post">

                <div class="form-group mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?= $d['Judul']; ?>" required>
                </div>

                <div class="form-group mb-3">
                    <label>Keterangan</label>
                    <textarea name="konten" class="form-control" rows="6" required><?= $d['Ket']; ?></textarea>
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>
                <a href="?x=10.0.0.0" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>
