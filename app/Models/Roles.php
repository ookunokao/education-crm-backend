<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'roles';
    
    protected $fillable = [
        'name',
        'slug',
    ];  
    
}
