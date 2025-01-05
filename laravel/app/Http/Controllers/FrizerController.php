<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frizer;

class FrizerController extends Controller
{
    // GET metoda za dohvatanje svih frizera
    public function index()
    {
        return Frizer::all();
    }

    // PUT metoda za ažuriranje frizera
    public function update(Request $request, $id)
    {
        $frizer = Frizer::findOrFail($id);
        $frizer->update($request->all());

        return response()->json(['message' => 'Frizer uspešno ažuriran', 'frizer' => $frizer]);
    }
}