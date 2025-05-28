<?php

namespace App\Orchid\Layouts\TUserRole;

use App\Models\TUserRole;
use App\Models\TUser;
use App\Models\MUserRole;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;

class TUserRoleListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'tuserroles';

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
                ->render(function (TUserRole $tuserrole) {
                    return $tuserrole->user ? $tuserrole->user->user_name : '未設定';
                }),

            TD::make('m_user_role_id', 'ロール')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE)
                ->render(function (TUserRole $tuserrole) {
                    return $tuserrole->role ? $tuserrole->role->role_name : '未設定';
                }),

            TD::make('created_at', '作成日時')
                ->sort()
                ->render(function (TUserRole $tuserrole) {
                    return $tuserrole->created_at;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (TUserRole $tuserrole) {
                    return Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once deleted, the user role cannot be restored.'))
                        ->method('remove', [
                            'id' => $tuserrole->id,
                        ]);
                }),
        ];
    }
}