<?php

namespace App\Http\Controllers\Web\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Auth;

class LoginController extends Controller
{
    //


    public function logar(Request $request)
    {

        try {

            $credenciais = $request->only('email', 'password');

            if(Auth::attempt($credenciais)){
                $request->session()->regenerate();
                return response()->json(Auth::user());
            }
            else{
                throw new HttpException(401, "Usuário Inválido!");
            }
            
        } catch (Exception $e) {
            
            report($e);
        }

    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
