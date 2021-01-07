<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MensajeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $mensajes = DB::table('mensaje')
                ->where('emisor', $id)
                ->orWhere('receptor', $id)
                ->orderBy('fecha', 'asc')
                ->get();

        $amigos = DB::select("SELECT u.id,u.name, u.surname1, u.surname2, u.creditCoins
                                FROM users u, friendlist f
                                WHERE u.id != $id and (f.id1 = $id and u.id = f.id2) or (f.id2 = $id and u.id = f.id1)
                             ORDER BY u.name ASC");



        return view('mensajes', ['mensajes' => $mensajes, 'amigos' => $amigos]);
    }

    public function subirMensaje(Request $request, $id, $ida) {
        if (!empty($request->input('mensaje'))) {
            DB::table('mensaje')->insert([
                'texto' => $request->input('mensaje'),
                'fecha' => Carbon::now()->toDateTimeString(),
                'emisor' => $id,
                'receptor' => $ida]);
            $mensajes = DB::table('mensaje')
                    ->where('emisor', $id)
                    ->orWhere('receptor', $id)
                    ->orderBy('fecha', 'asc')
                    ->get();

            $amigos = DB::select("SELECT * FROM users, friendlist WHERE (id1 = $id AND id2 = users.id) OR (id2 = $id AND id1=users.id)");
        }
        return redirect('/mensajes/'.$id);
    }

//    FUNCIONES DEL CHAT

    public function showAll($idUser, $idFriend) {
        $mensajes = DB::table('mensaje')
                ->where([['emisor', '=', $idUser], ['receptor', '=', $idFriend]])
                ->orWhere([['emisor', '=', $idFriend], ['receptor', '=', $idUser]])
                ->orderBy('fecha', 'asc')
                ->distinct()
                ->get();

        $amigo = DB::select("SELECT * FROM users WHERE id = $idFriend");


        return view('chat', ['mensajes' => $mensajes, 'amigo' => $amigo]);
    }

//    protected function subirMensaje(Request $request, $idus, $idamig) {
//        if (!empty($request->input('mensaje'))) {
//            DB::table('mensaje')->insert([
//                'texto' => $request->input('mensaje'),
//                'fecha' => Carbon::now()->toDateTimeString(),
//                'emisor' => $idus,
//                'receptor' => $idamig]);
//        }
//        return redirect('/chat/' . $idus . '/' . $idamig);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensaje $mensaje) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensaje $mensaje) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensaje $mensaje) {
        //
    }

}
