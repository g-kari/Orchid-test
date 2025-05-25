<?php

namespace App\Orchid\Layouts\MUserRole;

use App\Models\MUserRole;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;

class MUserRoleListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    protected $target = 'userroles';

    /**
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->filter(TD::FILTER_NUMBER_RANGE),

            TD::make('role_name', 'ロール名')
                ->sort()
                ->filter(TD::FILTER_TEXT),

            TD::make('created_at', '作成日時')
                ->sort()
                ->render(function (MUserRole $userrole) {
                    return $userrole->created_at;
                }),

            TD::make('updated_at', '更新日時')
                ->sort()
                ->render(function (MUserRole $userrole) {
                    return $userrole->updated_at;
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (MUserRole $userrole) {
                    return Button::make(__('Delete'))
                        ->icon('bs.trash3')
                        ->confirm(__('Once deleted, the role cannot be restored.'))
                        ->method('remove', [
                            'id' => $userrole->id,
                        ]);
                }),
        ];
    }
}