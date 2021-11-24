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
    public function user()
    {
        return $this->belongsTo(User::class, 'User_idUser');
    }
}
