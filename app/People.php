<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordCustomNotification;

class People extends Model
{
	use Notifiable;

    protected $fillable = ['name', 'lastname', 'photo', 'slug', 'email', 'password'];

    protected $hidden = [
        'password'
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordCustomNotification($token));
    }
}
