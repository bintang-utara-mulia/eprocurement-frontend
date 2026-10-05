<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Procurement</title>
    
    <!-- Bootstrap CSS & FontAwesome CDN biar tampilan terstruktur rapi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>
<body class="bg-primary">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-35">
                        
                        <div class="login-brand text-white text-center mb-4 font-weight-bold h3">
                            E-PROCUREMENT
                        </div>

                        <div class="card card-primary shadow-lg border-0" style="border-radius: 10px;">
                            <div class="card-header bg-white pt-4 pb-2 border-0">
                                <h4 class="text-primary font-weight-bold mb-0">Login Akun</h4>
                            </div>

                            <div class="card-body">
                                <!-- autocomplete="off" untuk cegah browser ngisi email kamu otomatis -->
                                <form method="POST" action="{{ route('login') }}" autocomplete="off">
                                    @csrf
                                    
                                    <div class="form-group mb-3">
                                        <label for="email" class="text-small text-uppercase font-weight-bold">Email Address</label>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="admin@perusahaan.com" autocomplete="new-password" required autofocus>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="password" class="text-small text-uppercase font-weight-bold">Password</label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="••••••••" autocomplete="new-password" required>
                                    </div>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block font-weight-bold shadow-sm">
                                            Masuk Sistem
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="simple-footer text-white text-center mt-4">
                            Copyright &copy; 2026 E-Procurement Team
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>