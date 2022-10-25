<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Artwork extends Model
{
    use HasFactory;
    protected $table = 'artworks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'artist_id',
        'description',
        'asset_id',
        'votes'
    ];

    public function asset(){
        return $this->belongsTo('App\Models\Asset');
    }

    public function artist(){
        return $this->belongsTo('App\Models\User', 'artist_id');
    }

    public function galleryArtwork(){
        return $this->hasMany('App\Models\GalleryArtwork', 'artwork_id');
    }

    public function notification(){
        return $this->hasMany('App\Models\Notification');
    }

}
