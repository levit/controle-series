<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{

    use HasFactory;

    protected $fillable = ['number, watched'];
    protected $casts = ['watched' => 'boolean']; //É a mesma coisa que a função abaixo

    public $timestamps = false;

    public function season() {
        return $this->belongsTo(Season::class);
    }

    public function watched(): Attribute
    {
        return new Attribute(
            fn($watched) => (bool) $watched,
            fn($watched) => (bool) $watched
        );
    }

}
