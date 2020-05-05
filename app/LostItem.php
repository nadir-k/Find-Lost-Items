<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class LostItem extends Model
{   
    //table
    protected $table = 'lost_items';
    public $primarykey = 'id';
    public $timestamps = true;


    /** 
     * Relationship between LostItem and User
     * LostItem belongs to a User
     **/ 
    public function lost(){
        return $this->belongsTo('App\User');
    }

}
