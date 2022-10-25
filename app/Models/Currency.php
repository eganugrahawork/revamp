<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $connection = 'masterdata';
    protected $table = 'currency';
    protected $guarded =['id'];
    use HasFactory;
}