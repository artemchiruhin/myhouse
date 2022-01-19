<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','rooms',
        'category_id','price_per_day','image','address'];
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
