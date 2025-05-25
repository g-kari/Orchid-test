<?php

namespace App\Orchid\Layouts\TUserRole;

use App\Models\TUser;
use App\Models\MUserRole;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class TUserRoleEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Relation::make('tuserrole.t_user_id')
                ->title('ユーザー')
                ->required()
                ->fromModel(TUser::class, 'user_name', 'id'),

            Relation::make('tuserrole.m_user_role_id')
                ->title('ロール')
                ->required()
                ->fromModel(MUserRole::class, 'role_name', 'id'),
        ];
    }
}