```html
<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        @yield('title', 'EventHub')
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a
                class="navbar-brand"
                href="{{ route('events.index') }}"
            >
                EventHub
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="navbarNav"
            >

                <ul class="navbar-nav me-auto">

                    @auth

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('events.index') }}"
                            >
                                Eventos
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('registrations.index') }}"
                            >
                                Minhas inscrições
                            </a>
                        </li>

                        @if(auth()->user()->isAdmin())

                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    href="{{ route('admin.events.index') }}"
                                >
                                    Administração
                                </a>
                            </li>

                        @endif

                    @endauth

                </ul>

                <ul class="navbar-nav">

                    @guest

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('login') }}"
                            >
                                Entrar
                            </a>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('register') }}"
                            >
                                Criar conta
                            </a>
                        </li>

                    @else

                        <li class="nav-item">
                            <span class="nav-link">
                                {{ auth()->user()->name }}
                            </span>
                        </li>

                        <li class="nav-item">
                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >
                                @csrf

                                <button
                                    class="btn btn-link nav-link"
                                    type="submit"
                                >
                                    Sair
                                </button>
                            </form>
                        </li>

                    @endguest

                </ul>

            </div>

        </div>

    </nav>

    <main class="container py-4">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

        @endif

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Verifique os dados informados:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        @yield('content')

    </main>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>

