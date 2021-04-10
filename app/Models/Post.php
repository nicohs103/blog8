<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'created_by', 'description', 'publication_date'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
