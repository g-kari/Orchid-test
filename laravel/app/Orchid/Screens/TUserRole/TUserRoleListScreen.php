<?php

namespace App\Orchid\Screens\TUserRole;

use App\Models\TUserRole;
use App\Orchid\Layouts\TUserRole\TUserRoleListLayout;
use App\Orchid\Layouts\TUserRole\TUserRoleFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TUserRoleListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tuserroles' => TUserRole::filters(TUserRoleFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'ユーザーロール管理';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'ユーザーに割り当てられたロールの一覧';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('ユーザーロール追加')
                ->icon('bs.plus-circle')
                ->route('platform.systems.tuserroles.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            TUserRoleFiltersLayout::class,
            TUserRoleListLayout::class,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        TUserRole::findOrFail($request->get('id'))->delete();

        Toast::info('ユーザーロールが削除されました');
    }
}