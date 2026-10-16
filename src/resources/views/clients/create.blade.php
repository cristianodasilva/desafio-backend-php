<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <h1>Cadastrar Cliente</h1>

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

    <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">Nome:</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div>
            <label for="phone">Telefone:</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                value="{{ old('phone') }}"
                required
            >
        </div>

        <div>
            <label for="photo">Foto:</label>
            <input
                type="file"
                id="photo"
                name="photo"
                accept="image/*"
            >
            <p>Opcional. Tamanho máximo: 2 MB.</p>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <p>
        <a href="{{ route('clients.index') }}">Voltar para a listagem</a>
    </p>
</body>
</html>