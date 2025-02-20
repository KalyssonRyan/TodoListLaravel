<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List - Página Inicial</title>
    <!-- Link para o Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
        .hero-section {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .btn-custom {
            font-size: 1.2rem;
            padding: 12px 24px;
            border-radius: 30px;
            width: 200px;
        }
        .btn-primary-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary-custom {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .hero-title {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .hero-description {
            font-size: 1.2rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <div>
            <h1 class="hero-title">Bem-vindo ao Todo List!</h1>
            <p class="hero-description">Organize suas tarefas e aumente sua produtividade de maneira fácil e prática.</p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary-custom btn-custom">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary-custom btn-custom">Registrar</a>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
