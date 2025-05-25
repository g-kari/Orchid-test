<?php

namespace App\Orchid\Layouts\TUserSetting;

use App\Models\TUser;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;

class TUserSettingFiltersLayout extends Rows
{
    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('filter.id')
                ->type('text')
                ->title('ID')
                ->placeholder('ID'),

            Select::make('filter.t_user_id')
                ->fromModel(TUser::class, 'user_name', 'id')
                ->empty('全てのユーザー')
                ->title('ユーザー'),

            Input::make('filter.setting_key')
                ->type('text')
                ->title('設定キー')
                ->placeholder('設定キー'),

            Input::make('filter.setting_value')
                ->type('text')
                ->title('設定値')
                ->placeholder('設定値'),

            DateTimer::make('filter.created_at')
                ->title('作成日の範囲')
                ->placeholder('作成日の範囲')
                ->enableClearButton(),
        ];
    }
}