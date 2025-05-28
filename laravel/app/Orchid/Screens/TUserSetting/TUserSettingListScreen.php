<?php

namespace App\Orchid\Screens\TUserSetting;

use App\Models\TUserSetting;
use App\Orchid\Layouts\TUserSetting\TUserSettingListLayout;
use App\Orchid\Layouts\TUserSetting\TUserSettingFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TUserSettingListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tusersettings' => TUserSetting::with('user')->filters(TUserSettingFiltersLayout::class)
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'ユーザー設定管理';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'ユーザーごとの設定情報の一覧';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('ユーザー設定追加')
                ->icon('bs.plus-circle')
                ->route('platform.systems.tusersettings.create'),
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
            TUserSettingFiltersLayout::class,
            TUserSettingListLayout::class,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        TUserSetting::findOrFail($request->get('id'))->delete();

        Toast::info('ユーザー設定が削除されました');
    }
}