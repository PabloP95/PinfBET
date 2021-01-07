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

            $amigos = DB::table('users')
                    ->join('friendlist', 'users.id', '=', 'friendlist.id2')
                    ->where('friendlist.id2','=', $id)
                    ->orwhere('friendlist.id1','=',$id)
                    ->orderBy('name','asc')
                    ->distinct()
                    ->select('users.id','users.name','users.surname1', 'users.surname2')
                    ->get();

            $asignaturas = [];
    //        $amigos = DB::select("SELECT * FROM users, friendlist WHERE (id1 = $id AND id2 = users.id) OR (id2 = $id AND id1=users.id)");


            return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
        }

    public function showAsignaturas(Request $request, $id1, $id2){
        $amigos = DB::table('users')
                ->join('friendlist', 'users.id', '=', 'friendlist.id2')
                ->where('friendlist.id2','=', $id1)
                ->orwhere('friendlist.id1','=',$id1)
                ->orderBy('name','asc')
                ->distinct()
                ->select('users.id','users.name','users.surname1', 'users.surname2')
                ->get();

        $asignaturas = DB::select("SELECT * FROM asignatura, usuario_asignatura WHERE id = $id2 AND asignatura.cod_asig = usuario_asignatura.cod_asig AND (nota < 5 OR nota IS NULL)");

        return view('apuesta', ['amigos' => $amigos, 'asignaturas' => $asignaturas]);
    }
}
