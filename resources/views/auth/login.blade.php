<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - E-Procurement PT Nusantara Jaya</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #0b192c 0%, #1e3e62 50%, #000000 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
      top: -100px;
      left: -100px;
      border-radius: 50%;
    }

    body::after {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
      bottom: -150px;
      right: -150px;
      border-radius: 50%;
    }

    .login-container {
      width: 100%;
      max-width: 440px;
      padding: 15px;
      z-index: 10;
    }

    .brand-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .brand-logo {
      width: 50px;
      height: 50px;
      background: #2563eb;
      color: #fff;
      font-weight: 800;
      font-size: 24px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 12px;
      box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
    }

    .brand-title {
      color: #ffffff;
      font-weight: 800;
      letter-spacing: 1px;
      font-size: 1.3rem;
      margin: 0;
    }

    .brand-subtitle {
      color: #94a3b8;
      font-size: 0.85rem;
      margin-top: 4px;
    }

    .card-login {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
      padding: 35px 30px;
    }

    .card-login h4 {
      font-weight: 700;
      color: #0f172a;
      font-size: 1.3rem;
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: 600;
      color: #475569;
      font-size: 0.8rem;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .form-control {
      border-radius: 10px;
      height: 48px;
      border: 1.5px solid #e2e8f0;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    }

    .btn-login {
      background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
      border: none;
      border-radius: 10px;
      height: 48px;
      font-weight: 700;
      font-size: 0.95rem;
      letter-spacing: 0.5px;
      color: #fff;
      box-shadow: 0 10px 20px rgba(37, 99, 235, 0.3);
      transition: all 0.3s ease;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(37, 99, 235, 0.4);
    }

    .footer-text {
      text-align: center;
      color: #64748b;
      font-size: 0.8rem;
      margin-top: 25px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="brand-header">
      <div class="brand-logo">N</div>
      <h3 class="brand-title">E-PROCUREMENT</h3>
      <p class="brand-subtitle">PT NUSANTARA JAYA</p>
    </div>

    <div class="card-login">
      <h4>Masuk Sistem</h4>

      <form action="{{ route('login') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-group mb-3">
          <label>Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="Masukkan email..." autocomplete="off" required autofocus>
        </div>

        <div class="form-group mb-4">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-login">
          Masuk Sekarang <i class="fas fa-arrow-right ml-2"></i>
        </button>
      </form>
    </div>

    <div class="footer-text">
      Copyright &copy; 2026 E-Procurement Team
    </div>
  </div>

</body>
</html>