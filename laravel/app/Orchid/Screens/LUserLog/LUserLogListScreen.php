<?php

namespace App\Orchid\Screens\LUserLog;

use App\Models\LUserLog;
use App\Orchid\Layouts\LUserLog\LUserLogListLayout;
use App\Orchid\Layouts\LUserLog\LUserLogFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class LUserLogListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'userlogs' => LUserLog::filters(LUserLogFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'ユーザーログ管理';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'システムに記録されているユーザーログの一覧';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('ログ追加')
                ->icon('bs.plus-circle')
                ->route('platform.systems.userlogs.create'),
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
            LUserLogFiltersLayout::class,
            LUserLogListLayout::class,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        LUserLog::findOrFail($request->get('id'))->delete();

        Toast::info('ログが削除されました');
    }
}