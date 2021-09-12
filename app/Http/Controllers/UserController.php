<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function upload($id, Request $request) {
        $user = User::find($id);
        $imageName =  time().'.'.$request->foto->extension();
        $path = public_path('image');
        if(!empty($user->foto) && file_exists($path.'/'.$user->foto)){
            unlink($path.'/'.$user->foto);
        }
        $user->foto = $imageName;
        $user->save();
        $request->foto->move(public_path('image'), $imageName);
        return response()->json([
            'status' => true,
            'message' => 'gambar berhasil diupload',
        ]);
    }
}
