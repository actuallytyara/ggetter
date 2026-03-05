<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::with('user','category')->get();
        return view('goals.index', compact('goals'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('goals.create', compact('users','categories'));
    }

    public function store(Request $request)
    {
        Goal::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'status' => $request->status
        ]);

        return redirect('/goals');
    }

    public function edit($id)
    {
        $goal = Goal::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('goals.edit', compact('goal','users','categories'));
    }

    public function update(Request $request, $id)
    {
        $goal = Goal::findOrFail($id);

        $goal->update([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'status' => $request->status
        ]);

        return redirect('/goals');
    }

    public function destroy($id)
    {
        Goal::destroy($id);
        return redirect('/goals');
    }
}