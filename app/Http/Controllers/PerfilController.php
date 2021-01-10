<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\User;
use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
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


    public function subirExpediente(Request $request, $id){

        if($request->file->extension('file') != "pdf"){
            return redirect('/perfil/'.$id)->with('status', 'El archivo debe ser pdf');
        }else{
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($request->file('file'));
            $pdf = nl2br($pdf->getText());

            $pdfTroceado = explode("<br />", $pdf);

            $datosAlum = DB::table('users')->where('id', $id)->get();
            $datosAlum = $datosAlum->first();
            $expedientePerteneceAlumno = false;

            /**
            * Comprobamos que el expediente facilitado pertenezca al alumno que usa el perfil. Comprueba la concordancia de los datos
            * del perfil con los datos del expediente
            */
            foreach ($pdfTroceado as $linea) {
                if(stripos($linea, $datosAlum->name." ".$datosAlum->surname1." ".$datosAlum->surname2) == true){
                    $expedientePerteneceAlumno = true;
                }
            }

            $realizadas = DB::select("SELECT COUNT(*) as total
                                     FROM apuesta a, usu_apu_usu u
                                     WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id");

            $perdidas = DB::select("SELECT COUNT(*) as total
                                  FROM apuesta a, usu_apu_usu u
                                  WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 0");

            $ganadas = DB::select("SELECT COUNT(*) as total
                                   FROM apuesta a, usu_apu_usu u
                                   WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 1");
                                   
            if($expedientePerteneceAlumno == true){
                return redirect('/perfil/'.$id)->with('status', 'Este expediente no concuerda con los datos de tu perfil. Revísalo');
            }
            else{
                return view('perfil', ['realizadas' => $realizadas[0], 'perdidas' => $perdidas[0], 'ganadas' => $ganadas[0], "expediente" => $pdfTroceado]);
            }
        }

    }
}
