<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SalonAuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'lozinka' => 'required|min:6'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nevalidni podaci'
                ], 422);
            }

            $salon = Salon::where('email', strip_tags($request->email))->first();
            
            if (!$salon || !$salon->aktivan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Neuspešna prijava'
                ], 401);
            }

            if (!Hash::check($request->lozinka, $salon->lozinka)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Neuspešna prijava'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'salon' => $salon->only(['id', 'salon_naziv', 'grad'])
            ])->header('X-Content-Type-Options', 'nosniff')
              ->header('X-Frame-Options', 'DENY')
              ->header('X-XSS-Protection', '1; mode=block');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Greška na serveru'
            ], 500);
        }
    }
}