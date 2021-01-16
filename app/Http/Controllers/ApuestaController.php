<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ApuestaController extends Controller
{
    private $CURSO_ANT = 1920;
    private $CURSO_ACT = 2021;

    public function show($id) {

        $amigos = DB::select("SELECT u.id,u.name, u.surname1, u.surname2, u.creditCoins
                                FROM users u, friendlist f
                                WHERE u.id != $id and f.pendiente = 0 and (f.id1 = $id and u.id = f.id2) or (f.id2 = $id and u.id = f.id1)
                             ORDER BY u.name ASC");

            $asignaturas = [];
    //        $amigos = DB::select("SELECT * FROM users, friendlist WHERE (id1 = $id AND id2 = users.id) OR (id2 = $id AND id1=users.id)");

        if($id == Auth::user()->id)
            return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
            else
                return view('error403');
        }

    public function showAsignaturas(Request $request, $id1, $id2){
        $amigos = DB::select("SELECT u.id,u.name, u.surname1, u.surname2, u.creditCoins
                                FROM users u, friendlist f
                                WHERE u.id != $id1 and f.pendiente = 0 and (f.id1 = $id1 and u.id = f.id2) or (f.id2 = $id1 and u.id = f.id1)
                             ORDER BY u.name ASC");

        $asignaturas = DB::select("SELECT DISTINCT a.cod_asig as cod_asig, convocatoria, ag.nombre_asig as nombre_asig
                                    FROM usuario_asignatura a, asignatura ag
                                    WHERE id = $id2 and a.cod_asig = ag.cod_asig and (curso = $this->CURSO_ANT or curso = $this->CURSO_ACT) and (nota < 5 or nota is null) and convocatoria IN (SELECT MAX(convocatoria)
                                                                                                    FROM usuario_asignatura b
                                                                                                    WHERE id=$id2 and a.cod_asig = b.cod_asig)");

        return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
    }
}
