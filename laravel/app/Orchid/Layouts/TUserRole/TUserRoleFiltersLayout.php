<?php

namespace App\Orchid\Layouts\TUserRole;

use App\Models\TUser;
use App\Models\MUserRole;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;

class TUserRoleFiltersLayout extends Rows
{
    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Select::make('filter.t_user_id')
                ->fromModel(TUser::class, 'user_name', 'id')
                ->empty('全てのユーザー')
                ->title('ユーザー'),

            Select::make('filter.m_user_role_id')
                ->fromModel(MUserRole::class, 'role_name', 'id')
                ->empty('全てのロール')
                ->title('ロール'),

            DateTimer::make('filter.created_at')
                ->title('作成日の範囲')
                ->placeholder('作成日の範囲')
                ->enableClearButton(),
        ];
    }
}