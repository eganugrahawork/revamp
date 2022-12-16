<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;
    protected $connection = 'selling';
    protected $table = 'selling';
    protected $guarded = 'id';
}