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

        //Control para la subida de las matrículas
        $matriculaEnviada = DB::table('usuario_asignatura')->where('id', $id)->where('nota', '=', -1)->first();
        $fhoy = Carbon::now();
        $fini = Carbon::create($fhoy->year, 1, 1,0,0,0);
        $ffin = Carbon::create($fhoy->year, 2, 1, 0,0,0);

        if(!empty($matriculaEnviada))
            $matriculaEnviada = true;
        else if($fhoy->lt($fini) || $fhoy->gt($ffin))
            $matriculaEnviada = true;
        else
            $matriculaEnviada = false;


        //Selección de asignaturas disponibles para matricula
        $asignaturasMat = DB::select("SELECT *
                                    FROM asignatura
                                    WHERE cod_asig NOT IN (SELECT cod_asig
                                                           FROM usuario_asignatura
                                                           WHERE id = $id)");

        return view('perfil', ['realizadas' => $realizadas[0], 'perdidas' => $perdidas[0],
                               'ganadas' => $ganadas[0], 'matriculaEnviada' => $matriculaEnviada,
                               'asignaturasMat' => $asignaturasMat]);
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
            array('á', 'é', 'í', 'ó', 'ú', 'ü', ','),
            array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', '.'),
            $cadena
        );
        return $cadena;
    }

    /*
    //FUNCIONALIDAD ANULADA POR REQUIRIMIENTOS DE LOS REQUISITOS
    //
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
    }*/

    //Añade las asignaturas sobre las que van a poder apostar los demás alumnos
    function anadirUsuarioAsignatura($lineaEmpezar, $lineaTerminar, $pdfTroceado, $id){
        $codigos = [];
        $nota = [];
        $curso = [];
        $convocatoria = [];

        for($i = $lineaEmpezar; $i < $lineaTerminar; $i++){
            if(stripos($pdfTroceado[$i], "21714") !== false)
            {
                $lineaConAsig = $pdfTroceado[$i];
                $lineaCalificacion = explode(" ", $lineaConAsig);
                if($lineaCalificacion[count($lineaCalificacion)-9] == "PRESENTADO"){
                    array_push($nota, null);
                }else{
                    array_push($nota, (float)$this->tildes_a_mayus($lineaCalificacion[count($lineaCalificacion)-2]));
                }
                array_push($codigos, $lineaCalificacion[1]);

                for($j = 0; $j < count($lineaCalificacion); $j++){
                    if($lineaCalificacion[$j] == "F" || $lineaCalificacion[$j] == "J" || $lineaCalificacion[$j] == "S"){
                       if($j != 0 && $lineaCalificacion[$j-1] == "" && $lineaCalificacion[$j+1] == ""){

                           if($lineaCalificacion[$j] == "F")
                                array_push($convocatoria, 1);
                           if($lineaCalificacion[$j] == "J")
                                array_push($convocatoria, 2);
                           if($lineaCalificacion[$j] == "S")
                                array_push($convocatoria, 3);
                       }
                   }
                }

                for($j = 0; $j < count($lineaCalificacion); $j++){
                    if(preg_match('/[0-9][0-9]-[0-9][0-9]/', $lineaCalificacion[$j])){
                        $c = explode("-", $lineaCalificacion[$j]);
                        array_push($curso, (int)($c[0]."".$c[1]));
                    }
                }

            }
        }

        for($i = 0; $i < count($codigos); $i++){
            $r = DB::table('usuario_asignatura')->where([['id', $id],
                                                         ['cod_asig', $codigos[$i]],
                                                         ['curso', $curso[$i]],
                                                         ['convocatoria', $convocatoria[$i]]])->first();
            if(empty($r)){
                if($nota[$i] != null){
                    DB::table('usuario_asignatura')->insert([
                        'id' => $id,
                        'cod_asig' => $codigos[$i],
                        'nota' => $nota[$i],
                        'curso' => $curso[$i],
                        'convocatoria' => $convocatoria[$i]]);
                }else{
                    DB::table('usuario_asignatura')->insert([
                        'id' => $id,
                        'cod_asig' => $codigos[$i],
                        'curso' => $curso[$i],
                        'convocatoria' => $convocatoria[$i]]);
                }
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
            $lineaTerminar = 0;
            $cont = 0;
            foreach ($pdfTroceado as $linea) {
                if(stripos($linea, "Asignaturas Matriculadas") !== false && $lineaEmpezar == 0)
                {
                    $lineaEmpezar = $cont;
                }
                if( stripos($linea, "NOTA MEDIA") !== false || stripos($linea, "Reconocimiento de asignaturas") !== false)
                {
                    $lineaTerminar = $cont;
                    break;
                }
                $cont++;
            }

            //Alumno de nuevo ingreso sin haber hecho ninguna convocatoria
            if($lineaEmpezar == 0){
                return redirect('/perfil/'.$id)->with('status', 'Este expediente esta vacío, para que puedan realizar apuestas sobre usted deberá presentarse a alguna convocatoria');
            }

            //NO USADO POR REQUISITOS
            //Aumentamos la tabla asignaturas
            //$this->aumentarAsignaturas($lineaEmpezar, $lineaTerminar, $pdfTroceado);

            //Incluimos en la tabla usuario_asignatura las asignaturas
            $this->anadirUsuarioAsignatura($lineaEmpezar, $lineaTerminar, $pdfTroceado, $id);


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
                return view('perfil', ['realizadas' => $realizadas[0], 'perdidas' => $perdidas[0], 'ganadas' => $ganadas[0]]);
            }
        }

    }

    public function subirMatricula(Request $request, $id){
        $seleccion = [];
        for($i = 0; $i < 11; $i++){
            if($request->input('asig'.$i+1) != -1)
                array_push($seleccion, $request->input('asig'.$i+1));
        }

        if(count($seleccion) != count(array_unique($seleccion))){
            return redirect('/perfil/'.$id)->with('status', 'No se pueden subir matriculas con dos asignaturas iguales. Revísalo');
        }else if(count($seleccion) == 0){
            return redirect('/perfil/'.$id)->with('status', 'Selecciona alguna asignatura para subir tu matrícula');
        }else{
            $curso = Carbon::now()->format('y');
            $curso = $curso."".(((int)$curso)+1);
            $registradaAsig = DB::table('usuario_asignatura')->where([['id', $id], ['curso', $curso]])->first();
            foreach ($seleccion as $s) {
                if(!empty($registradaAsig)){
                    return redirect('/perfil/'.$id)->with('status', 'Lo sentimos, ya tenemos registros de que tu matrícula para este año ha sido subida');
                }else{
                    DB::table('usuario_asignatura')->insert([
                        'id' => $id,
                        'cod_asig' => $s,
                        'curso' => $curso,
                        'convocatoria' => -1]);
                }
            }

            DB::table('users')->where('id',$id)->update(['creditCoins' => count($seleccion)*6]);
            return redirect('/perfil/'.$id)->with('status', 'Matricula subida correctamente. Se han sumado tus creditCoins, ¡Suerte este cuatrimestre!');

        }
    }

    /*NO ME ACUERDO PA QUE ERA PERO VALE PARA ALGO NOT tocar VALE PARA LAS APUESTAS
    SELECT cod_asig, curso, MAX(convocatoria)
    FROM `usuario_asignatura`
    WHERE curso IN (SELECT MAX(curso)
                    FROM usuario_asignatura)
    GROUP BY cod_asig
    */
}
