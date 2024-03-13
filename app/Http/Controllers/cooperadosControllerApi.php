<?php

namespace App\Http\Controllers;

use App\Models\cooperadosModel;
use Illuminate\Http\Request;
use App\Rules\CpfCnpjValidationRule;
use App\Rules\TelefoneValidationRule;



class cooperadosControllerApi extends Controller
{
    public function index(Request $request)
    {   
        
        $cooperados = cooperadosModel::all();
        
        return response()->json($cooperados->toArray());
    }

    public function store(Request $request)
    {
        // Validar os dados recebidos na solicitação
        $data = $request->all();

        $validator = \Validator::make($data, [
            'nome' => 'required|string|max:100',
            'cpfcnpj' => ['required', 'string', 'max:18', 'unique:cooperados,cpfcnpj', new CpfCnpjValidationRule()],
            'datafundacao' => 'required|date',
            'rendafaturamento' => 'required|numeric|between:0,9999999999.99',
            'telefone' => ['nullable', 'string', 'max:255', new TelefoneValidationRule()],
            'email' => 'nullable|string|email|max:255',
        ]);
        

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $cooperado = cooperadosModel::create($data);

        if ($cooperado) {
            return response()->json(['message' => 'Cooperado criado com sucesso', 'data' => $cooperado], 201);
        } else {
            return response()->json(['error' => 'Erro ao criar o cooperado'], 500);
        }


        return cooperadosModel::create($request->all());
    }

    public function show($id)
    {
        $cooperado = cooperadosModel::find($id);
        if(!$cooperado){
            return response()->json(['error' => 'Cooperado não encontrado'], 404);
        }
        return response()->json($cooperado->toArray(), 200);
    }

    public function update(Request $request, $id)
    {
        // Validar os dados recebidos na solicitação
        $data = $request->all();

        $validator = \Validator::make($data, [
            'nome' => 'sometimes|string|max:100',
            'cpfcnpj' => 'sometimes|string|max:18|unique:cooperados,cpfcnpj,' . $id,
            'datafundacao' => 'sometimes|date',
            'rendafaturamento' => 'sometimes|numeric|between:0,9999999999.99',
            'telefone' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:cooperados,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $updatedRows = cooperadosModel::where('id', $id)->update($data);

        if ($updatedRows) {
            $cooperado = cooperadosModel::find($id);
            return response()->json(['message' => 'Cooperado atualizado com sucesso', 'data' => $cooperado], 200);
        } else {
            return response()->json(['error' => 'Erro ao atualizar o cooperado'], 500);
        }
    }

    public function destroy($id)
    {
        $cooperado = cooperadosModel::find($id);
        
        if ($cooperado === null) {
            return response()->json(['error' => 'Cooperado não encontrado'], 404);
        }

        if ($cooperado->delete()) {
            return response()->json(['message' => 'Cooperado excluído com sucesso'], 200);
        } else {
            return response()->json(['error' => 'Erro ao excluir o cooperado'], 500);
        }
    }
}
