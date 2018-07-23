<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use App\Role;

class Student extends Authenticatable
{
    use Notifiable;
    protected $table = 'students';
    protected $fillable = ['email','password','name','admission_day'];
    protected $hidden = ['password'];

    public function role(){
        return $this->belongsTo('App\Role');
    }
}
