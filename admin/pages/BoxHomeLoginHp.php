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
        <section class="my-lg-14 my-8">
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="../img/serba/signin_g.svg" alt="" class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-3">
                            <h1 class="mb-1 h2 fw-bold">Sign in to <?php echo $namaCV; ?></h1>
                            <p>Selamat Datang di <?php echo $namaCV; ?>! Masukkan Nomer WA untuk Masuk atau Mendaftar</p>
                        </div>
                        <form method="post" action="./?a=0.0.0.0.0">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="hp" class="form-label">Nomer WhatsApp</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">+62</span>
                                        <input type="number" name="hp" class="form-control border-info" id="hp" value="" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        Kami Akan mengirimkan kode OTP ke Nomer di Atas
                                    </div>
                                </div>
                                <!-- btn -->
                                <div class="col-12 d-grid mb-3"><button type="submit" class="btn btn-primary">Next</button></div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>