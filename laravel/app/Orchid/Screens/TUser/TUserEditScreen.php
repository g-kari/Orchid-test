<?php

namespace App\Orchid\Screens\TUser;

use App\Models\TUser;
use App\Orchid\Layouts\TUser\TUserEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TUserEditScreen extends Screen
{
    /**
     * @var TUser
     */
    public $tuser;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(TUser $tuser): iterable
    {
        return [
            'tuser' => $tuser,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->tuser->exists ? 'ユーザー編集' : 'ユーザー作成';
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
                ->canSee(!$this->tuser->exists),

            Button::make('更新')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee($this->tuser->exists),
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
            Layout::block(TUserEditLayout::class)
                ->title('ユーザー情報')
                ->description('ユーザーの基本情報を入力してください'),
        ];
    }

    /**
     * Save the user and return to the list.
     *
     * @param Request $request
     */
    public function save(TUser $tuser, Request $request)
    {
        $request->validate([
            'tuser.public_user_id' => [
                'required',
                Rule::unique(TUser::class, 'public_user_id')->ignore($tuser),
            ],
            'tuser.user_name' => 'required|string|max:255',
        ]);

        $tuser->fill($request->get('tuser'))->save();

        Toast::info($tuser->exists ? 'ユーザー情報が更新されました' : 'ユーザーが作成されました');

        return redirect()->route('platform.systems.tusers');
    }
}