<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $table = "question";
    public $primaryKey = 'idQuestion';

    protected $fillable = [
        'question', 'Test_idTest', 'weight', 'count'
    ];
}