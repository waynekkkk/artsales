<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GalleryArtwork extends Model
{
    use HasFactory;
    protected $table = 'gallery_artworks';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'gallery_id',
        'artwork_id'
    ];

    public function artwork(){
        return $this->belongsTo('App\Models\Artwork');
    }
    
    public function gallery(){
        return $this->belongsTo('App\Models\Gallery', 'gallery_id');
    }

}
