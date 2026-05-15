<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> 

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @stack('styles')

    <script src="/js/script.js" defer></script> 
</head> 

<body>
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="{{ route('home') }}" class="logo-circulo"></a>
                <a href="#">Receitas salgadas</a>
                <a href="#">Receitas doces</a>
                <a href="#">Ultimas Receitas</a>
                <a href="{{ route('recipes.create') }}">Publicar uma nova Receita</a>
            </div>

            <div class="nav-right">
                <div class="search-container">
                    <input type="text" class="search-bar" placeholder="Pesquisar...">
                </div>
                <a href="{{ route('profile') }}" class="perfil-icon">👤</a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-4">
        <p>Para nossas receitas &copy; 2026</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script> 
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>