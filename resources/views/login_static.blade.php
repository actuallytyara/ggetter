

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>GoalsGetter — Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { 'avocado': '#A8C06A', 'avocado-light':'#EAF2D6', 'forest':'#12391f' },
          fontFamily: { poppins:['Poppins','ui-sans-serif','system-ui'], script:['Pacifico'] }
        }
      }
    }
  </script>
  <style>.icon-btn{cursor:pointer}</style>
</head>
  <body class="min-h-screen bg-[#9fbb70] flex items-center justify-center font-poppins">
  <div class="w-full max-w-md">
    <div class="bg-white rounded-xl shadow p-8">
      <div class="flex justify-between items-center mb-4">
        <a href="/landing" class="text-sm text-gray-600">Home</a>
      </div>
      <div class="flex flex-col items-center">
        <div class="w-16 h-16 rounded-full bg-avocado flex items-center justify-center text-white text-2xl">[USER]</div>
        <h2 class="mt-4 text-2xl font-bold">Login</h2>
      </div>

      <form class="mt-6 space-y-4" method="POST" action="/login">
        @csrf
        @if(session('error'))
          <div class="text-sm text-red-600">{{ session('error') }}</div>
        @endif
        <div>
          <label class="block text-sm font-medium text-gray-700">Email Address</label>
          <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-avocado-light" placeholder="you@company.com">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <div class="relative">
            <input id="password" type="password" name="password" required class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-avocado-light" placeholder="Enter your password">
            <button type="button" id="toggle" class="absolute right-2 top-2 text-gray-500">👁️</button>
          </div>
        </div>

        <div>
          <button type="submit" class="w-full bg-forest text-white py-2 rounded-md font-semibold">LOG IN</button>
        </div>
      </form>

      <div class="mt-4 text-center text-sm text-gray-600">
        <a href="#" class="underline">Forgot Password?</a>
        <div class="mt-2">Don't have an account? <a href="/register" class="text-forest font-semibold">register now</a></div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('toggle')?.addEventListener('click', function(){
      const pw = document.getElementById('password');
      if(!pw) return; pw.type = pw.type === 'password' ? 'text' : 'password';
    });
  </script>
</body>
</html>