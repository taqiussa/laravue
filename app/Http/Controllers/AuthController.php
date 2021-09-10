<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        $users = User::select('id','name')->get();
        return response()->json($users);
    }
    public function show($id){
        $users = User::find($id);
        return response()->json($users);
    }
    public function store(Request $request){
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);
        // $user->save();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil di simpan',
            'data' => $user,
        ]);
    }
    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'data user berhasil dihapus',
        ]);
    }
    public function update($id, Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        User::where('id', $id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil diupdate',
        ]);
    }
}
