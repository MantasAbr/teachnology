<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $table = "test";

    protected $fillable = ['testName', 'info', 'Category_idCategory', 'ratingSum','completedCount','ratingCount', 'User_idUser'];
    public $primaryKey = 'idTest';
}
