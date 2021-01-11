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

    function tildes_a_mayus($cadena){
        $cadena = str_replace(
            array('á', 'é', 'í', 'ó', 'ú', 'ü'),
            array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ü'),
            $cadena
        );
        return $cadena;
    }

    //Función que aumenta las asignaturas registradas en la base de datos a partir de
    //el expediente proporcionado
    function aumentarAsignaturas($lineaEmpezar, $lineaTerminar, $pdfTroceado){
        $asignaturas = [];
        $codigos = [];
        //Aumentar colección de asignaturas
        for($i = $lineaEmpezar; $i < $lineaTerminar; $i++){
            if(stripos($pdfTroceado[$i], "21714") !== false)
            {
                $lineaConAsig = $pdfTroceado[$i];
                $lineaCalificacion = explode(" ", $lineaConAsig);
                array_push($codigos, $lineaCalificacion[1]);

                //Buscar nombre de la asignatura
                $nombreAsig = "";
                $encontrado = false;
                $j = 2;
                while($j < count($lineaCalificacion) && $encontrado == false){
                    if($lineaCalificacion[$j] != "6"){
                        $nombreAsig = $nombreAsig." ".$lineaCalificacion[$j];
                    }else{
                        $encontrado = true;
                    }
                    $j++;
                }
                array_push($asignaturas, $nombreAsig);
            }
        }
        $codigos = array_unique($codigos);
        $asignaturas = array_unique($asignaturas);


        //Insertar las asignaturas recopiladas
        foreach($codigos as $i=>$a){
            $consulta = DB::table('asignatura')->where('cod_asig', $a)->first();
            if(empty($consulta)){
                DB::table('asignatura')->insert([
                    'cod_asig' => $a,
                    'nombre_asig' => rtrim($asignaturas[$i])]);
            }
        }
    }


    public function subirExpediente(Request $request, $id){

        if($request->file->extension('file') != "pdf"){
            return redirect('/perfil/'.$id)->with('status', 'El archivo debe ser pdf');
        }else{
            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($request->file('file'));
            $pdf = nl2br($pdf->getText());

            $pdfTroceado = explode("<br />", $pdf);

            $datosAlum = DB::table('users')->where('id', $id)->first();
            $nombreAlum = $datosAlum->name." ".$datosAlum->surname1." ".$datosAlum->surname2;
            $expedientePerteneceAlumno = false;

            /**strtolower(" ".$datosAlum->name." ".$datosAlum->surname1." ".$datosAlum->surname2." "): ".$datosAlum->name." ".$datosAlum->surname1." ".$datosAlum->surname2
            * Comprobamos que el expediente facilitado pertenezca al alumno que usa el perfil. Comprueba la concordancia de los datos
            * del perfil con los datos del expediente
            */
            foreach ($pdfTroceado as $linea) {
                if(stripos($linea, $this->tildes_a_mayus(strtoupper($nombreAlum))) !== false)
                {
                    $expedientePerteneceAlumno = true;
                    break;
                }
            }

            /**
            * Cogemos los índices de las líneas que contengan la información que necesitemos
            *
            */
            $lineaEmpezar = 0;
            $lineaEmpezarEste = 0;
            $lineaTerminar = 0;
            $cont = 0;
            foreach ($pdfTroceado as $linea) {
                if(stripos($linea, "Asignaturas Matriculadas") !== false && $lineaEmpezar == 0)
                {
                    $lineaEmpezar = $cont;
                }
                if(stripos($linea, "Asignaturas Matriculadas") !== false)
                {
                    $lineaEmpezarEste = $cont;
                }
                if(stripos($linea, "Reconocimiento de asignaturas") !== false || stripos($linea, "NOTA MEDIA") !== false)
                {
                    $lineaTerminar = $cont;
                    break;
                }
                $cont++;
            }
            if($lineaEmpezar == 0){
                return redirect('/perfil/'.$id)->with('status', 'Este expediente esta vacío, para que puedan realizar apuestas sobre usted deberá presentarse a alguna convocatoria');
            }

            //Aumentamos la tabla asignaturas
            $this->aumentarAsignaturas($lineaEmpezar, $lineaTerminar, $pdfTroceado);


            $realizadas = DB::select("SELECT COUNT(*) as total
                                     FROM apuesta a, usu_apu_usu u
                                     WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id");

            $perdidas = DB::select("SELECT COUNT(*) as total
                                  FROM apuesta a, usu_apu_usu u
                                  WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 0");

            $ganadas = DB::select("SELECT COUNT(*) as total
                                   FROM apuesta a, usu_apu_usu u
                                   WHERE u.cod_apuesta = a.cod_apuesta and u.apostador = $id and a.resultado = 1");

            if($expedientePerteneceAlumno == false){
                return redirect('/perfil/'.$id)->with('status', 'Este expediente no concuerda con los datos de tu perfil. Revísalo');
            }
            else{
                return view('perfil', ['realizadas' => $realizadas[0], 'perdidas' => $perdidas[0], 'ganadas' => $ganadas[0], "linea2" => $lineaTerminar, "linea3" => $lineaEmpezarEste]);
            }
        }

    }
}
