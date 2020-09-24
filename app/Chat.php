<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
     use SoftDeletes;
     
     protected $guarded = array('id');

     public static $rules = array(
         'body' => 'required|max:250',
     );

    protected $dates = ['deleted_at'];

    // protected $fillable = [
    //   'body'
    // ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
