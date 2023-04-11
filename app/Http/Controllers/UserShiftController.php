<?php

namespace App\Http\Controllers;

use App\Models\UserShift;
use Illuminate\Http\Request;

class UserShiftController extends Controller
{
    public function index()
    {
        return UserShift::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'substitute_user_id' => ['required', 'integer'],
            'temp_changes' => ['required', 'date'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
        ]);

        return UserShift::create($request->validated());
    }

    public function show(UserShift $usersShift)
    {
        return $usersShift;
    }

    public function update(Request $request, UserShift $usersShift)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'substitute_user_id' => ['required', 'integer'],
            'temp_changes' => ['required', 'date'],
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
        ]);

        $usersShift->update($request->validated());

        return $usersShift;
    }

    public function destroy(UserShift $usersShift)
    {
        $usersShift->delete();

        return response()->json();
    }
}
