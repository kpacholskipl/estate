<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index()
    {
        return Estate::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'street' => ['required'],
            'building_number' => ['required', 'integer'],
            'city' => ['required'],
            'zip' => ['required'],
            'supervisor_user_id' => ['required', 'integer'],
        ]);

        return Estate::create($request->validated());
    }

    public function show(Estate $estate)
    {
        return $estate;
    }

    public function update(Request $request, Estate $estate)
    {
        $request->validate([
            'street' => ['required'],
            'building_number' => ['required', 'integer'],
            'city' => ['required'],
            'zip' => ['required'],
            'supervisor_user_id' => ['required', 'integer'],
        ]);

        $estate->update($request->validated());

        return $estate;
    }

    public function destroy(Estate $estate)
    {
        $estate->delete();

        return response()->json();
    }
}
