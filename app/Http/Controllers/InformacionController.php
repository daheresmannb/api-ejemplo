<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use App\Models\User;
use Illuminate\Http\Request;
use Validator; 

class InformacionController extends Controller {

    public function Create(Request $request) {
        $validator = Validator::make(
            $request->all(), [
                "name"      => "required",
                "email"     => "required",
                "password"  => "required",
                "nombres"   => "required",
                "apellidos" => "required",
                "direcion"  => "required",
                "fecha_nac" => "required",
                "sexo"      => "required",
            ]
        );

        if ($validator->fails()) {
            $respuesta["exito"] = false;
            $respuesta["msg"]   = $validator->errors();
        } else {
            $usuario = User::create($request->all());
            $respuesta["exito"]   = true;
            $respuesta["usuario"] = $usuario;
        }
        return response()->json($respuesta);
    }

    public function Read(Request $request) {
        if ($request->has("usuario_id")) {
            $usuario = User::find($request->usuario_id);
  
            if (isset($usuario)) {    
                $respuesta["exito"]   = true;
                $respuesta["usuario"] = $usuario; 
            } else {
                $respuesta["exito"]   = false;
                $respuesta["msg"]     = "Usuario no encontrado";
            }   
        } else {
            $respuesta["exito"]   = false;
            $respuesta["msg"]     = "parametro requerido";
        }
        return response()->json($respuesta);
    }

    public function Update(Request $request) {
        $validator = Validator::make(
            $request->all(), [
                "usuario_id" => "required",
                "name"       => "required",
                "email"      => "required",
                "password"   => "required",
                "nombres"    => "required",
                "apellidos"  => "required",
                "direcion"   => "required",
                "fecha_nac"  => "required",
                "sexo"       => "required",
            ]
        );

        if ($validator->fails()) {
            $respuesta["exito"] = false;
            $respuesta["msg"]   = $validator->errors();
        } else {
            $usuario = User::find($request->usuario_id);

            if (isset($usuario)) {
                $usuario->Update($request->all());

                $respuesta["exito"]   = true;
                $respuesta["msg"]     = "actualizacion exitosa";
                $respuesta["usuario"] = $usuario;
            } else {
                $respuesta["exito"]   = false;
                $respuesta["msg"]     = "Usuario no encontrado";
            }
        }
        return response()->json($respuesta);
    }

    public function Delete(Request $request) {
        if ($request->has("usuario_id")) {
            $usuario = User::find($request->usuario_id);
            
            if (isset($usuario)) {
                $usuario->delete();

                $respuesta["exito"]   = true;
                $respuesta["msg"]     = "borrado exitoso";
            } else {
                $respuesta["exito"]   = false;
                $respuesta["msg"]     = "Usuario no encontrado";
            }  
        } else {
            $respuesta["exito"]   = false;
            $respuesta["msg"]     = "parametro requerido";
        }
        return response()->json($respuesta);
    }
}
