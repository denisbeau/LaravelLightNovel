<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function autocomplete(Request $request)
{
    $term = $request->get('term', '');
    $results = [];

    if ($term !== '') {
        $users = \DB::table('users')
            ->join('commentaires', 'users.id', '=', 'commentaires.user_id')
            ->where('users.name', 'LIKE', "%$term%")
            ->select('users.id', 'users.name')
            ->distinct()
            ->limit(10)
            ->get();

        foreach ($users as $u) {
            $results[] = [
                'id' => $u->id,
                'label' => $u->name,
                'value' => $u->name,
            ];
        }
    }

    return response()->json($results);
}

}
