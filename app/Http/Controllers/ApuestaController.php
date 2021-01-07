<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ApuestaController extends Controller
{
    public function show($id) {

        $amigos = DB::select("SELECT u.id,u.name, u.surname1, u.surname2, u.creditCoins
                                FROM users u, friendlist f
                                WHERE u.id != $id and f.pendiente = 0 and (f.id1 = $id and u.id = f.id2) or (f.id2 = $id and u.id = f.id1)
                             ORDER BY u.name ASC");

            $asignaturas = [];
    //        $amigos = DB::select("SELECT * FROM users, friendlist WHERE (id1 = $id AND id2 = users.id) OR (id2 = $id AND id1=users.id)");


            return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
        }

    public function showAsignaturas(Request $request, $id1, $id2){
        $amigos = DB::select("SELECT u.id,u.name, u.surname1, u.surname2, u.creditCoins
                                FROM users u, friendlist f
                                WHERE u.id != $id1 and f.pendiente = 0 and (f.id1 = $id1 and u.id = f.id2) or (f.id2 = $id1 and u.id = f.id1)
                             ORDER BY u.name ASC");

        $asignaturas = DB::select("SELECT * FROM asignatura, usuario_asignatura WHERE id = $id2 AND asignatura.cod_asig = usuario_asignatura.cod_asig AND (nota < 5 OR nota IS NULL)");

        return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
    }
}
