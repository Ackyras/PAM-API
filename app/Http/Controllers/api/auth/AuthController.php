<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $req)
    {

        $master = "asprak";
        if (!$this->pembukaan_id){
            return redirect()->route('calonasprak.none');
        }
        $matkul = MataKuliah::where('pembukaan_asprak_id', $this->pembukaan_id->id)
            ->orderBy('tanggal_seleksi', 'desc')
            ->first();
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'calonasprak'){
                // return redirect()->route('calonasprak.seleksi');
            }
            // return redirect()->route('calonasprak.index');
        }
        if ($this->pembukaan_id->akhir_pembukaan <= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d') and $matkul->tanggal_seleksi >= Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d')) {
            return view('asprak.login', compact('master'));
        }
        return redirect()->route('calonasprak.none');
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return response()->json([
            'message' => 'Berhasil Logout',
        ], 200);
    }
}
