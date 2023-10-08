<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model {

    use HasFactory;

    protected $table = 'workshops';

    protected $fillable = ['name', 'address'];

    public static function getName($id) {

        return Workshop::where('id', $id)->value('name');
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
}
