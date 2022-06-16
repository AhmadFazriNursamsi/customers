<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    // protected $fillable = ['name', 'email', 'no_tlp', 'active'];
    protected $guarded = ["id"];
}
