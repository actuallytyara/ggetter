<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Task;
use App\Models\Goal;
use App\Models\Habit;

// NOTE: Login using Sanctum Bearer Token
Route::post('/login', function (Request $request) {

    $data = $request->validate([
        'email' => ['required','email'],
        'password' => ['required','string'],
    ]);

    $user = User::where('email', $data['email'])->first();

    if (!$user || !Hash::check($data['password'], $user->password)) {
        return response()->json([
            'status' => '❌ Unauthorized',
            'message' => 'Email atau password salah',
            'data' => null,
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'status' => '✅ Success',
        'message' => 'Login berhasil',
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

Route::middleware('auth:sanctum')->group(function () {
    // ===================== TASKS =====================
    Route::get('/tasks', function (Request $request) {
        $user = $request->user();

        $tasks = Task::with(['goal', 'habit'])
            ->where('user_id', $user->id)
            ->orderBy('tanggal')
            ->get();

        return response()->json([
            'status' => '✅ Success',
            'message' => 'Tasks retrieved successfully',
            'data' => $tasks,
            'count' => $tasks->count(),
        ]);
    });

    Route::post('/tasks', function (Request $request) {
        $user = $request->user();

        $v = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'goal_id' => 'nullable|integer|exists:goals,id',
            'habit_id' => 'nullable|integer|exists:habits,id',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $goalId = $request->input('goal_id');
        $habitId = $request->input('habit_id');

        if ($goalId) {
            $goal = Goal::where('id', $goalId)->where('user_id', $user->id)->first();
            if (!$goal) {
                return response()->json(['status' => '❌ Forbidden', 'message' => 'goal_id tidak milik user'], 403);
            }
        }

        if ($habitId) {
            $habit = Habit::where('id', $habitId)->where('user_id', $user->id)->first();
            if (!$habit) {
                return response()->json(['status' => '❌ Forbidden', 'message' => 'habit_id tidak milik user'], 403);
            }
        }

        $task = Task::create([
            'goal_id' => $goalId,
            'habit_id' => $habitId,
            'judul' => $request->input('judul'),
            'tanggal' => $request->input('tanggal'),
            'priority' => $request->input('priority'),
            'status' => $request->input('status'),
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => '✅ Created',
            'message' => 'Task created successfully',
            'data' => $task,
            'count' => 1,
        ], 201);
    });

    Route::put('/tasks/{id}', function (Request $request, $id) {
        $user = $request->user();

        $task = Task::where('id', $id)->where('user_id', $user->id)->first();
        if (!$task) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Task tidak ditemukan'], 404);
        }

        $v = Validator::make($request->all(), [
            'judul' => 'sometimes|required|string|max:255',
            'tanggal' => 'sometimes|nullable|date',
            'priority' => 'sometimes|required|in:low,medium,high',
            'status' => 'sometimes|required|in:pending,completed',
            'goal_id' => 'sometimes|nullable|integer|exists:goals,id',
            'habit_id' => 'sometimes|nullable|integer|exists:habits,id',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $goalId = $request->input('goal_id');
        $habitId = $request->input('habit_id');

        if ($goalId !== null) {
            $goal = Goal::where('id', $goalId)->where('user_id', $user->id)->first();
            if (!$goal) {
                return response()->json(['status' => '❌ Forbidden', 'message' => 'goal_id tidak milik user'], 403);
            }
        }

        if ($habitId !== null) {
            $habit = Habit::where('id', $habitId)->where('user_id', $user->id)->first();
            if (!$habit) {
                return response()->json(['status' => '❌ Forbidden', 'message' => 'habit_id tidak milik user'], 403);
            }
        }

        $task->update($request->only(['goal_id', 'habit_id', 'judul', 'tanggal', 'priority', 'status']));

        return response()->json([
            'status' => '✅ Updated',
            'message' => 'Task updated successfully',
            'data' => $task,
            'count' => 1,
        ]);
    });

    Route::delete('/tasks/{id}', function (Request $request, $id) {
        $user = $request->user();

        $task = Task::where('id', $id)->where('user_id', $user->id)->first();
        if (!$task) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Task tidak ditemukan'], 404);
        }

        $task->delete();

        return response()->json([
            'status' => '✅ Deleted',
            'message' => 'Task deleted successfully',
            'data' => null,
            'count' => 1,
        ]);
    });

    // ===================== GOALS =====================
    Route::get('/goals', function (Request $request) {
        $user = $request->user();

        $goals = Goal::where('user_id', $user->id)->get();

        return response()->json([
            'status' => '✅ Success',
            'message' => 'Goals retrieved successfully',
            'data' => $goals,
            'count' => $goals->count(),
        ]);
    });

    Route::post('/goals', function (Request $request) {
        $user = $request->user();

        $v = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $goal = Goal::create([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'progress' => $request->input('progress'),
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => '✅ Created',
            'message' => 'Goal created successfully',
            'data' => $goal,
            'count' => 1,
        ], 201);
    });

    Route::put('/goals/{id}', function (Request $request, $id) {
        $user = $request->user();

        $goal = Goal::where('id', $id)->where('user_id', $user->id)->first();
        if (!$goal) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Goal tidak ditemukan'], 404);
        }

        $v = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
            'progress' => 'sometimes|required|integer|min:0|max:100',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $goal->update($request->only(['title', 'category', 'description', 'progress']));

        return response()->json([
            'status' => '✅ Updated',
            'message' => 'Goal updated successfully',
            'data' => $goal,
            'count' => 1,
        ]);
    });

    Route::delete('/goals/{id}', function (Request $request, $id) {
        $user = $request->user();

        $goal = Goal::where('id', $id)->where('user_id', $user->id)->first();
        if (!$goal) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Goal tidak ditemukan'], 404);
        }

        $goal->delete();

        return response()->json([
            'status' => '✅ Deleted',
            'message' => 'Goal deleted successfully',
            'data' => null,
            'count' => 1,
        ]);
    });

    // ===================== HABITS =====================
    Route::get('/habits', function (Request $request) {
        $user = $request->user();

        $habits = Habit::where('user_id', $user->id)->orderBy('nama')->get();

        return response()->json([
            'status' => '✅ Success',
            'message' => 'Habits retrieved successfully',
            'data' => $habits,
            'count' => $habits->count(),
        ]);
    });

    Route::post('/habits', function (Request $request) {
        $user = $request->user();

        $v = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'frekuensi' => 'required|in:daily,weekly,monthly',
            'status' => 'required|in:active,inactive',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $habit = Habit::create([
            'nama' => $request->input('nama'),
            'frekuensi' => $request->input('frekuensi'),
            'status' => $request->input('status'),
            'user_id' => $user->id,
        ]);

        return response()->json([
            'status' => '✅ Created',
            'message' => 'Habit created successfully',
            'data' => $habit,
            'count' => 1,
        ], 201);
    });

    Route::put('/habits/{id}', function (Request $request, $id) {
        $user = $request->user();

        $habit = Habit::where('id', $id)->where('user_id', $user->id)->first();
        if (!$habit) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Habit tidak ditemukan'], 404);
        }

        $v = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'frekuensi' => 'sometimes|required|in:daily,weekly,monthly',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => '❌ Validation Error',
                'message' => 'Input tidak valid',
                'data' => $v->errors(),
            ], 422);
        }

        $habit->update($request->only(['nama', 'frekuensi', 'status']));

        return response()->json([
            'status' => '✅ Updated',
            'message' => 'Habit updated successfully',
            'data' => $habit,
            'count' => 1,
        ]);
    });

    Route::delete('/habits/{id}', function (Request $request, $id) {
        $user = $request->user();

        $habit = Habit::where('id', $id)->where('user_id', $user->id)->first();
        if (!$habit) {
            return response()->json(['status' => '❌ Not Found', 'message' => 'Habit tidak ditemukan'], 404);
        }

        $habit->delete();

        return response()->json([
            'status' => '✅ Deleted',
            'message' => 'Habit deleted successfully',
            'data' => null,
            'count' => 1,
        ]);
    });
});

