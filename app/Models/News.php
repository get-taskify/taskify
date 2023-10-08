<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model {

    use HasFactory;

    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'user_id'];

    /**
     * Get the formatted Text attribute.
     *
     * @return string
     */
    public function getFormattedTextAttribute() {

        return nl2br($this->attributes['text']);

    }

}


