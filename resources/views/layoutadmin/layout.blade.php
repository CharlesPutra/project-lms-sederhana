<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
      <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">

          <!-- Logo -->
          <div class="flex-shrink-0">
            <a href="#" class="text-xl font-bold text-blue-600">
              PROJECT LMS
            </a>
          </div>

          <!-- Menu Desktop -->
          <div class="hidden md:flex space-x-6">
            <a href="route('kelassiswa.index')" class="text-gray-700 hover:text-blue-600">Kelas</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Course</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Contact</a>
          </div>

          <!-- Button Mobile -->
          <div class="md:hidden">
            <button id="menu-btn" class="text-gray-700 focus:outline-none">
              ☰
            </button>
          </div>
        </div>
      </div>

      <!-- Menu Mobile -->
      <div id="menu" class="hidden md:hidden px-4 pb-4">
        <a href="route('kelassiswa.index')" class="block py-2 text-gray-700 hover:text-blue-600">kelas</a>
        <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">About</a>
        <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Course</a>
        <a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a>
      </div>
    </nav>

    <!-- Content -->
    <div class="p-6">
      <main>
        @yield('navbar')
      </main>
    </div>

    <!-- Script -->
    <script>
      const btn = document.getElementById('menu-btn');
      const menu = document.getElementById('menu');

      btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
      });
    </script>

  </body>
</html>
