<?php
$id = isset($get[1]) ? (int)$get[1] : 0;

$q = $dbh->prepare("SELECT Status FROM WDberita WHERE ID = ? LIMIT 1");
$q->execute([$id]);
$r = $q->fetch(PDO::FETCH_ASSOC);

if (!$r) {
    echo "<script>alert('Berita tidak ditemukan!'); location.href='?x=3.4.0.0.0';</script>";
    exit;
}

// Toggle Status:
// Jika 1 (Published) → ubah ke 2 (Unpublished)
// Jika 2 (Unpublished) → ubah ke 1 (Published)
$newStatus = ($r['Status'] == 1) ? 0 : 1;

// Update status
$u = $dbh->prepare("UPDATE WDberita SET Status = ? WHERE ID = ?");
$u->execute([$newStatus, $id]);

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    title: "Status berita berhasil diperbarui!",
    icon: "success",
    confirmButtonText: "OK",
    customClass: {
      confirmButton: "btn btn-success"  // Menambahkan kelas CSS untuk tombol OK
    }
  }).then((result) => {
    if (result.isConfirmed) {
      location.href = "?x=4.0.0.0";  // Pengalihan halaman setelah tombol "OK" diklik
    }
  });
</script>';
?>