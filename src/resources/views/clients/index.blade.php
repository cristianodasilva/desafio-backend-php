<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <h1>Cadastro de Clientes</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>Clientes cadastrados no sistema.</p>

    <p>
        <a href="{{ route('clients.create') }}">Cadastrar novo cliente</a>
    </p>

    @if ($clients->isEmpty())
        <p>Nenhum cliente cadastrado.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>
                            @if ($client->photo_path)
                                <img
                                    src="{{ asset('storage/' . $client->photo_path) }}"
                                    alt="Foto de {{ $client->name }}"
                                    width="60"
                                    height="60"
                                >
                            @else
                                Sem foto
                            @endif
                        </td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>
                            <a href="{{ route('clients.edit', $client) }}">Editar</a>

                            <form
                                action="{{ route('clients.destroy', $client) }}"
                                method="POST"
                                onsubmit="return confirm('Tem certeza de que deseja excluir este cliente?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>