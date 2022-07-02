<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social_media extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'url'];
    protected $table = 'social_media';
    public $timestamps = false;

}
