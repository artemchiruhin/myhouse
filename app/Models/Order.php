<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['house_id','user_id','cost','date_from','date_to','comment'];
    public function house(){
        return $this->belongsTo('App\Models\House');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function status(){
        return $this->belongsTo('App\Models\Status');
    }
}
