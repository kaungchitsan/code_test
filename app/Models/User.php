<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bet;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'token',
        'access_key',
        'user_avatar',
        'msisdn',
        'email',
        'otp',
        'address',
        'country',
        'dob',
        'trial_expire',
        'city',
        'gender',
        'src_number',
        'sponsor_name',
        'teacher_name',
        'status',
        'banned',
        'is_noti',
        'password',
        'remember_token',
        'account_type'
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

    public function packages()
    {
        return $this->belongsToMany('App\Models\Package');
    }

    public function promo_codes()
    {
        return $this->hasMany('App\Models\PromoCode');
    }

    public function badges()
    {
        return $this->belongsToMany('App\Models\Badge')->withPivot('datetime');
    }

    public function getUserAvatarAttribute($value)
    {
        if ($value) {
            return asset('storage/avatar/'.$value);
        } else {
            if($this->gender == 'male')
            {
                return asset('image/male-avatar.PNG');
            }else{
                return asset('image/female-avatar.png');
            }
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function assignBadge($badge, $datetime = null) {
		return $this->badges()->attach($badge, $datetime);
	}

	public function removeBadge($badge) {
		return $this->badges->detach($badge);
	}
}
