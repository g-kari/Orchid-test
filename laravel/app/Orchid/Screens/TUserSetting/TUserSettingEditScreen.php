<?php

namespace App\Orchid\Screens\TUserSetting;

use App\Models\TUserSetting;
use App\Orchid\Layouts\TUserSetting\TUserSettingEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TUserSettingEditScreen extends Screen
{
    /**
     * @var TUserSetting
     */
    public $tusersetting;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(TUserSetting $tusersetting): iterable
    {
        return [
            'tusersetting' => $tusersetting,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->tusersetting->exists ? 'ユーザー設定編集' : 'ユーザー設定作成';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('作成')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee(!$this->tusersetting->exists),

            Button::make('更新')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee($this->tusersetting->exists),
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
            Layout::block(TUserSettingEditLayout::class)
                ->title('ユーザー設定情報')
                ->description('ユーザーの設定情報を入力してください'),
        ];
    }

    /**
     * Save the user setting and return to the list.
     *
     * @param Request $request
     */
    public function save(TUserSetting $tusersetting, Request $request)
    {
        $request->validate([
            'tusersetting.t_user_id' => 'required|exists:t_users,id',
            'tusersetting.setting_key' => 'required|string|max:255',
            'tusersetting.setting_value' => 'required',
        ]);

        $tusersetting->fill($request->get('tusersetting'))->save();

        Toast::info($tusersetting->exists ? 'ユーザー設定情報が更新されました' : 'ユーザー設定が作成されました');

        return redirect()->route('platform.systems.tusersettings');
    }
}