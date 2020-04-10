<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassWordMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\User;

class ResetPasswordController extends Controller
{



    public function sendEmail(Request $request)
    {

        if ($this->validateEmail($request->email)) {
            return $this->failedResponse();
        }

        $this->email($request->email);
        return $this->successResponse();
    }

    public function send($email)
    {
        Mail::to($email)->send(new ResetPassWordMail);
    }

    public function validateEmail($email)
    {
        return !User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'El correo electronico no fue encontrado en la base de datos'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'el correo electrónico para restablecer su contraseña se envío correctamente, verifique su bandeja de entrada'
        ], Response::HTTP_OK);
    }
}
