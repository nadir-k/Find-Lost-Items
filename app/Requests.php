<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\LostItem;

class Requests extends Model
{
    //table
    protected $table = 'requests';
    public $primarykey = 'id';
    public $timestamps = true;

    /** 
     * Relationship between Requests and User
     * Request belongs to a User
     **/ 
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    /** 
     * Relationship between Request and LostItem
     * Request belongs to a LostItem
     * meaning that the Request uses item_id which refers to id
     * in LostItem table as a foreign key
     **/ 
    public function item(){
        return $this->belongsTo('App\LostItem', 'item_id');
    }
}
