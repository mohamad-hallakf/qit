<?php

namespace App\Models;

use App\Models\Answers;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    public function answers()
    {
        return $this->hasMany(Answers::class, 'questionid');
    }
    public function tests()
    {
        return $this->belongsTo(Test::class, 'test_questions');
    }
}
