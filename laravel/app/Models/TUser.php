<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class TUser extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'public_user_id',
        'user_name',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'             => Where::class,
        'public_user_id' => Like::class,
        'user_name'      => Like::class,
        'created_at'     => WhereDateStartEnd::class,
        'updated_at'     => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'public_user_id',
        'user_name',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the logs for the user.
     */
    public function logs()
    {
        return $this->hasMany(LUserLog::class, 't_user_id');
    }

    /**
     * Get the settings for the user.
     */
    public function settings()
    {
        return $this->hasMany(TUserSetting::class, 't_user_id');
    }

    /**
     * Get the roles for the user.
     */
    public function userRoles()
    {
        return $this->hasMany(TUserRole::class, 't_user_id');
    }

    /**
     * Get the roles for the user.
     */
    public function roles()
    {
        return $this->belongsToMany(MUserRole::class, 't_user_roles', 't_user_id', 'm_user_role_id');
    }
}