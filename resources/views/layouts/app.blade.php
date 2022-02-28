<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://unpkg.com/boxicons@2.1.1/dist/boxicons.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body>
<div class="w-full h-screen flex">
    <div class="w-1/6 px-4">
        <ul class="">
            <li class="mt-2">
                <a href="{{ route('cpu-usage.index') }}" class="bg-gray-50 px-4 py-2 flex align-items-center rounded cursor-pointer hover:bg-blue-50 hover:shadow-sm">
                    <span class="mr-2">
                        <box-icon type='solid' name='microchip'></box-icon>
                    </span>
                    <p>CPU</p>
                </a>
            </li>
            <li class="mt-2">
                <a href="{{ route('files-manager.index') }}" class="bg-gray-50 px-4 py-2 flex align-items-center rounded cursor-pointer hover:bg-blue-50 hover:shadow-sm">
                    <span class="mr-2">
                        <box-icon name='folder' ></box-icon>
                    </span>
                    <p>Files Manager</p>
                </a>
            </li>
            <li class="mt-2">
                <a href="#" class="bg-gray-50 px-4 py-2 flex align-items-center rounded cursor-pointer hover:bg-blue-50 hover:shadow-sm">
                    <span class="mr-2">
                        <box-icon name='layer'></box-icon>
                    </span>
                    <p>Password Manager</p>
                </a>
            </li>
        </ul>
    </div>
    <div class="flex-1 px-4">
        @yield('content')
    </div>
    @stack('scripts')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
