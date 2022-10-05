<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'location'
    ];
    
    public function galleryArtwork(){
        return $this->hasMany('App\Models\GalleryArtwork', 'gallery_id');
    }

}
