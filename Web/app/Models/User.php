<?php

namespace App\Models;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const CUSTOMER_ROLE = 'customer';
    const MARKET_ADMIN_ROLE = 'market admin';
    const SUPER_ADMIN_ROLE = 'market admin';
    const MOBILE_LOGIN_TYPE = 'mobile';
    const MANAGEMENT_LOGIN_TYPE = 'management';
    const MANAGEMENT_REGISTRATION = 'management';
    const PUBLIC_REGISTRATION  = 'public';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'created_by',
        'updated_by',
        'approved_at'
    ];

    /**
     * The attributes that should be hidden for Eloquent.
     * @see UserRepository update method.
     *
     *
     * @var array|string[]
     */
    static array $validationFields = [
        'name',
        'lastname',
        'email',
        'password',
    ];

    static array $customValidationFields = [
        'password_confirmation',
        'current_password',
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

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_at', '!=', null);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(MarketBranch::class)->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            $model->created_by = $user ? $user->id : 0;
            $model->updated_by = $user ? $user->id : 0;
        });
        static::updating(function($model)
        {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });
    }
}
