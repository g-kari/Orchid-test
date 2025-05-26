<?php

namespace App\Orchid\Layouts\LUserLog;

use App\Models\TUser;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class LUserLogEditLayout extends Rows
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
            Relation::make('userlog.t_user_id')
                ->title('ユーザー')
                ->required()
                ->fromModel(TUser::class, 'user_name', 'id'),

            Input::make('userlog.log_type')
                ->type('text')
                ->max(255)
                ->required()
                ->title('ログタイプ')
                ->placeholder('ログタイプ'),

            TextArea::make('userlog.log_message')
                ->rows(5)
                ->required()
                ->title('ログメッセージ')
                ->placeholder('ログメッセージ'),
        ];
    }
}