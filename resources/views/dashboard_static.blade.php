<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals Getter - Dashboard Workspace</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f7f0] min-h-screen text-gray-800">

    <header class="bg-[#2d5a27] px-6 py-4 shadow-sm text-white">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/Group 1.png') }}" alt="Goals Getter Logo" class="h-10 w-10 object-contain">
                <div class="font-bold text-xl tracking-wide">Goals Getter</div>
                
            </div>
            <nav class="flex items-center gap-6 text-white/90 font-medium">
                <a href="/" class="hover:underline">HOME</a>
                <a href="/dashboard" class="hover:underline border-b-2 border-white pb-1">USER CENTER</a>
                <a href="/settings" class="hover:underline">SETTINGS</a>
                <a href="/login" class="hover:underline">LOGOUT</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        
        @if(session('success'))
    <div class="mx-6 my-4 p-4 bg-green-100 text-green-800 rounded-2xl font-semibold text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="mx-6 my-6 grid grid-cols-1 md:grid-cols-2 gap-6 font-sans">
    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">[GOAL] Add New Goal Space</h3>
        <form action="{{ route('goals.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="title" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none" placeholder="Goal Title (e.g., Learn Laravel)">
            <div class="flex gap-2">
                <select name="category" class="w-1/2 px-4 py-2 border border-gray-200 rounded-xl text-sm bg-white">
                    <option value="Study">Study</option>
                    <option value="Fitness">Fitness</option>
                    <option value="Career">Career</option>
                </select>
                <input type="number" name="progress" min="0" max="100" value="0" class="w-1/2 px-4 py-2 border border-gray-200 rounded-xl text-sm" placeholder="Progress %">
            </div>
            <button type="submit" class="w-full bg-[#2d5a27] text-white text-xs font-bold py-2 rounded-xl uppercase tracking-wider">Save Goal</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">[USER] Add New Member</h3>
        <form action="{{ route('users.store') }}" method="POST" class="space-y-3">
            @csrf
            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none" placeholder="Full Name">
            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none" placeholder="Email Address">
            <button type="submit" class="w-full bg-[#9fbb70] text-white text-xs font-bold py-2 rounded-xl uppercase tracking-wider">Register User</button>
        </form>
    </div>
</div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Your Active Spaces</h3>
                    <div class="space-y-4">
                        @forelse($goals as $goal)
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div>
                                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-[#9fbb70] text-white uppercase">{{ $goal->category }}</span>
                                    <h4 class="text-base font-bold text-gray-800 mt-1.5">{{ $goal->title }}</h4>
                                    <div class="w-32 bg-gray-200 h-1.5 rounded-full mt-2">
                                        <div class="bg-[#2d5a27] h-1.5 rounded-full" style="width: {{ $goal->progress }}%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-bold text-gray-500">{{ $goal->progress }}%</span>
                                    <form action="{{ route('goals.destroy', $goal->id) }}" method="POST" onsubmit="return confirm('Hapus goal ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm cursor-pointer">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm italic">Belum ada goals di space ini. Silakan buat di atas!</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">[USER] Add New Member</h3>
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Full Name</label>
                                <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#9fbb70]" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Email Address</label>
                                <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-[#9fbb70]" placeholder="john@example.com">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-[#9fbb70] hover:bg-opacity-90 text-white font-semibold py-2.5 rounded-xl transition-all shadow-sm cursor-pointer">
                            Register User
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Active Users List</h3>
                        <span class="bg-[#2d5a27] text-white text-xs px-3 py-1 rounded-full font-semibold">
                            {{ $users->count() }} Users
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100 text-gray-400 text-xs font-semibold uppercase tracking-wider">
                                    <th class="pb-3">Name & Email</th>
                                    <th class="pb-3 text-right">Action</th>
                                </tr>
                            </thead>
                           <tbody class="text-gray-700 text-sm">
    @forelse($users as $user)
        <tr class="border-b border-gray-100">
            <td class="py-3 px-4">{{ $user->id }}</td>
            <td class="py-3 px-4 font-bold">{{ $user->name }}</td>
            <td class="py-3 px-4 text-gray-500">{{ $user->email }}</td>
            <td class="py-3 px-4 text-right">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="py-6 text-center text-gray-400 italic">Belum ada user terdaftar.</td>
        </tr>
    @endforelse
</tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>