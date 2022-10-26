<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'artwork_id',
        'user_id',
        'is_read',
    ];

    public function artwork(){
        return $this->belongsTo('App\Models\Artwork');
    }

    public function artist(){
        return $this->belongsTo('App\Models\User');
    }

}
