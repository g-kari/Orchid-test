<?php

namespace App\Orchid\Layouts\TUser;

use App\Models\TUser;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;

class TUserFiltersLayout extends Rows
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

            Input::make('filter.public_user_id')
                ->type('text')
                ->title('公開用ユーザーID')
                ->placeholder('公開用ユーザーID'),

            Input::make('filter.user_name')
                ->type('text')
                ->title('ユーザー名')
                ->placeholder('ユーザー名'),

            DateTimer::make('filter.created_at')
                ->title('作成日の範囲')
                ->placeholder('作成日の範囲')
                ->enableClearButton(),
        ];
    }
}