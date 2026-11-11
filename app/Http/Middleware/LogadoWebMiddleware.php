<?php

namespace App\Http\Middleware;

use App\Models\UsuarioToken;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LogadoWebMiddleware
{
    /**
     * Handle an incoming request.

     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Cookie::has('token') && Cookie::has('usuario_id')) {
            $usuario_id = Cookie::get('usuario_id');
            $token = Cookie::get('token');
            $token = json_decode($token);
            $usuario_id = json_decode($usuario_id);
            $token_usuario = UsuarioToken::where('usuario_id', $usuario_id)
                ->where('token', $token)
                ->where('valido_ate', '>', Carbon::now())
                ->first();
            if ($token_usuario) {
                $usuario = Usuario::find($usuario_id);
                $request->usuario = $usuario;

                return $next($request);
            } else {
                Cookie::delete('usuario_id');
                Cookie::delete('token');

                return redirect()->route('login');

            }

        } else {
            Cookie::delete('usuario_id');
            Cookie::delete('token');

            return redirect()->route('login');
        }
    }
}
