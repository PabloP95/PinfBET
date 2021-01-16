<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Mensaje;
use App\Models\User;
use App\Models\Friendlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PanelController extends Controller {

    public function show($id) {

        $apuestas = DB::select("SELECT u.name as name, a.nombre_asig as asignatura, ap.nota_apuesta as nota, ap.cantidad as cantidad, ua.cod_apuesta as cod_apuesta, ap.resultado as resultado, ap.premio as premio
                                FROM users as u, apuesta as ap, asignatura as a, usu_apu_usu as ua
                                WHERE ap.cod_apuesta = ua.cod_apuesta and ap.cod_asig = a.cod_asig and ua.matriculado = u.id and ua.apostador = $id");

        $amigos = DB::select("SELECT u.name, u.surname1, u.surname2, u.creditCoins, u.id
                              FROM users u, friendlist f
                              WHERE u.id != $id and f.pendiente = 0 and ((f.id1 = $id and u.id = f.id2) or (f.id2 = $id and u.id = f.id1))
                              ORDER BY u.name ASC");

        $pendientes = DB::select("SELECT u.name, u.surname1, u.surname2, u.id
                              FROM users u, friendlist f
                              WHERE u.id != $id and f.pendiente = 1 and (f.id2 = $id and u.id = f.id1)
                              ORDER BY u.name ASC");

          if($id == Auth::user()->id)
              return view('panel', ['apuestas' => $apuestas, 'amigos' => $amigos, 'pendientes' => $pendientes]);
          else
              return view('error403');

    }

    public function buscar(Request $request, $id) {

        $apuestas = DB::select("SELECT u.name as name, a.nombre_asig as asignatura, ap.nota_apuesta as nota, ap.cantidad as cantidad, ua.cod_apuesta as cod_apuesta, ap.resultado as resultado, ap.premio as premio
                                FROM users as u, apuesta as ap, asignatura as a, usu_apu_usu as ua
                                WHERE ap.cod_apuesta = ua.cod_apuesta and ap.cod_asig = a.cod_asig and ua.matriculado = u.id and ua.apostador = $id");

        $amigos = DB::select("SELECT u.name, u.surname1, u.surname2, u.creditCoins, u.id
                              FROM users u, friendlist f
                              WHERE u.id != $id and f.pendiente = 0 and ((f.id1 = $id and u.id = f.id2) or (f.id2 = $id and u.id = f.id1))
                              ORDER BY u.name ASC");

        $pendientes = DB::select("SELECT u.name, u.surname1, u.surname2, u.id
                                FROM users u, friendlist f
                                WHERE u.id != $id and f.pendiente = 1 and (f.id2 = $id and u.id = f.id1)
                                ORDER BY u.name ASC");

        $buscadosAmigos = [];
        $buscadosNoamig = [];

        if(!empty($request->input('busqueda'))){
            $buscadosNoamig = DB::select("SELECT name, surname1, surname2, id
                                          FROM users
                                          WHERE concat(name,' ',surname1,' ',surname2) like '%".$request->input('busqueda')."%' and id != $id
                                          and id not in (SELECT id1
                                                         FROM friendlist
                                                         WHERE id2 = $id)
                                          and id not in (SELECT id2
                                                         FROM friendlist
                                                         WHERE id1 = $id)" );

            $buscadosAmigos = DB::select("SELECT name, surname1, surname2, id, pendiente, id1, id2
                                          FROM users, friendlist
                                          WHERE concat(name,' ',surname1,' ',surname2) like '%".$request->input('busqueda')."%' and id != $id and ((id1 = id and id2 = $id) or (id1 = $id and id2 = id))");
        }

        if($id == Auth::user()->id)
            return view('panel', ['apuestas' => $apuestas, 'amigos' => $amigos, 'pendientes' => $pendientes, 'buscadosNoamig' => $buscadosNoamig, 'buscadosAmigos' => $buscadosAmigos]);
        else
            return view('error403');


    }

    public function agregar($id1, $id2){
        DB::table('friendlist')->insert([
            'id1' => $id1,
            'id2' => $id2,
            'pendiente' => '1']);

        return redirect('/panel/'.$id1);


      }

      public function responderSolicitud($id1, $id2, $accion){

          if($accion == "aceptar"){
              DB::table('friendlist')
                          ->where('id1', $id2)
                          ->where('id2', $id1)
                          ->update(['pendiente' => "0"]);
          }else{
              DB::table('friendlist')
                          ->where('id1', $id2)
                          ->where('id2', $id1)
                          ->delete();
          }

          return redirect('/panel/'.$id1);


        }
}
