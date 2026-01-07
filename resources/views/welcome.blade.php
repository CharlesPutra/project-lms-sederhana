<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LMS - Learning Management System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Tailwind bawaan Laravel --}}
    <style>
        body { font-family: Figtree, sans-serif; }
    </style>
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900">

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-6 py-4 bg-white dark:bg-gray-800 shadow">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
            📘 LMS Sederhana
        </h1>

        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="text-sm font-semibold text-blue-600 hover:underline">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-gray-600 dark:text-gray-300 hover:underline">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="text-sm font-semibold text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    {{-- Hero Section --}}
    <section class="flex flex-col items-center justify-center text-center px-6 py-20">
        <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-4">
            Learning Management System
        </h2>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mb-8">
            Platform pembelajaran online sederhana untuk mengelola kelas,
            materi, dan tugas siswa secara terstruktur dan mudah digunakan.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700">
                Mulai Belajar
            </a>
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600">
                Daftar Akun
            </a>
        </div>
    </section>

    {{-- Fitur LMS --}}
    <section class="max-w-6xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                    📚 Manajemen Kelas
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Guru dapat membuat dan mengelola kelas dengan mudah.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                    📄 Materi Pembelajaran
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Upload dan akses materi pembelajaran kapan saja.
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                    📝 Tugas & Penilaian
                </h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                    Siswa mengumpulkan tugas dan mendapatkan nilai secara online.
                </p>
            </div>

        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-center py-6 text-sm text-gray-500 dark:text-gray-400">
        © {{ date('Y') }} LMS Sederhana • Laravel {{ Illuminate\Foundation\Application::VERSION }}
    </footer>

</body>
</html>
