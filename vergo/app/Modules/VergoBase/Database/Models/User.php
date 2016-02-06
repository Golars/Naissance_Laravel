<?php

namespace App\Modules\VergoBase\Database\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('email', 'password', "first_name", 'last_name', 'file_cover_id', "role_id","login");

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roleUser()
    {
        return $this->belongsTo('App\Modules\User\Models\Role', 'role_id');
    }

    /**
     * Set the user's Password.
     *
     * @param  string  $value
     * @return string
     */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = $this->_enPass($value);
    }

    public function chkPassword($password) {
        return Hash::check($password, $this->password);
    }

    private function _enPass($pass)
    {
        return Hash::make($pass);
    }
}