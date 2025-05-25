<?php

namespace App\Orchid\Layouts\LUserLog;

use App\Models\TUser;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;

class LUserLogFiltersLayout extends Rows
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

            Input::make('filter.log_type')
                ->type('text')
                ->title('ログタイプ')
                ->placeholder('ログタイプ'),

            Input::make('filter.log_message')
                ->type('text')
                ->title('ログメッセージ')
                ->placeholder('ログメッセージ'),

            DateTimer::make('filter.created_at')
                ->title('作成日の範囲')
                ->placeholder('作成日の範囲')
                ->enableClearButton(),
        ];
    }
}