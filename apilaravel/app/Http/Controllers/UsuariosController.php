<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Persona;
use App\User;

class UsuariosController extends Controller
{
    //api multitabla
    public function store(Request $request){

        $validations = Validator::make($request->all(), [
            'nombrePersona'             => 'required|max:255',
            'apellidosPersona'          => 'required|max:255',
            'telefonoPersona'           => 'required|max:11',
            'generoPersona'             => 'required',
            'fechaNacimientoPersona'    => 'required|date',
            'email'                     => 'required|email|unique:users,email',
            'password'                  => 'required'
        ]);

        if($validations->fails()){
            $response = array(
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Error al crear el usuario',
                'errors'    => $validations->errors()
            );
        }else{

            $persona = new Persona();

            $persona->nombrePersona             = $request->input('nombrePersona');
            $persona->apellidosPersona          = $request->input('apellidosPersona');
            $persona->telefonoPersona           = $request->input('telefonoPersona');
            $persona->generoPersona             = $request->input('generoPersona');
            $persona->fechaNacimientoPersona    = $request->input('fechaNacimientoPersona');

            $persona->save();

            $tipou = 'AdminMaster';
            $usuario = new User();

            $usuario->name          = $request->input('nombrePersona');
            $usuario->email         = $request->input('email');
            $usuario->password      = bcrypt($request->input('password'));
            $usuario->tipousuario   = $tipou;
            $usuario->fkpersona     = Persona::first()->id;

            $usuario->save();

            $response = array(
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Usuario creado!',
                'user'      => $persona,
                'usuario'   => $usuario
            );
        }

        return response()->json($response, $response['code']);
    }

    /*public function store(Request $request){

        $validations = Validator::make($request->all(), [
            'nombrePersona'             => 'required|max:255',
            'apellidosPersona'          => 'required|max:255',
            'telefonoPersona'           => 'required|max:11',
            'generoPersona'             => 'required',
            'fechaNacimientoPersona'    => 'required|date',
            'email'                     => 'required|email|unique:users,email',
            'password'                  => 'required'
        ]);

        if($validations->fails()){
            $response = array(
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Error al crear el usuario',
                'errors'    => $validations->errors()
            );
        }else{

            $persona = new Persona();

            $persona->nombrePersona             = $request->input('nombrePersona');
            $persona->apellidosPersona          = $request->input('apellidosPersona');
            $persona->telefonoPersona           = $request->input('telefonoPersona');
            $persona->generoPersona             = $request->input('generoPersona');
            $persona->fechaNacimientoPersona    = $request->input('fechaNacimientoPersona');

            $personafk = $persona->save();

            $pwd = password_hash($request->input('password'), PASSWORD_BCRYPT, ['cost' => 4]);
            $tipou = 'AdminMaster';
            $usuario = new User();

            $usuario->name          = $request->input('nombrePersona');
            $usuario->email         = $request->input('email');
            $usuario->password      = $pwd;
            $usuario->tipousuario   = $tipou;

            $personafk->$usuario->save();

            $response = array(
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Usuario creado!',
                'user'      => $persona,
                'usuario'   => $usuario
            );
        }

        return response()->json($response, $response['code']);
    }*/

    //api normal
    /*public function store(Request $request){

        $validations = Validator::make($request->all(), [
            'nombrePersona'             => 'required|max:255',
            'apellidosPersona'          => 'required|max:255',
            'telefonoPersona'           => 'required|max:11',
            'generoPersona'             => 'required',
            'fechaNacimientoPersona'    => 'required|date',
        ]);

        if($validations->fails()){
            $response = array(
                'status'    => 'error',
                'code'      => 404,
                'message'   => 'Error al crear el usuario',
                'errors'    => $validations->errors()
            );
        }else{

            $persona = new Persona();

            $persona->nombrePersona             = $request->input('nombrePersona');
            $persona->apellidosPersona          = $request->input('apellidosPersona');
            $persona->telefonoPersona           = $request->input('telefonoPersona');
            $persona->generoPersona             = $request->input('generoPersona');
            $persona->fechaNacimientoPersona    = $request->input('fechaNacimientoPersona');

            $persona->save();

            $response = array(
                'status'    => 'success',
                'code'      => 200,
                'message'   => 'Usuario creado!',
                'user'      => $persona
            );
        }

        return response()->json($response, $response['code']);
    }*/
}
