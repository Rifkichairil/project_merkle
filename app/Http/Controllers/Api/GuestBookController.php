<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestBookRequest;
use App\Models\GuestBook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class GuestBookController extends Controller
{
    public function doGuestBook(GuestBookRequest $request) : JsonResponse {
        DB::beginTransaction();
        try {
            // membuat data untuk guest book
            GuestBook::create([
                'name'      => $request->name,
                'address'   => $request->address,
                'phone'     => $request->phone,
                'comment'   => $request->comment,
            ]);
        } catch (\Throwable $th) {
            // jika ada error tidak langsung disimpan
            // dan menampilkan pesan error
            DB::rollBack();
            throw $th;
        }
        // jika berhasil akan tersimpan ke database
        DB::commit();
        // dan memuncuklkan pesan
        return response()->json([
            'message' => 'Terima kasih sudah datang!'
        ], Response::HTTP_OK);
    }

    public function doNote() : JsonResponse {
        // mengambil data guest book hanya nama dan comment
        $note = GuestBook::select('name', 'comment')->get();

        // jika data kosong akan akan menampilkan
        if (count($note) == 0) {
            return response()->json([
                'message' => 'Belum ada yang mengisi buku tamu.'
            ], Response::HTTP_NO_CONTENT);
        }

        // jika data isi akan menampiklkan
        return response()->json([
            'message'   => 'Terima kasih sudah datanasdg!',
            'data'      => $note
        ], Response::HTTP_OK);
    }
}
