<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Item - Controle de Empréstimos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
            font-family: 'Inter', sans-serif;
        }

        .custom-card-form {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            border: none;
        }

        .fw-bold {
            font-weight: 800;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Novo Item</h3>
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Voltar para a Lista</a>
        </div>

        <div class="card custom-card-form mx-auto" style="max-width: 600px;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('items.store') }}" method="POST">

                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Item</label>
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: Projetor Dell"
                        required>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="3"
                        placeholder="Detalhes sobre o item..." required></textarea>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status Inicial</label>
                    <select name="status" id="status" class="form-select">
                        <option value="disponivel">Disponível</option>
                        <option value="emprestado">Emprestado</option>

                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">Salvar Item</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>