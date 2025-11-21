<?php

require_once("../../../config/konekW.php");

//cek cookie
if (filter_has_var(INPUT_COOKIE, 'WD')) {
    $ck = filter_input(INPUT_COOKIE, 'WD', FILTER_UNSAFE_RAW);
    //cek sesi user
    $stm = $dbh->prepare("SELECT a.ID, a.Nama, a.fotoPP, u.adminID FROM `WDsesi` e INNER JOIN WDadminuser u ON e.userID=u.userID INNER JOIN WDuser a ON a.ID=e.userID WHERE e.Sesi=?");
    $stm->execute([$ck]);
    if ($stm->rowCount() > 0) {
        $hsl = $stm->fetchAll(PDO::FETCH_ASSOC);
        $userID = $hsl[0]['ID'];
        $foto = $hsl[0]['fotoPP'];
        $nama = $hsl[0]['Nama'];
        include 'pages/index.php';
    } else {
        echo 'Anda Bukan Admin, login kembali';
        include 'pages/BoxHomeLogin.php';
    }
} else {
    //echo 'tidak ada cookie, Login WA';
    include 'pages/BoxHomeLogin.php';
}

