<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarAsprakController extends Controller
{
    //
    public function users()
    {
        $user = User::all();
        return response()->json($user);
    }
}
