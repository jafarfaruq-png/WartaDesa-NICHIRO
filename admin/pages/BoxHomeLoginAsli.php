<?php
$aaa=filter_input(INPUT_GET, "a"); 
if (filter_has_var(INPUT_POST, "ema") && filter_has_var(INPUT_POST, "pas"))
    {
        $ket='';
        $usr= filter_input(INPUT_POST, "ema", FILTER_VALIDATE_EMAIL);
        $pas=filter_input(INPUT_POST, "pas");
        
        if(!empty($usr) && !empty($pas)){
            $pass= sha1('Islam1924'.$pas);
            $sth = $dbh->prepare('SELECT AkunID, Pass FROM AkunName WHERE Email=?');
            $sth->execute([$usr]);
            if($sth->rowCount() > 0){
                $user=$sth->fetch(PDO::FETCH_ASSOC);
                if($user['Pass']==$pass){
                    $premd=$user['AkunID'].'Islam1'.time();
                    $md=sha1($premd);
                    $sth = $dbh->prepare("INSERT INTO SesiLogin(sesiOrg, sesiMD, sesiExp) VALUES (?,?,DATE_ADD(NOW(), INTERVAL 1 MONTH))");
                    if($sth->execute([$user['AkunID'], $md])){
                        setcookie($o, $md, time() + (86400 * 30),"/");
                        $sth = $dbh->prepare("INSERT IGNORE INTO LogTime(orgID, tgl) VALUES (?, NOW())");
                        $sth->execute([$user['AkunID']]);
                        header('Location: ./?a='.$aaa);
                        exit();
                    }
                }else {
                    $ket='Password Salah, Silahkan Hubungi Customer Service kami jika Anda lupa Password Anda';
                }
                
            }else {
                $ket='Tidak Ada User dengan Email: '.$usr.' di Data kami, Jika anda ingin menjadi member '
                        .$namaCV.' Silahkan Menghubungi Customer Service kami';
            }
        }else {
             $ket='Tidak Boleh Kosong';
        }
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $namaCV; ?></title>
        <link href="./css/mystyle.css" rel="stylesheet">
        <link href="./css/theme.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- top -->
        <div class="bg-light">
            <div class="container">
                <div class="row p-2">
                    <div class="col-8">
                       Selamat Datang di <b><?php echo $namaCV; ?> Silahkan Login dulu</b>
                    </div>
               </div>
            </div>
        </div>
        <!-- end top -->
        
        <main>
         <!-- section -->
         <section class="my-lg-14 my-8">
            <div class="container">
               <!-- row -->
               <div class="row justify-content-center align-items-center">
                  <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                     <!-- img -->
                     <img src="../img/serba/yantopp.jpg" alt="" class="img-fluid" />
                  </div>
                  <!-- col -->
                  <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                     <div class="mb-lg-9 mb-5">
                        <h1 class="mb-1 h2 fw-bold">Sign in to <?php echo $namaCV; ?></h1>
                        <p>Welcome back to <?php echo $namaCV; ?>! Enter your email to get started.</p>
                     </div>

                      <form method="post" action="./?a=<?php echo $aaa; ?>">
                        <div class="row g-3">
                            <div class="col-12">
                              <!-- input -->
                                <label for="ema" class="form-label">Email</label>
                                <input type="text" name="ema" class="form-control border-info" id="ema" value="" required>
                            </div>
                            <div class="col-12">
                              <!-- input -->
                                <label for="pas" class="form-label">Password</label>
                                <input type="password" name="pas" class="form-control border-warning" id="pas" value="" required>
                           </div>
                           <div class="col-12">
                              <div>
                                  Lupa password? <br/>
                                  Silahkan hubungi CS <?php echo $namaCV; ?> di WA: 085708007440
                              </div>
                           </div>
                           <!-- btn -->
                           <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">LogIn</button></div>
                           <!-- link -->
                           <div>
                                Belum Punya Akun? Gak Perlu Kawatir
                                <br/>
                                Silahkan <a href="?a='<?= $aaa; ?>&r=2" class="btn btn-sm btn-info">Register</a> ,kami bantu...
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </section>
      </main>
        
        <!-- end isi -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="./js/jsbase.js?v=4"></script>
    </body>
</html>