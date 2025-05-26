<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class TUserRole extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 't_user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        't_user_id',
        'm_user_role_id',
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
        'id'            => Where::class,
        't_user_id'     => Where::class,
        'm_user_role_id' => Where::class,
        'created_at'    => WhereDateStartEnd::class,
        'updated_at'    => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        't_user_id',
        'm_user_role_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user that owns the role.
     */
    public function user()
    {
        return $this->belongsTo(TUser::class, 't_user_id');
    }

    /**
     * Get the role that the user has.
     */
    public function role()
    {
        return $this->belongsTo(MUserRole::class, 'm_user_role_id');
    }
}