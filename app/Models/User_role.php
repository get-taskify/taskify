<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class User_role extends Model {

    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = ['role', 'user_id'];


    public function user() {
        return $this->belongsTo('App\User');
    }
}
