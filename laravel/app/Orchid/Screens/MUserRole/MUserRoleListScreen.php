<?php

namespace App\Orchid\Screens\MUserRole;

use App\Models\MUserRole;
use App\Orchid\Layouts\MUserRole\MUserRoleListLayout;
use App\Orchid\Layouts\MUserRole\MUserRoleFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class MUserRoleListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'userroles' => MUserRole::filters(MUserRoleFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'ロール管理';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'システムに登録されているロールの一覧';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('ロール追加')
                ->icon('bs.plus-circle')
                ->route('platform.systems.userroles.create'),
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
            MUserRoleFiltersLayout::class,
            MUserRoleListLayout::class,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        MUserRole::findOrFail($request->get('id'))->delete();

        Toast::info('ロールが削除されました');
    }
}