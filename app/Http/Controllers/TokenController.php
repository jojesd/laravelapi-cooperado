<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TokenController extends Controller
{
    public function gerarToken(Request $request, $user, $password)
    {
        // Realizar a validação dos parâmetros
        if ($user === 'TesteUnicred' && $password === '123456789') {
            // Verifica se há um token existente na tabela
                $tokenData = DB::table('tokens')->first();

            // Se não houver token ou se o token expirou, gera um novo token
            if (!$tokenData || $this->tokenExpirado($tokenData->expiration)) {
                $novoToken = $this->gerarNovoToken();
                // Atualiza a tabela com o novo token e o horário de expiração atualizado
                DB::table('tokens')->updateOrInsert(
                    ['id' => 1],
                    ['token' => $novoToken, 'expiration' => Carbon::now()->addMinutes(30)]
                );
                return response()->json(['token' => $novoToken], 200);
            } else {
                // Se o token ainda estiver dentro do período de validade, retorna o token existente
                return response()->json(['token' => $tokenData->token], 200);
            }

        } else {
            // Autenticação falhou, retorna uma resposta de erro
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }
    }

    // Verifica se o token expirou
    private function tokenExpirado($expiration)
    {
        return Carbon::now()->diffInMinutes(Carbon::parse($expiration)) > 30;
    }

    // Gera um novo token aleatório
    private function gerarNovoToken()
    {
        return bin2hex(random_bytes(32)); // Gera um token hexadecimal aleatório
    }

}
