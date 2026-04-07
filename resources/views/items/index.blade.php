<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Empréstimos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
            font-family: 'Inter', sans-serif;
        }

        .custom-card-table {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            border: none;
            /* Remove a borda padrão do card */
        }

        .fw-bold {
            font-weight: 800;
        }

        .badge {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">Controle de Empréstimos</h3>
            <a href="{{ route('items.create') }}" class="btn btn-primary">Adicionar Item</a>
        </div>

        <div class="card custom-card-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->nome }}</div>
                                    <small class="text-muted">ID: #{{ $item->id }}</small>
                                </td>
                                <td>
                                    {{ $item->descricao }}
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge rounded-pill px-3 {{ $item->status == 'disponivel' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('items.edit', $item->id) }}"
                                        class="btn btn-sm btn-edit-custom me-1">Editar</a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Excluir?')">Excluir</button>
                                    </form>
                                </td>
                                <td>
                                    @if($item->status == 'disponivel')
                                        <form action="{{ route('items.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="emprestado">
                                            <button type="submit" class="btn btn-sm btn-warning">Emprestar</button>
                                        </form>
                                    @elseif($item->status == 'emprestado')
                                        <form action="{{ route('items.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="disponivel">
                                            <button type="submit" class="btn btn-sm btn-success">Devolver</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Nenhum item cadastrado no momento.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>