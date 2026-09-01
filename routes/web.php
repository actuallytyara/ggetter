<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\TaskController;
use App\Models\User;
use App\Models\Goal;
use App\Models\Habit;
use App\Models\Task;

// ==========================================
// 1. TAMPILAN UTAMA & READ DATA (Dashboard)
// ==========================================
Route::get('/dashboard', function () {
    if (!session('user_email')) {
        return redirect()->route('login');
    }

    $userId = session('user_id');

    $goals = Goal::where('user_id', $userId)->get();
    $habits = Habit::with('user')->where('user_id', $userId)->get();
    $tasks = Task::with(['goal', 'habit', 'user'])->where('user_id', $userId)->orderBy('tanggal')->get();

    $completedTasks = $tasks->where('status', 'completed')->count();
    $productivityScore = $tasks->count() ? round($completedTasks / $tasks->count() * 100) : 0;

    $today = Carbon::today();
    $weekly = collect(range(0, 6))->mapWithKeys(function ($day) use ($today, $tasks) {
        $date = $today->copy()->addDays($day);
        $count = $tasks->where('tanggal', $date->toDateString())->count();
        return [$date->format('D') => min(100, $count * 20)];
    })->toArray();

    $upcoming = $tasks->where('status', 'pending')->sortBy('tanggal')->take(5);

    return view('dashboard', compact('goals', 'habits', 'tasks', 'weekly', 'productivityScore', 'upcoming'));
})->name('dashboard');

// ==========================================
// 2. AUTH SYSTEM (Login, Register, Logout)
// ==========================================
Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::get('/guide', function () {
    return view('guide');
})->name('guide');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $data = $request->only(['email', 'password']);
    if (!empty($data['email']) && !empty($data['password'])) {
        // ensure a User exists and store the id in session so data is scoped per-account
        $user = User::firstOrCreate(
            ['email' => $data['email']],
            [
                'name' => Str::before($data['email'], '@'),
                'password' => bcrypt('password123'),
            ]
        );

        $request->session()->put('user_email', $user->email);
        $request->session()->put('user_name', ucfirst($user->name));
        $request->session()->put('user_id', $user->id);

        return redirect()->route('dashboard');
    }
    return back()->with('error', 'Masukkan email dan password');
});

Route::get('/register', function () {
    return view('auth.register'); 
})->name('register');

Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('login')
        ->with('success', 'Registrasi berhasil!');
});

Route::post('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/landing');
})->name('logout');

Route::get('/settings', function () {
    return view('setting_static');
})->name('settings');

// ==========================================
// 3. RESOURCE CONTROLLERS
// ==========================================
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
Route::resource('goals', GoalController::class)->except(['show']);
Route::resource('habits', HabitController::class)->except(['show']);
Route::resource('tasks', TaskController::class)->except(['show']);

Route::view('/dashboard-static', 'dashboard_static');
Route::view('/login-static', 'login_static');

// API GET global lama (diambil dari database)
// Diset ulang (sebagian sebelumnya terhapus). Ini ambil dari DB.

Route::get('/api/goals', function () {
    $goals = \App\Models\Goal::all();
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Goals retrieved successfully 🎯',
        'data' => $goals,
        'count' => $goals->count(),
        'emoji_info' => '🎯 Goal data from database'
    ]);
});

Route::get('/api/users', function () {
    $users = \App\Models\User::all();
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Users retrieved successfully 👥',
        'data' => $users,
        'count' => $users->count(),
        'emoji_info' => '👥 User data from database'
    ]);
});

Route::get('/api/habits', function () {
    $habits = \App\Models\Habit::all();
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Habits retrieved successfully 🔥',
        'data' => $habits,
        'count' => $habits->count(),
        'emoji_info' => '🔥 Habit tracking data from database'
    ]);
});

Route::get('/api/tasks', function () {
    $tasks = \App\Models\Task::all();
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Tasks retrieved successfully 📋',
        'data' => $tasks,
        'count' => $tasks->count(),
        'emoji_info' => '📋 Task management data from database'
    ]);
});

Route::get('/api/categories', function () {
    $categories = \App\Models\Category::all();
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Categories retrieved successfully 📂',
        'data' => $categories,
        'count' => $categories->count(),
        'emoji_info' => '📂 Category data from database'
    ]);
});

Route::get('/api/dashboard-summary', function () {
    return response()->json([
        'status' => '✅ Success',
        'message' => 'Dashboard summary retrieved 📊',
        'data' => [
            'goals' => ['count' => \App\Models\Goal::count(), 'emoji' => '🎯'],
            'habits' => ['count' => \App\Models\Habit::count(), 'emoji' => '🔥'],
            'tasks' => ['count' => \App\Models\Task::count(), 'emoji' => '📋'],
            'users' => ['count' => \App\Models\User::count(), 'emoji' => '👥']
        ],
        'emoji_info' => '📊 Complete dashboard summary with all metrics'
    ]);
});





// ==========================================
// ==========================================
// API CRUD (legacy session-based) - DINONAKTIFKAN
// Pindah ke routes/api.php menggunakan Laravel Sanctum (Bearer Token)
// ==========================================
/*
// Helper: pastikan user sudah login
Route::post('/api/auth/ensure', function (Request $request) {
    if (!$request->session()->has('user_id')) {
        return response()->json([
            'status' => '❌ Unauthorized',
            'message' => 'Session user_id belum ada. Login dulu lewat /login.',
            'data' => null
        ], 401);
    }

    return response()->json([
        'status' => '✅ Authorized',
        'message' => 'Session valid',
        'data' => ['user_id' => session('user_id')]
    ]);
});
*/


// ---------- TASKS CRUD ----------
Route::get('/api/tasks/user', function () {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $tasks = \App\Models\Task::with(['goal', 'habit'])->where('user_id', session('user_id'))->orderBy('tanggal')->get();

    return response()->json([
        'status' => '✅ Success',
        'message' => 'Tasks retrieved successfully 📋',
        'data' => $tasks,
        'count' => $tasks->count()
    ]);
});

Route::post('/api/tasks', function (Request $request) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $request->validate([
        'judul' => 'required|string|max:255',
        'tanggal' => 'nullable|date',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:pending,completed',
        'goal_id' => 'nullable|integer|exists:goals,id',
        'habit_id' => 'nullable|integer|exists:habits,id',
    ]);

    // scope cek relasi milik user
    $goalId = $request->input('goal_id');
    $habitId = $request->input('habit_id');

    if ($goalId) {
        $goal = \App\Models\Goal::where('id', $goalId)->where('user_id', session('user_id'))->first();
        if (!$goal) {
            return response()->json(['status' => '❌ Forbidden', 'message' => 'goal_id tidak milik user login.', 'data' => null], 403);
        }
    }

    if ($habitId) {
        $habit = \App\Models\Habit::where('id', $habitId)->where('user_id', session('user_id'))->first();
        if (!$habit) {
            return response()->json(['status' => '❌ Forbidden', 'message' => 'habit_id tidak milik user login.', 'data' => null], 403);
        }
    }

    $task = \App\Models\Task::create([
        'goal_id' => $goalId,
        'habit_id' => $habitId,
        'judul' => $request->input('judul'),
        'tanggal' => $request->input('tanggal'),
        'priority' => $request->input('priority'),
        'status' => $request->input('status'),
        'user_id' => session('user_id'),
    ]);

    return response()->json([
        'status' => '✅ Created',
        'message' => 'Task created successfully. ',
        'data' => $task,
        'count' => 1
    ], 201);
});

Route::put('/api/tasks/{id}', function (Request $request, $id) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $task = \App\Models\Task::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$task) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Task tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $request->validate([
        'judul' => 'sometimes|required|string|max:255',
        'tanggal' => 'sometimes|nullable|date',
        'priority' => 'sometimes|required|in:low,medium,high',
        'status' => 'sometimes|required|in:pending,completed',
        'goal_id' => 'sometimes|nullable|integer|exists:goals,id',
        'habit_id' => 'sometimes|nullable|integer|exists:habits,id',
    ]);

    $goalId = $request->input('goal_id');
    $habitId = $request->input('habit_id');

    if ($goalId !== null && $goalId !== '') {
        $goal = \App\Models\Goal::where('id', $goalId)->where('user_id', session('user_id'))->first();
        if (!$goal) {
            return response()->json(['status' => '❌ Forbidden', 'message' => 'goal_id tidak milik user login.', 'data' => null], 403);
        }
    }

    if ($habitId !== null && $habitId !== '') {
        $habit = \App\Models\Habit::where('id', $habitId)->where('user_id', session('user_id'))->first();
        if (!$habit) {
            return response()->json(['status' => '❌ Forbidden', 'message' => 'habit_id tidak milik user login.', 'data' => null], 403);
        }
    }

    $task->update($request->only(['goal_id', 'habit_id', 'judul', 'tanggal', 'priority', 'status']));

    return response()->json([
        'status' => '✅ Updated',
        'message' => 'Task updated successfully.',
        'data' => $task,
        'count' => 1
    ]);
});

Route::delete('/api/tasks/{id}', function ($id, Request $request) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $task = \App\Models\Task::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$task) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Task tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $task->delete();

    return response()->json([
        'status' => '✅ Deleted',
        'message' => 'Task deleted successfully.',
        'data' => null,
        'count' => 1
    ]);
});

// ---------- GOALS CRUD ----------
Route::get('/api/goals/user', function () {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $goals = \App\Models\Goal::where('user_id', session('user_id'))->get();

    return response()->json([
        'status' => '✅ Success',
        'message' => 'Goals retrieved successfully 🎯',
        'data' => $goals,
        'count' => $goals->count()
    ]);
});

Route::post('/api/goals', function (Request $request) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'progress' => 'required|integer|min:0|max:100',
    ]);

    $goal = \App\Models\Goal::create([
        'title' => $request->input('title'),
        'category' => $request->input('category'),
        'description' => $request->input('description'),
        'progress' => $request->input('progress'),
        'user_id' => session('user_id'),
    ]);

    return response()->json([
        'status' => '✅ Created',
        'message' => 'Goal created successfully.',
        'data' => $goal,
        'count' => 1
    ], 201);
});

Route::put('/api/goals/{id}', function (Request $request, $id) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $goal = \App\Models\Goal::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$goal) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Goal tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'category' => 'sometimes|required|string|max:255',
        'description' => 'sometimes|nullable|string|max:1000',
        'progress' => 'sometimes|required|integer|min:0|max:100',
    ]);

    $goal->update($request->only(['title', 'category', 'description', 'progress']));

    return response()->json([
        'status' => '✅ Updated',
        'message' => 'Goal updated successfully.',
        'data' => $goal,
        'count' => 1
    ]);
});

Route::delete('/api/goals/{id}', function ($id) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $goal = \App\Models\Goal::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$goal) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Goal tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $goal->delete();

    return response()->json([
        'status' => '✅ Deleted',
        'message' => 'Goal deleted successfully.',
        'data' => null,
        'count' => 1
    ]);
});

// ---------- HABITS CRUD ----------
Route::get('/api/habits/user', function () {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $habits = \App\Models\Habit::where('user_id', session('user_id'))->orderBy('nama')->get();

    return response()->json([
        'status' => '✅ Success',
        'message' => 'Habits retrieved successfully 🔥',
        'data' => $habits,
        'count' => $habits->count()
    ]);
});

Route::post('/api/habits', function (Request $request) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $request->validate([
        'nama' => 'required|string|max:255',
        'frekuensi' => 'required|in:daily,weekly,monthly',
        'status' => 'required|in:active,inactive',
    ]);

    $habit = \App\Models\Habit::create([
        'nama' => $request->input('nama'),
        'frekuensi' => $request->input('frekuensi'),
        'status' => $request->input('status'),
        'user_id' => session('user_id'),
    ]);

    return response()->json([
        'status' => '✅ Created',
        'message' => 'Habit created successfully.',
        'data' => $habit,
        'count' => 1
    ], 201);
});

Route::put('/api/habits/{id}', function (Request $request, $id) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $habit = \App\Models\Habit::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$habit) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Habit tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $request->validate([
        'nama' => 'sometimes|required|string|max:255',
        'frekuensi' => 'sometimes|required|in:daily,weekly,monthly',
        'status' => 'sometimes|required|in:active,inactive',
    ]);

    $habit->update($request->only(['nama', 'frekuensi', 'status']));

    return response()->json([
        'status' => '✅ Updated',
        'message' => 'Habit updated successfully.',
        'data' => $habit,
        'count' => 1
    ]);
});

Route::delete('/api/habits/{id}', function ($id) {
    if (!session('user_id')) {
        return response()->json(['status' => '❌ Unauthorized', 'message' => 'Login dulu (session user_id tidak ada).', 'data' => null], 401);
    }

    $habit = \App\Models\Habit::where('id', $id)->where('user_id', session('user_id'))->first();
    if (!$habit) {
        return response()->json(['status' => '❌ Not Found', 'message' => 'Habit tidak ditemukan untuk user ini.', 'data' => null], 404);
    }

    $habit->delete();

    return response()->json([
        'status' => '✅ Deleted',
        'message' => 'Habit deleted successfully.',
        'data' => null,
        'count' => 1
    ]);
});

