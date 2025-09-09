<!DOCTYPE html>
<html lang="en"  data-theme="light">
<head>
 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,900" rel="stylesheet" />
         @vite('resources/css/app.css')
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            
        @endif
        @fluxAppearance
        @livewireStyles

</head>
<body class="bg-white text-gray-800">
    <header>
        <livewire:navbar />
    </header>
    <main class="p-6">
        {{ $slot  }}
    </main>
    @livewireScripts
     @fluxAppearance
</body>
</html>