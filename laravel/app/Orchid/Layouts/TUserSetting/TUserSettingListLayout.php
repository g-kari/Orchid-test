<?php

namespace App\Orchid\Layouts\TUserSetting;

use App\Models\TUserSetting;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;

class TUserSettingListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'tusersettings';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE),

            TD::make('t_user_id', 'ユーザー')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE)
                ->render(function (TUserSetting $tusersetting) {
                    return $tusersetting->user ? $tusersetting->user->user_name : '未設定';
                }),

            TD::make('setting_key', '設定キー')
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('setting_value', '設定値')
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', '作成日時')
                ->sort()
                ->render(function (TUserSetting $tusersetting) {
                    return $tusersetting->created_at;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (TUserSetting $tusersetting) {
                    return Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once deleted, the setting cannot be restored.'))
                        ->method('remove', [
                            'id' => $tusersetting->id,
                        ]);
                }),
        ];
    }
}