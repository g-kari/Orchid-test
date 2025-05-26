<?php

namespace App\Orchid\Layouts\TUser;

use App\Models\TUser;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;

class TUserListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'tusers';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE),

            TD::make('public_user_id', '公開用ユーザーID')
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('user_name', 'ユーザー名')
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', '作成日時')
                ->sort()
                ->render(function (TUser $tuser) {
                    return $tuser->created_at;
                }),

            TD::make('updated_at', '更新日時')
                ->sort()
                ->render(function (TUser $tuser) {
                    return $tuser->updated_at;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (TUser $tuser) {
                    return Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once deleted, the user cannot be restored.'))
                        ->method('remove', [
                            'id' => $tuser->id,
                        ]);
                }),
        ];
    }
}