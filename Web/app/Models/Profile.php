<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'gender',
        'date_of_birth',
        'avatar',
        'address_id',
        'user_id'
    ];

    static array $validationFields = [
        'gender',
        'date_of_birth',
        'avatar',
    ];

    const MALE = 'male';
    const FEMALE = 'female';
    const DIVERS = 'divers';
    public static $gender = [self::MALE, self::FEMALE, self::DIVERS];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
