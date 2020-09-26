<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Hash;

class User extends Authenticatable {
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'dailing_code', 'mobile_number', 'password', 'address', 'latitude', 'longitude', 'gender', 'country_id', 'state_id', 'city_id', 'profile_photo', 'role_id', 'is_email_verified', 'id_proof_type', 'id_proof_number', 'id_proof_photo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($input) {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    public function getProfilePhotoAttribute($input) {
        if ($input) {
            return url('public/uploads/users/' . $input);
        } else {
            return '';
        }
    }

    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
}