<?php 

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Room extends Model
{
    protected $fillable = ['title', 'author', 'slug', 'body'];
}