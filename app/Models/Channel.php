<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $table = 'channels';
    protected $fillable = [
        'name',
        'created_by'
    ];

    public function messages(){return $this->hasMany(Message::class);} 

    public function creator(){return $this->belongsTo(User::class,'created_by');}

}
