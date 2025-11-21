<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="../css/theme.min.css" rel="stylesheet">
    </head>
    <body>
        <!-- section -->
        <section class="my-lg-8 my-4">
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-8 col-md-6 col-lg-3 text-center">
                        <div class="h3">Selamat Datang di <?= $namaCV; ?></div>
                        <img src="../img/serba/yantopp.jpg" alt="" class="img-fluid rounded" />
                    </div>
                    <div class="row justify-content-center align-items-center my-3">
                        <div class="col-12 col-lg-8 col-xl-6">
                            <div class="card m-1 p-2 text-center">
                                <form method="post" action="?a=0.0.0.0.0">
                                    <div class="card-header">
                                        <span class="text-danger my-1"><?= $ket; ?></span>
                                        <h5>Silahkan ketikkan Kode OTP yang anda terima</h5>
                                        <div class="h6">Kode OTP di Kirim Ke: 0<?= $hp . $btn; ?></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="inputfield">
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="number" maxlength="1" class="input" disabled />
                                            <input type="hidden" id="isi" name="isi" />
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <!-- col -->

                    </div>
                </div>
        </section>

        <script src="../js/otp.js?v=1" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>

