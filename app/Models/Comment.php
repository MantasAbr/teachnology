<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $table = "comment";

    protected $fillable = ['comment', 'Test_idTest', 'User_idUser'];
    public $primaryKey = 'idComment';
   
}
