<?php

namespace App\Orchid\Screens\TUserRole;

use App\Models\TUserRole;
use App\Orchid\Layouts\TUserRole\TUserRoleEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TUserRoleEditScreen extends Screen
{
    /**
     * @var TUserRole
     */
    public $tuserrole;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(TUserRole $tuserrole): iterable
    {
        return [
            'tuserrole' => $tuserrole,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->tuserrole->exists ? 'ユーザーロール編集' : 'ユーザーロール作成';
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
                ->canSee(!$this->tuserrole->exists),

            Button::make('更新')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee($this->tuserrole->exists),
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
            Layout::block(TUserRoleEditLayout::class)
                ->title('ユーザーロール情報')
                ->description('ユーザーとロールの関連付け情報を入力してください'),
        ];
    }

    /**
     * Save the user role and return to the list.
     *
     * @param Request $request
     */
    public function save(TUserRole $tuserrole, Request $request)
    {
        $request->validate([
            'tuserrole.t_user_id' => 'required|exists:t_users,id',
            'tuserrole.m_user_role_id' => 'required|exists:m_user_roles,id',
        ]);

        $tuserrole->fill($request->get('tuserrole'))->save();

        Toast::info($tuserrole->exists ? 'ユーザーロール情報が更新されました' : 'ユーザーロールが作成されました');

        return redirect()->route('platform.systems.tuserroles');
    }
}