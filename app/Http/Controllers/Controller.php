<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Services\PokemonService;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function buscarPokemon(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|numeric'
        ]);

        $response = PokemonService::buscarPokemon($params['id']);

        if (is_null($response)) {
            return response()->json([
                'status' => false,
                'message' => 'Pokemon nao encontrado.'
            ], 404
            );
        }
        return response()->json([
            'status' => true,
            $response
        ],200
        );
    }

    public function inserirPokemon(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|numeric',
            'nome' => 'required|string',
            'sprite' => 'required|string'
        ]);

        $response = PokemonService::inserirPokemon($params);

        if (is_null($response)) {
            return response()->json([
            'status' => false,
            'message' => 'Nao foi possivel cadastrar o pokemon, ID em uso.'
            ], 409
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Pokemon inserido com sucesso',
            $response
            ], 200
        );

    }

    public function atualizarPokemon(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|numeric',
            'nome' => 'required|string',
            'sprite' => 'required|string'
        ]);

        $response = PokemonService::atualizarPokemon($params);

        if (is_null($response)) {
            return response()->json([
                'status' => false,
                'message' => 'Pokemon nao encontrado.'
            ], 404
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Pokemon atualizado com sucesso!',
            $response
        ],200
        );
    }

    public function deletarPokemon(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|numeric',
        ]);

        $response = PokemonService::deletarPokemon($params);
        if (is_null($response)) {
            return response()->json([
                'status' => false,
                'message' => 'Nao foi possivel deletar o Pokemon, nao encontrado.'
            ], 404
            );
        }
        return response()->json([
            'status' => true,
            'message' => 'Pokemon deletado com sucesso!'
        ],200
        );

    }

}

