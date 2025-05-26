<?php

namespace App\Orchid\Layouts\TUser;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class TUserEditLayout extends Rows
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
            Input::make('tuser.public_user_id')
                ->type('text')
                ->max(255)
                ->required()
                ->title('公開用ユーザーID')
                ->placeholder('公開用ユーザーID'),

            Input::make('tuser.user_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title('ユーザー名')
                ->placeholder('ユーザー名'),
        ];
    }
}