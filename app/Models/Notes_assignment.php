<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notes_assignment extends Model {
    use HasFactory;

    protected $table = 'note_assignments';

    protected $fillable = ['assignment_id', 'note_id'];
}
