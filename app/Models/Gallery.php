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
        'location',
        'owner_id'
    ];
    
    public function galleryArtwork(){
        return $this->hasMany('App\Models\GalleryArtwork', 'gallery_id');
    }
    
    public function owner(){
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

}
