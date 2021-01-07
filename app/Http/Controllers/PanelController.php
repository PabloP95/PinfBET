<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PanelController extends Controller {

    public function show($id) {

        $apuestas = DB::select("SELECT u.name as name, a.nombre_asig as asignatura, ap.nota_apuesta as nota, ap.cantidad as cantidad, ua.cod_apuesta as cod_apuesta
                                FROM users as u, apuesta as ap, asignatura as a, usu_apu_usu as ua
                                WHERE ap.cod_apuesta = ua.cod_apuesta and ap.cod_asig = a.cod_asig and ua.matriculado = u.id and ua.apostador = $id");

        return view('panel', ['apuestas' => $apuestas]);
    }

    public function buscar(Request $request, $id) {

        $apuestas = DB::select("SELECT u.name as name, a.nombre_asig as asignatura, ap.nota_apuesta as nota, ap.cantidad as cantidad, ua.cod_apuesta as cod_apuesta
                                FROM users as u, apuesta as ap, asignatura as a, usu_apu_usu as ua
                                WHERE ap.cod_apuesta = ua.cod_apuesta and ap.cod_asig = a.cod_asig and ua.matriculado = u.id and ua.apostador = $id");


        if(!empty($request->input('busqueda'))){
            $buscados = DB::select("SELECT name, surname1, surname2, id
                                    FROM users
                                    WHERE concat(name,' ',surname1,' ',surname2) like '%".$request->input('busqueda')."%' and
                                    id NOT IN (SELECT id2
									FROM users u, friendlist f
									WHERE (u.id = $id and u.id = f.id1)) and
                                    id NOT IN (SELECT id1
									FROM users u, friendlist f
									WHERE (u.id = $id and u.id = f.id2))
                                    and id != $id");

        }else{
            $buscados = [];
        }

        return view('panel', ['apuestas' => $apuestas, 'buscados' => $buscados]);
    }
}
