<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jesh Login Layout</title>

    <!-- Laravel & Jetstream Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AngularJS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="bg-gray-800 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold">MyApp</a>
            <nav class="space-x-4">
                <!-- Jetstream Navbar Links -->
                <a href="{{ route('profile.show') }}" class="hover:underline">Profile</a>
                <a href="{{ route('logout') }}" class="hover:underline">Logout</a>
                <!-- Add more links as needed -->
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 p-4 text-white mt-8">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} MyApp. All rights reserved.
        </div>
    </footer>

    <!-- AngularJS Application Scripts -->
    <script>
        var app = angular.module('myApp', []);
    </script>
    @stack('scripts')
</body>
</html>
