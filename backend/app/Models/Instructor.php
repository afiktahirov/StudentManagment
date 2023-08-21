<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = ["name","surname"];
    // protected $with = ['groups'];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
