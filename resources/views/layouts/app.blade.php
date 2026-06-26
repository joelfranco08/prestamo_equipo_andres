<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE - Control de Equipos</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #090d16;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
        }
        /* Sidebar Estilizado */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #111827 0%, #0f172a 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }
        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: #38bdf8;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-link-custom {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 500;
        }
        .nav-link-custom:hover, .nav-link-custom.active {
            background: rgba(56, 189, 248, 0.1);
            color: #38bdf8;
            transform: translateX(4px);
        }
        /* Contenedor de Contenido */
        .main-content {
            margin-left: 260px;
            padding: 3rem;
            width: calc(100% - 260px);
        }
        /* Tarjetas Estilo Glassmorphism */
        .glass-card {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-brand">
            📦 <span>SGE Hardware</span>
        </div>
     <nav class="nav flex-column">
    <a class="nav-link-custom {{ Request::is('/') ? 'active' : '' }}" href="{{ route('dashboard') }}">📊 Dashboard</a>
    <a class="nav-link-custom {{ Request::is('prestamos*') ? 'active' : '' }}" href="{{ route('prestamos.index') }}">📋 Préstamos</a>
    <a class="nav-link-custom {{ Request::is('equipos*') ? 'active' : '' }}" href="{{ route('equipos.index') }}">💻 Equipos</a>
    <a class="nav-link-custom {{ Request::is('solicitantes*') ? 'active' : '' }}" href="{{ route('solicitantes.index') }}">👥 Solicitantes</a>
</nav>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
