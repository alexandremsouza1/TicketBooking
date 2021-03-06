<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'provider_id',
        'provider',
        'role',
        'status',
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

    protected $appends = [
        'avatar',
        'full_name',
        'role_str',
    ];

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function userCompanies() {
        return $this->hasMany(UserCompany::class, 'user_id', 'id');
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getAvatarAttribute()
    {
        return $this->images()->count() ? $this->images()->first()->url : config('setting.avatar_default');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name || $this->last_name
            ? $this->first_name . ' ' . $this->last_name
            : $this->email;
    }

    public function getRoleStrAttribute()
    {
        if ($this->role == config('setting.type_user.user') && $this->userCompanies()->count()) {
            return trans('user.type_user')[config('setting.type_user.company_admin')];
        }
        
        return trans('user.role_value')[$this->role];
    }
}
