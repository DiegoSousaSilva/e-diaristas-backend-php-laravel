<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Define campos que podem ser  gravados
     *
     * @var array
     */
    protected $fillable = [
        'nome_completo','cpf','email','telefone','logradouro','numero','bairro','complemento','cep','estado','cidade','codigo_ibge','foto_usuario'
    ];


    /**
     * Define os campos que serao usados na serialização
     *
     * @var array
     */
     protected $visible = [ 'nome_completo', 'cidade', 'foto_usuario', 'reputacao'];

     /**
      *Adiciona campos na serializacao
      *
      * @var array
      */
     protected $appends = ['reputacao'];

     /**
      * Monta a url da imagem
      *
      * @param string $valor
      * @return void
      */
     public function getFotoUsuarioAttribute(string $valor)
     {
         return config('app.url') . '/' . $valor;
     }

     /**
      * Retorna a reputacao randomica
      *
      * @param [type] $valor
      * @return void
      */
    public function getReputacaoAttribute($valor)
     {
         return mt_rand(1, 5);
     }


     /**
      * Busca diaristas por codigo ibge
      * @param integer $codigoIbge
      * @return void
      */
    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
       return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }


    /**
     * Retorna quntidade de diaristas restantes
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
       $quantidade = self::where('codigo_ibge', $codigoIbge)->count();

       return $quantidade > 6 ?  $quantidade- 6 : 0;
    }
}
