<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class userTest extends Model
{
    use HasFactory;
    public function getStudentAttribute()
    {
        return  User::find($this->user_id)->pluck('name');
    }
}
