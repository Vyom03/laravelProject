<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Model
{
    protected $fillable = ['name', 'username', 'password', 'class', 'age'];

    
    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

}
