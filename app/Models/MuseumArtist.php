<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MuseumArtist extends Model
{
    use HasFactory;
    protected $table = 'museum_artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'museum_id',
        'user_id',
        'datetime_start',
        'datetime_end'
    ];

    public function museum(){
        return $this->belongsTo('App\Models\Museum');
    }

    public function artist(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
