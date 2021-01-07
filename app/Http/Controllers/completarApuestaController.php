<?php

namespace App\Http\Controllers;

use App\Models\Apuesta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class completarApuestaController extends Controller
{
    public function show(Request $request, $id1, $id2, $cod_asig) {

            $asignatura = DB::table('asignatura')
                            ->where('cod_asig', $cod_asig)
                            ->get();

            $amigo = DB::table('users')
                    ->where('id', $id2)
                    ->get();

            $amigo = $amigo[0];
            $asignatura = $asignatura[0];


            return view('completarApuesta', ['amigo' => $amigo, 'asignatura' => $asignatura]);
        }

    public function subirApuesta(Request $request, $id1, $id2, $cod_asig){

        if($request->input('mismonedas') > $request->input('creditCoins')){
            DB::table('apuesta')->insert([
                'fecha' => Carbon::now()->toDateTimeString(),
                'cantidad' => $request->input('creditCoins'),
                'nota_apuesta' => $request->input('notaApuesta'),
                'cod_asig' => $cod_asig]);

            $cod_a = DB::table('apuesta')
                    ->select('cod_apuesta')
                    ->max('cod_apuesta');

            DB::table('usu_apu_usu')->insert([
                'apostador' => $id1,
                'cod_apuesta' => $cod_a,
                'matriculado' => $id2]);

            $usu = User::find($id1);
            $usu->creditCoins = $request->input('mismonedas') - $request->input('creditCoins');
            $usu->save();

            return redirect('panel/'.$id1)->with('status', '¡Apuesta completada con éxito!');
        }else if($request->input('notaApuesta') < 0 || $request->input('notaApuesta') > 10){
            return redirect('completarApuesta/'.$id1.'/'.$id2.'/'.$cod_asig)->with('status', '¡Apuesta no completada, Nota debe ser un valor entre 0 y 10!');
        }else{
            return redirect('completarApuesta/'.$id1.'/'.$id2.'/'.$cod_asig)->with('status', '¡Apuesta no completada, CreditCoins insuficientes!');
        }




    }
}
