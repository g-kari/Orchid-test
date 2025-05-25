<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class MUserRole extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
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
        'id'         => Where::class,
        'role_name'  => Like::class,
        'created_at' => WhereDateStartEnd::class,
        'updated_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'role_name',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user roles for the role.
     */
    public function userRoles()
    {
        return $this->hasMany(TUserRole::class, 'm_user_role_id');
    }

    /**
     * Get the users for the role.
     */
    public function users()
    {
        return $this->belongsToMany(TUser::class, 't_user_roles', 'm_user_role_id', 't_user_id');
    }
}