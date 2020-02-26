<?php

namespace App;

use App\Entities\Learning;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Learning, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'confirm_token'
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Is verified user ?
     *
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirm_token == null;
    }

    /**
     * Verified user
     *
     * @return bool
     */
    public function confirm()
    {
        $this->confirm_token = null;
        return $this->save();
    }

    /**
     * User is a Admin ?
     *
     * @return bool
     */
    public function isAdmin()
    {
        return in_array($this->email, config('bahdcasts.administrator'));
    }

}
