<?php

namespace App;

use App\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject {
    
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function getJWTIdentifier()  {
        // return the primaryKey i.e user_id
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        // return a key value array
        return [];
    } // end method

    public function ownsPost(Post $post) {
        return $this->id === $post->user->id;
    } // end method
    public function hasLikedPost(Post $post) {
        return $post->likes->where('user_id', $this->id)->count() === 1;
    } // end method
}
