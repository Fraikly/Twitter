<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\Filterable;

class User extends Authenticatable
{
    protected $guarded=false;
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'email',
        'password',
        'picture',
        'about',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     function subscribers(){
        return $this->belongsToMany(User::class,'subscriber_subscriptions','subscription_id','subscriber_id');
    }
    function subscriptions(){
        return $this->belongsToMany(User::class,'subscriber_subscriptions','subscriber_id','subscription_id');
    }
    function twits(){
         return $this->hasMany(Twit::class,'user_id','id');
    }
}
