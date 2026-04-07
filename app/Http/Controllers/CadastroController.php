<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{

    public function create(Request $request)
    {
    
        return view('cadastro.index');
    }
    
    public function store(Request $request)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],

            // Sintaxe: Hash::make().
            // Semântica: Criptografia. Nunca salvamos a senha "limpa" por segurança.
            'password' => Hash::make($dados['password']),

            
            'is_admin' => true,
        ]);

        
        return redirect()->route('dashboard.index');
    }
    

   
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
