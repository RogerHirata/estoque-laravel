<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-slate-800 text-white p-4 mb-6 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="font-bold text-xl">Sistema Pedidos</h1>
            <div class="space-x-4">
                <a href="{{ route('categories.index') }}" class="hover:underline">Categorias</a>
                <a href="{{ route('products.index') }}" class="hover:underline">Produtos</a>
                <a href="{{ route('customers.index') }}" class="hover:underline">Clientes</a>
                <a href="{{ route('orders.index') }}" class="hover:underline">Pedidos</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>