<?php
require_once 'pages/function.php';

$notifID = isset($get[1]) ? (int)$get[1] : 0;

// data notif
$q = $dbh->prepare("SELECT Judul, Ket, Tempat, TglAcara 
                    FROM WDnotif 
                    WHERE ID=? LIMIT 1");
$q->execute([$notifID]);
$notif = $q->fetch(PDO::FETCH_ASSOC);

if (!$notif) {
    die("Notifikasi tidak ditemukan");
}

// Format Indonesia
$hari = ['Sunday'=>'Minggu',
        'Monday'=>'Senin',
        'Tuesday'=>'Selasa',
        'Wednesday'=>'Rabu',
        'Thursday'=>'Kamis',
        'Friday'=>'Jumat',
        'Saturday'=>'Sabtu'];
$bulan = ['January'=>'Januari',
        'February'=>'Februari',
        'March'=>'Maret',
        'April'=>'April',
        'May'=>'Mei',
        'June'=>'Juni',
        'July'=>'Juli',
        'August'=>'Agustus',
        'September'=>'September',
        'October'=>'Oktober',
        'November'=>'November',
        'December'=>'Desember'];

$hariInggris  = date('l', strtotime($notif['TglAcara']));
$tgl          = date('d', strtotime($notif['TglAcara']));
$bulanInggris = date('F', strtotime($notif['TglAcara']));
$tahun        = date('Y', strtotime($notif['TglAcara']));
$jam          = date('H:i', strtotime($notif['TglAcara']));

//tgl indo
$tanggalIndo = $hari[$hariInggris] . ", " . $tgl . " " . $bulan[$bulanInggris] . " " . $tahun;

// Format pesan
$pesan = "📢 *PENGUMUMAN DESA*\n\n"
        ."*{$notif['Judul']}*\n"
        ."{$notif['Ket']}\n\n"
        ."📅 *Tanggal:* {$tanggalIndo}\n"
        ."⏰ *Jam:* {$jam} WIB\n"
        ."📍 *Tempat:* {$notif['Tempat']}";

$q = $dbh->prepare("SELECT ID, Nowa FROM WDuser WHERE Status=6 AND Nowa IS NOT NULL");
$q->execute();
$list = $q->fetchAll(PDO::FETCH_ASSOC);

foreach ($list as $u) {

    $ins = $dbh->prepare("INSERT INTO WDtarget 
        (targetID, notifID, Jenis, TglKirim)
        VALUES (?, ?, 1, NOW())");
    $ins->execute([$u['ID'], $notifID]);

    // Kirim WA
    Kirimfonnte($token, [
        "target"  => "0" . $u['Nowa'],
        "message" => $pesan
    ]);
}

echo "<script>alert('Pengumuman berhasil dikirim ke semua warga');location.href='?x=10.0.0.0';</script>";
