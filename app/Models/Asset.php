<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Asset extends Model
{
    use HasFactory;
    protected $table = 'assets';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'asset_url'
    ];

    public function artwork(){
        return $this->hasOne('App\Models\Artwork');
    }

}
