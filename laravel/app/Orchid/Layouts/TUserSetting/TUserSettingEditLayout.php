<?php

namespace App\Orchid\Layouts\TUserSetting;

use App\Models\TUser;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class TUserSettingEditLayout extends Rows
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
            Relation::make('tusersetting.t_user_id')
                ->title('ユーザー')
                ->required()
                ->fromModel(TUser::class, 'user_name', 'id'),

            Input::make('tusersetting.setting_key')
                ->type('text')
                ->max(255)
                ->required()
                ->title('設定キー')
                ->placeholder('設定キー'),

            TextArea::make('tusersetting.setting_value')
                ->rows(5)
                ->required()
                ->title('設定値')
                ->placeholder('設定値'),
        ];
    }
}