<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Questions;
use App\Models\User;

class Test extends Model
{
    use HasFactory;
    public function questions()
    {
        return $this->belongsToMany(Questions::class, 'test_questions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tests');
    }
}
