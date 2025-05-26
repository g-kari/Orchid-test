<?php

namespace App\Orchid\Screens\MUserRole;

use App\Models\MUserRole;
use App\Orchid\Layouts\MUserRole\MUserRoleEditLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class MUserRoleEditScreen extends Screen
{
    /**
     * @var MUserRole
     */
    public $userrole;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(MUserRole $userrole): iterable
    {
        return [
            'userrole' => $userrole,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->userrole->exists ? 'ロール編集' : 'ロール作成';
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
                ->canSee(!$this->userrole->exists),

            Button::make('更新')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee($this->userrole->exists),
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
            Layout::block(MUserRoleEditLayout::class)
                ->title('ロール情報')
                ->description('ロールの基本情報を入力してください'),
        ];
    }

    /**
     * Save the user role and return to the list.
     *
     * @param Request $request
     */
    public function save(MUserRole $userrole, Request $request)
    {
        $request->validate([
            'userrole.role_name' => [
                'required',
                Rule::unique(MUserRole::class, 'role_name')->ignore($userrole),
            ],
        ]);

        $userrole->fill($request->get('userrole'))->save();

        Toast::info($userrole->exists ? 'ロール情報が更新されました' : 'ロールが作成されました');

        return redirect()->route('platform.systems.userroles');
    }
}