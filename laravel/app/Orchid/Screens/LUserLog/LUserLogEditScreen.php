<?php

namespace App\Orchid\Screens\LUserLog;

use App\Models\LUserLog;
use App\Orchid\Layouts\LUserLog\LUserLogEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class LUserLogEditScreen extends Screen
{
    /**
     * @var LUserLog
     */
    public $userlog;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(LUserLog $userlog): iterable
    {
        return [
            'userlog' => $userlog,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->userlog->exists ? 'ログ編集' : 'ログ作成';
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
                ->canSee(!$this->userlog->exists),

            Button::make('更新')
                ->icon('bs.check-circle')
                ->method('save')
                ->canSee($this->userlog->exists),
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
            Layout::block(LUserLogEditLayout::class)
                ->title('ログ情報')
                ->description('ログの詳細情報を入力してください'),
        ];
    }

    /**
     * Save the user log and return to the list.
     *
     * @param Request $request
     */
    public function save(LUserLog $userlog, Request $request)
    {
        $request->validate([
            'userlog.t_user_id' => 'required|exists:t_users,id',
            'userlog.log_type' => 'required|string|max:255',
            'userlog.log_message' => 'required',
        ]);

        $userlog->fill($request->get('userlog'))->save();

        Toast::info($userlog->exists ? 'ログ情報が更新されました' : 'ログが作成されました');

        return redirect()->route('platform.systems.userlogs');
    }
}