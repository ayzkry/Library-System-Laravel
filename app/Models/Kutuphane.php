<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kutuphane extends Model
{
    use HasFactory;
    protected $table = "kutuphane";
    protected $primaryKey = "Kutuphane_no";
    protected $guarded = [];
}
