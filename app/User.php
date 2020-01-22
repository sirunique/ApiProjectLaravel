<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
   Protected  $fillable = [
   		'name','email','password',
   ];

   Protected $hidden = [
   		'password', 'remember_token'
   ];

   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   public function getJWTCustomClaims()
   {
       return [];
   }
   
//    public function setPasswordAttribute($password)
//    {
//        if ( !empty($password) ) {
//            $this->attributes['password'] = bcrypt($password);
//        }
//    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
