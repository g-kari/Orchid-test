<?php

namespace App\Orchid\Screens\TUser;

use App\Models\TUser;
use App\Orchid\Layouts\TUser\TUserListLayout;
use App\Orchid\Layouts\TUser\TUserFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TUserListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tusers' => TUser::filters(TUserFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'ユーザー管理';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'システムに登録されているユーザーの一覧';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('ユーザー追加')
                ->icon('bs.plus-circle')
                ->route('platform.systems.tusers.create'),
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
            TUserFiltersLayout::class,
            TUserListLayout::class,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        TUser::findOrFail($request->get('id'))->delete();

        Toast::info('ユーザーが削除されました');
    }
}