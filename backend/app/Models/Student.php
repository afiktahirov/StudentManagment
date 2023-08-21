<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ["name", "surname", "group_id"];
    
    protected $with = ["group"];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
