<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'titre',
        'rubrique',
        'date_de_sortie',
        'duree',
        'qualite',
        'description',
        'age',
        'video',
        'image',
        'pub',
        'banniere'
    ];
}
