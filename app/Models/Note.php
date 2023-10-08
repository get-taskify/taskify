<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    use HasFactory;

    protected $table = 'notes';

    protected $fillable = ['user_id', 'text'];

    public static function getNoteforAssignment($id) {

        $note_id = Notes_assignment::where('assignment_id', $id)->pluck('note_id')->first();

        return Note::where('id', $note_id)->first();

    }

}
