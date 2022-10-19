<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'description',
        'user_id',
        'img_path'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }


}
