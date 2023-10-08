<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User_role;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    /**
     * Users' roles
     *
     * @var array
     */
    protected const roles = [
        1 => 'admin',
        2 => 'technician',
        3 => 'supporter'
    ];



    public function getGravatarAttribute() {

        $hash = md5(strtolower(trim($this->attributes['email'])));
        $uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
        $headers = @get_headers($uri);
        if (!preg_match("|200|", $headers[0])) {
            return '/img/icons/user.svg';
        } else {
            return $uri;
        }
    }

    public function isAdmin() {

        $user_roles = User_role::where('user_id', $this->id)->get();

        $return = false;
        foreach ($user_roles as $user_role) {
            if ($user_role && $user_role->role == 1) {
                $return = true;
            }
        }
        return $return;
    }

    public function isTechnician() {

        $user_roles = User_role::where('user_id', $this->id)->get();

        $return = false;

        foreach ($user_roles as $user_role) {

            if ($user_role && $user_role->role == 2) {

                $return = true;

            }

        }


        return $return;

    }

    public function isSupporter() {

        $user_roles = User_role::where('user_id', $this->id)->get();
        $return = false;

        foreach ($user_roles as $user_role) {

            if ($user_role && $user_role->role == 3) {

                $return = true;

            }

        }

        return $return;

    }

    public function getRoleNames() {

        $role_ids = User_role::where('user_id', $this->id)->pluck('role')->toArray();

        $rolenames = array();

        foreach ($role_ids as $role_id) {

            $rolenames[] = self::roles[$role_id];

        }

        return $rolenames;

    }

    public function getRoleIds() {

        return User_role::where('user_id', $this->id)->orderBy('role', 'ASC')->pluck('role')->toArray();

    }

    public static function getRoles() {

        return self::roles;

    }

    public static function findRoleName($id) {

        return self::roles[$id];

    }
}
