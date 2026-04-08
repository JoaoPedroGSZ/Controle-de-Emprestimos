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
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->nome }}</div>
                                    <small class="text-muted">ID: #{{ $item->id }}</small>
                                </td>
                                <td>{{ $item->descricao }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill px-3 {{ $item->status == 'disponivel' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        @if($item->status == 'disponivel')
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#salvarModal-{{ $item->id }}">
                                                Emprestar
                                            </button>
                                        @elseif($item->status == 'emprestado')
                                            <form action="{{ route('items.devolver', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Devolver</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>

                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir este item?')">Excluir</button>
                                        </form>
                                    </div>

                                    <div class="modal fade text-start" id="salvarModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirmar Empréstimo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <form action="{{ route('items.emprestar', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Deseja emprestar o item: <strong>{{ $item->nome }}</strong>?</p>
                                                        <div class="mb-3">
                                                            <label for="name-{{ $item->id }}" class="form-label">Nome de quem está retirando:</label>
                                                            <input type="text" class="form-control" id="name-{{ $item->id }}" name="requerente" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Confirmar Empréstimo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Nenhum item cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>