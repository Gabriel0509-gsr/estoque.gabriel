<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'assunto' => ['required', 'string', 'max:255'],
            'mensagem' => ['required', 'string', 'max:5000'],
        ]);

        Mail::raw($dados['mensagem'], function (Message $email) use ($dados): void {
            $email->to(config('mail.from.address'))
                ->replyTo($dados['email'], $dados['nome'])
                ->subject($dados['assunto']);
        });

        return redirect()->route('contato')->with('success', 'Sua mensagem foi encaminhada. Obrigado por entrar em contato.');
    }
}
