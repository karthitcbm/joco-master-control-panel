<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Corbon;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::orderBy('created_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newUser = new User;
        $newUser->name = $request->item["name"];
        $newUser->email = $request->item["email"];
        $newUser->role = $request->item["role"];
        $newUser->password =  Hash::make($request->item["password"]);
        $newUser->save();
        return $newUser;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingUser = User::find($id);
        if($existingUser) {
            $existingUser->name = $request->item["name"];
            $existingUser->email = $request->item["email"];
            $existingUser->role = $request->item["role"];
            // $existingUser->updated_at = Carbon::now();
            // $existingUser->password =  Hash::make($request->item["password"]);
            $existingUser->save();
            return $existingUser;
        }
        return "User not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingUser = User::find($id);
        if($existingUser) {
            $existingUser->delete();
            return "User successfully deleted";
        }
        return "User not found";
    }
}
