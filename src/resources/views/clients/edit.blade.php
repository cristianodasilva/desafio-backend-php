<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>

    @if ($errors->any())
        <div>
            <p>Verifique os campos abaixo:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('clients.update', $client) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nome:</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $client->name) }}"
                required
            >
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email', $client->email) }}"
                required
            >
        </div>

        <div>
            <label for="phone">Telefone:</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                value="{{ old('phone', $client->phone) }}"
                required
            >
        </div>

        <div>
            <p>Foto atual:</p>

            @if ($client->photo_path)
                <img
                    src="{{ asset('storage/' . $client->photo_path) }}"
                    alt="Foto de {{ $client->name }}"
                    width="100"
                    height="100"
                >
            @else
                <p>Nenhuma foto cadastrada.</p>
            @endif
        </div>

        <div>
            <label for="photo">Nova foto (opcional):</label>
            <input
                type="file"
                id="photo"
                name="photo"
                accept="image/*"
            >
            <p>Deixe em branco para manter a foto atual. Tamanho máximo: 2 MB.</p>
        </div>

        <button type="submit">Salvar alterações</button>
    </form>

    <p>
        <a href="{{ route('clients.index') }}">Voltar para a listagem</a>
    </p>
</body>
</html>