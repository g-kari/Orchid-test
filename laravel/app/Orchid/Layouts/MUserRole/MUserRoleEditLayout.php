<?php

namespace App\Orchid\Layouts\MUserRole;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MUserRoleEditLayout extends Rows
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
            Input::make('userrole.role_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title('ロール名')
                ->placeholder('ロール名'),
        ];
    }
}