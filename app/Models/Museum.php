<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Museum extends Model
{
    use HasFactory;
    protected $table = 'museums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'lat',
        'long',
    ];

    public function museum_artist(){
        return $this->hasMany('App\Models\MuseumArtist');
    }
}
