<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerfilController extends Controller {

    public function show($id) {

        $realizadas = DB::select("SELECT COUNT(*) as total
                                 FROM apuesta a, usu_apu_usu u
                                 WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id");

        $perdidas = DB::select("SELECT COUNT(*) as total
                              FROM apuesta a, usu_apu_usu u
                              WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 0");

        $ganadas = DB::select("SELECT COUNT(*) as total
                               FROM apuesta a, usu_apu_usu u
                               WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 1");

        return view('perfil', ['realizadas' => $realizadas[0], 'perdidas' => $perdidas[0], 'ganadas' => $ganadas[0]]);
    }

    public function showAmigo($id1, $id2){

        $realizadas = DB::select("SELECT COUNT(*) as total
                                 FROM apuesta a, usu_apu_usu u
                                 WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id2");

        $perdidas = DB::select("SELECT COUNT(*) as total
                              FROM apuesta a, usu_apu_usu u
                              WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id2 and a.resultado = 0");

        $ganadas = DB::select("SELECT COUNT(*) as total
                               FROM apuesta a, usu_apu_usu u
                               WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id2 and a.resultado = 1");


        $amigo = DB::table('users')->where('id', $id2)->get();
        return view('perfil_amigo', ['amigo' => $amigo->first(), 'realizadas' => $realizadas[0], 'perdidas' => $perdidas[0], 'ganadas' => $ganadas[0]]);
    }
}
