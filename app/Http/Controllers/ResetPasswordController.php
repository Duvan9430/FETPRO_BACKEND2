<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassWordMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{


    /**
     * Metodo general que se encarga de toda la funcionalidad del controlador
     */
    public function sendEmail(Request $request)
    {
        if ($this->validateEmail($request->email)) {
            return $this->failedResponse();
        }

        $this->send($request->email);

        return $this->successResponse();
    }

    /**
     * Metodo encargado de enviar el correo electronico de reestablecimiento de contraseña
     */
    public function send($email)
    {


        $token = $this->createToken($email);
        Mail::to($email)->send(new ResetPassWordMail($token));
    }


    /**
     * Metodo genera el token  y verifica si existe uno antes para no generar varios tokens por usuario
     */
    public function createToken($email)
    {

        $oldToken = DB::table('password_resets')->where('email', $email)->first();
        if ($oldToken) {
            return $oldToken->token;
        }
        $token = Str::random(60);
        $this->saveToken($token, $email);
        return $token;
    }

    /**
     * Metodo guarda el token generado en la tabla password_resets
     */
    public function saveToken($token, $email)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at'    => Carbon::now()
        ]);
    }

    /**
     * Metodo que valida que el correo electronico este en la base de datos
     */
    public function validateEmail($email)
    {
        return !User::where('email', $email)->first();
    }

    /**
     * Metodo envia respuesta de error 
     */
    public function failedResponse()
    {
        return response()->json([
            'error' => 'El correo electronico no fue encontrado en la base de datos'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Metodo envia respuesta exitosa
     */
    public function successResponse()
    {
        return response()->json([
            'data' => 'el correo electrónico para restablecer su contraseña se envío correctamente, verifique su bandeja de entrada'
        ], Response::HTTP_OK);
    }
}
