 <!DOCTYPE html>     
<html lang = "pt-br">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link rel = "stylesheet" href = "/css/style.css">
        <script src = "/js/script.js"></script> 

        <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"> 
        
    </head> 
    
    <body>
    <header>
        <nav class = "navbar navbar-expand-lg navbar-light">
            <div class = "collapse navbar-collapse" id = "nav bar">
                <a href = "/" class = "navbar-brand">
                    <img src = "/img/" alt="nome ">
                </a>
                <ul class ="navbar-nav">

                    <li class = "nav-item">
                        <a href = "/" class = "nav-link">Home</a>
                    </li>


                    <li class = "nav-item">
                        <a href = "/events/create" class = "nav-link">criar novas receitas</a>
                    </li>


                    <li class = "nav-item">
                        <a href = "/" class = "nav-link">minhas receitas       </a>
                    </li>


                    <li class = "nav-item"
                        <a href = "/" class = "nav-link">perfil</a>
                    </li>


                    <li class = "nav-item">
                        <a href = "/" class = "nav-link">favoritos</a>
                    </li>


                </ul>

        </nav>

</header>
        @yield('content')

    <footer>
        <p>Para nossas receitas &copy; 2026</p>
    </footer>

        <script  type = "module"  src = " https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js " > </script> 
        <script nomodule src = " https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js " >  
     </script>
 

    </body>

</html>