<?php

namespace App\Http\Middleware;

use App\Models\UsuarioToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->input('token') ?: $request->bearerToken();

        if (blank($token)) {
            $token = $request->header('Authorization');
        }

        if (str_starts_with((string) $token, 'Bearer ')) {
            $token = substr($token, 7);
        }

        if (blank($token)) {
            return response()->json([
                'message' => 'Token não fornecido',
                'erro' => 's',
            ], 401);
        }

        $tokenValido = UsuarioToken::query()
            ->where('token', $token)
            ->where('valido_ate', '>', now())
            ->first();

        if (! $tokenValido) {
            return response()->json([
                'message' => 'Token inválido',
                'erro' => 's',
            ], 401);
        }

        $request->merge([
            'token' => $tokenValido->token,
            'usuario_id' => $tokenValido->usuario_id,
        ]);

        return $next($request);
    }
}
