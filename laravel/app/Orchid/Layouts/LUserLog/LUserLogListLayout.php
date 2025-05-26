<?php

namespace App\Orchid\Layouts\LUserLog;

use App\Models\LUserLog;
use App\Models\TUser;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;

class LUserLogListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'userlogs';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE),

            TD::make('t_user_id', 'ユーザーID')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE)
                ->render(function (LUserLog $userlog) {
                    return $userlog->user ? $userlog->user->user_name : '未設定';
                }),

            TD::make('log_type', 'ログタイプ')
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('log_message', 'ログメッセージ')
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', '作成日時')
                ->sort()
                ->render(function (LUserLog $userlog) {
                    return $userlog->created_at;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (LUserLog $userlog) {
                    return Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once deleted, the log cannot be restored.'))
                        ->method('remove', [
                            'id' => $userlog->id,
                        ]);
                }),
        ];
    }
}