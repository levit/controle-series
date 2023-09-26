<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
    public $timestamps = true;
    //protected $with = ['seasons'] = Inclui para sempre trazer a dependencia

    public function seasons() {
        return $this->hasMany(Season::class, 'series_id', 'id');
    }

     protected static function booted() {
         self::addGlobalScope('ordered', function (Builder $queryBuilder) {
             $queryBuilder->orderBy('nome');
             // $queryBuilder->where('empresa_id','=',1); -> Filtro empresa
         });
     }

//      public function scopeActive(Builder $queryBuilder) {
//          return $queryBuilder->where('id','=','1');
//      }

}
