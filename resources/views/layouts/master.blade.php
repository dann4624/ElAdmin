<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - {{ config('app.name')}}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" integrity="sha384-ejwKkLla8gPP8t2u0eQyL0Q/4ItcnyveF505U0NIobD/SMsNyXrLti6CWaD0L52l" crossorigin="anonymous">
        <link  rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
        <!--
        Header with Hamburger
        <header>
            <div id="hamburger_container">
                <div id="hamburger_button" onclick="hamburger(this)">
                    <div class="hamburger_bar" id="hamburger_bar_1"></div>
                    <div class="hamburger_bar" id="hamburger_bar_2"></div>
                    <div class="hamburger_bar" id="hamburger_bar_3"></div>
                </div>
            </div>


            <div id="header_content">
                <div id="app_logo"><img src="" alt="FL"></div>
                <span id="app_name"><{{ config('app.name')}}</span>
                @if(session()->exists('fornavn'))
                       Logget ind som {{session()->get('type')}} {{session()->get('fornavn')}} {{session()->get('efternavn')}}
                @else
                    Not Logged In
                @endif
            </div>
            <div id="logout_container">
                <button href="{{route('logout')}}" id="logout_button">Logout</button>
            </div>
        </header>
             -->

        <nav id="menu" class="">
            <div id="company_logo">

                <img src="{{asset('/images/logo.png')}}" alt="Elgigaten Logo">
            </div>
            @if(session()->exists('type'))
                <span id="user_logged">{{session()->get('type')}} {{session()->get('fornavn')}} {{session()->get('efternavn')}}</span>
                @if(session()->get('type') == "Medarbejder")
                    <ul>
                        <section id="User">
                            <li><a href="{{route('home')}}"><i class="icon fa-solid fa-house"></i>Hjem</a></li>
                        </section>
                        <section id="API">
                            <li><a href="{{route('tokens.index')}}"><i class="icon fa-solid fa-certificate"></i>API Tokens</a></li>
                            <li><a href="{{route('targets.index')}}"><i class="icon fa-solid fa-certificate"></i>API Targets</a></li>
                        </section>
                        <section id="Produkter">
                            <li><a href="{{route('produkter.index')}}"><i class="icon fa-solid fa-desktop"></i>Produkter</a></li>
                            <li><a href="{{route('produkttyper.index')}}"><i class="icon fa-solid fa-desktop"></i>Produkt Typer</a></li>
                            <li><a href="{{route('modeller.index')}}"><i class="icon fas fa-solid fa-desktop"></i>Modeller</a></li>
                            <li><a href="{{route('fabrikanter.index')}}"><i class="icon fa-solid fa-desktop"></i>Fabrikanter</a></li>
                        </section>
                        <section id="Sager">
                            <li><a href="{{route('sager.index')}}"><i class="icon fa-solid fa-barcode"></i>Sager</a></li>
                            <li><a href="{{route('sagstyper.index')}}"><i class="icon fa-solid fa-barcode"></i>Sagstyper</a></li>
                            <li><a href="{{route('statuser.index')}}"><i class="icon fa-solid fa-barcode"></i>Statuser</a></li>
                            <li><a href="{{route('afhentningstyper.index')}}"><i class="icon fa-solid fa-barcode"></i>Afhentningstyper</a></li>
                        </section>
                        <section id="Personer">
                            <li><a href="{{route('medarbejdere.index')}}"><i class="icon fa-solid fa-user"></i>Medarbejdere</a></li>
                            <li><a href="{{route('kunder.index')}}"><i class="icon fa-solid fa-user"></i>Kunder</a></li>
                        </section>
                        <li><a href="{{route('logout')}}" id="logout_button"><i class="icon fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                @else
                    <ul>
                        <section id="User">
                            <li><a href="{{route('home')}}"><i class="icon fa-solid fa-user"></i>Hjem</a></li>
                        </section>
                        <section id="Mine Ting">
                            <li><a href="{{route('addresser.index')}}"><i class="icon fa-solid fa-house"></i>Mine Addresser</a></li>
                            <li><a href="{{route('Kunde.sager')}}"><i class="icon fa-solid fa-barcode"></i>Mine Sager</a></li>
                        </section>
                        <li><a href="{{route('logout')}}" id="logout_button"><i class="icon fa-solid fa-right-from-bracket"></i>Logout</a></li>
                    </ul>
                @endif

            @else
                <ul>
                    <li><a href="{{route('welcome')}}"><i class="icon fa-solid fa-house"></i>Velkommen</a></li>
                    <li><a href="{{route('login.form')}}"><i class="icon fa-solid fa-user"></i>Login</a></li>
                </ul>
            @endif
        </nav>

        <main>
            <h1 id="page_title">@yield('title')</h1>
            @include('flash')
            <section id="content">
                @yield('content')
            </section>
        </main>
        <script>
            function hamburger(x) {
                x.classList.toggle("change");
                let menu = document.getElementById("menu");
                if(menu.classList.contains('hidden')){
                    menu.classList.remove("hidden");
                    menu.classList.add("shown");
                }
                else if(menu.classList.contains('shown')){
                    menu.classList.remove("shown");
                    menu.classList.add("hiding");
                    setTimeout(function() {
                        menu.classList.remove("hiding");
                        menu.classList.add("hidden");
                    }, 1989);
                }
            }
        </script>
    </body>
</html>
