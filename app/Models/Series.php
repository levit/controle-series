<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    public $timestamps = true;
    //protected $with = ['seasons']; // = Inclui para sempre trazer a dependencia
    protected $appends = ['links'];


    public function seasons() {
        return $this->hasMany(Season::class, 'series_id', 'id');
    }

    public function episodes() {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    public function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => "self",
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => "seasons",
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => "episodes",
                    'url' => "/api/series/{$this->id}/episodes"
                ]
            ]
        );
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
