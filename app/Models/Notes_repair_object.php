<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notes_repair_object extends Model {
    use HasFactory;

    protected $table = 'note_repair_objects';

    protected $fillable = ['repair_object_id', 'note_id'];
}
