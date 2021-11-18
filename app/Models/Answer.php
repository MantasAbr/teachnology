<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    public $table = "answers";
    public $primaryKey = 'idAnswers';

    protected $fillable = ['answer', 'is_Correct','Question_idQuestion'];
}
