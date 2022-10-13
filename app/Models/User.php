<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Smtp\Entities\EmailQueue;
use Modules\Smtp\Entities\Account;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    const ROLE_ADMIN = 0;
    const ROLE_USER = 1;
    const ROLE_MANAGER = 2;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'dob',
        'phone',
        'address',
        'role',
        'country_code',
        'otp'

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

    public static function getRoleOptions($id = null)
    {
        $list = array(
            self::ROLE_ADMIN => "Admin",
            self::ROLE_MANAGER => "Manager",
            self::ROLE_USER => "Customer",

        );
        if ($id === null)
            return $list;
        return isset($list[$id]) ? $list[$id] : 'Not Defined';
    }

    public function getRole()
    {
        $list = self::getRoleOptions();
        return isset($list[$this->role]) ? $list[$this->role] : 'Not Defined';
    }
    public function sendMailToAdmin()
    {
        $res = EmailQueue::create([
            'to' => $this->email,
            'from' => '',
            'subject' => 'Registration Email',
            'message' => 'Registration Done',
            'view' => 'email',
            'model' => [
                'user' => $this->user
            ], false
        ]);
    }
    public function message()
    {
        return $this->hasMany(Chat::class);
    }
    public function comments()
    {
        return $this->hasMany(\Modules\Comment\Entities\Comment::class, 'created_by_id', 'id');
    }
}
