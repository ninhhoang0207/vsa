<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'email', 'password','role','created_at','updated_at','phone ','address','avatar','assoc_id','is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function videos(){
         return $this->hasMany('App\Video','created_by');  
    }
    public function comment(){
         return $this->hasMany('App\Comments','user_id');  
    }

    public function association() {
        return $this->hasOne('App\Association','id','assoc_id');
    }

    public function personalAssociation() {
        return $this->where('role','member_personal')->where('is_active',1)->get();
    }

    public function officialAssociation() {
        return $this->where('role','member_association')->where('is_active',1)->get();
    }
}
