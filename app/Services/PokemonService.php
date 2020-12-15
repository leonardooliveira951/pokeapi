<?php

namespace App\Services;

use App\Pokemon;

/**
 * Class PokemonService
 * @package App\Services
 */
class PokemonService {

    /**
    * @param $id
    * @return array
    */
    public static function buscarPokemon($id)
    {

        if(!Pokemon::where('id',$id)->exists())
        {
            return null;
        }

        $pokemon = Pokemon::where('id',$id)->get();

        return $pokemon;
    }


    /**
     * @param $data
     * @return array
     */
    public static function inserirPokemon($data)
    {

        if(Pokemon::where('id',$data['id'])->exists())
        {
        return null;
        }
        $pokemon = new Pokemon;
        $pokemon->id = $data['id'];
        $pokemon->nome = $data['nome'];
        $pokemon->sprite = $data['sprite'];
        $pokemon->save();
        return $pokemon;

    }

    /**
     * @param $data
     * @return
     */
    public static function atualizarPokemon($data)
    {
        if(!Pokemon::where('id',$data['id'])->exists())
        {
            return null;
        }

        Pokemon::where('id',$data['id'])->update([
                                            'nome' => $data['nome'],
                                            'sprite' => $data['sprite']
                                        ]);
        $pokemon =  Pokemon::where('id',$data['id'])->get();
        return $pokemon;

    }

    /**
     * @param $data
     * @return
     */
    public static function deletarPokemon($id)
    {

        if(!Pokemon::where('id',$id)->exists())
        {
            return null;
        }
        Pokemon::where('id',$id)->delete();
        return true;

    }
}
