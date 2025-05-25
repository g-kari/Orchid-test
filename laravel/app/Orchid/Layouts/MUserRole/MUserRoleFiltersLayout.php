<?php

namespace App\Orchid\Layouts\MUserRole;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\DateTimer;

class MUserRoleFiltersLayout extends Rows
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

            Input::make('filter.role_name')
                ->type('text')
                ->title('ロール名')
                ->placeholder('ロール名'),

            DateTimer::make('filter.created_at')
                ->title('作成日の範囲')
                ->placeholder('作成日の範囲')
                ->enableClearButton(),
        ];
    }
}