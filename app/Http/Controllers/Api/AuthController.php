<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GuestBook;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function doLogin(Request $request) {
        // Mengecek apa ada admin dalam table user.
        $user = User::where("email", $request->email)->where("role", 99)->first();

        // Jika tidak ada akan mendapatkan response.
        if (!$user) {
            return response()->json([
                'message' => 'Maaf, anda tidak terdaftar dalam sistem kami'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // pencocokan password user dengan yg di input.
        if (!Hash::check(value: $request->password, hashedValue: $user->password)) {
            return response()->json([
                'message' => 'Kata sandi yang anda masukan salah'
            ], Response::HTTP_UNAUTHORIZED);
        }

        // membuat token menggunakan sanctum
        $token = $user->createToken(name: "merkle-guestbook")->plainTextToken;

        // mengeluarkan data token dan expired token
        $data = [
            "expires_in" => now()->addMinutes(config("sanctum.expiration"))->format("Y-m-d H:i:s"),
            "token" => $token
        ];

        // hasil return dari semua data
        return (object) [
            "statusCode"    => Response::HTTP_OK,
            "message"       => "Selamat anda Berhasil Login!",
            "data"          => $data
        ];
    }

    public function doDashboard() {
        // mengambil data guest book
        $guest = GuestBook::get();

        // menampilkan pesan response dan data
        return response()->json([
            'message'   => 'Data tamu berhasil ditampilkan.',
            'user'      => 'Admin',
            'data'      => $guest
        ], Response::HTTP_OK);
    }

    public function doLogout() {
        // melakukan ddelete token
        auth()->user()->tokens()->delete();
        // menampilkan pesan response
        return response()->json([
            "message"       => "Berhasil Logout!",
        ], Response::HTTP_OK);
    }
}
