<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Emprestimos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa; /* Um cinza claro para destacar o card */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-container {
        width: 100%;
        max-width: 400px; /* Impede que o formulário estique demais */
        padding: 15px;
    }

    .login-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .subtitle {
        color: #6c757d;
        font-size: 0.9rem;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
           <h2 class="text-center mb-4">Login</h2>
           <p class="subtitle">Faça login para acessar o sistema de controle de empréstimos</p>
              <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
                 <div class="text-center mt-4">
                    <p class="subtitle small mb-0">
                        Já possui uma conta? <a href="{{ route('cadastro') }}" class="back-link">Crie uma conta</a>
                    </p>
                </div>
        </div>
    </div>
    
</body>
</html>