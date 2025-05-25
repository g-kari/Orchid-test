<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SampleScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Sample Screen';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Sample screen for Orchid evaluation';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'title' => 'Sample Form Data',
            'description' => 'This is a sample description',
            'status' => 'active'
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('save')
                ->method('save'),

            Button::make('Cancel')
                ->icon('close')
                ->method('cancel'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('title')
                    ->title('Title')
                    ->placeholder('Enter title')
                    ->help('The title of your sample form'),

                TextArea::make('description')
                    ->title('Description')
                    ->rows(5)
                    ->placeholder('Enter description')
                    ->help('A description for this sample'),

                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'pending' => 'Pending',
                        'inactive' => 'Inactive',
                    ])
                    ->title('Status')
                    ->help('Select the status'),
            ]),
        ];
    }

    /**
     * Save method.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'required',
        ]);

        Toast::info('Sample data saved successfully.');

        return redirect()->route('platform.sample');
    }

    /**
     * Cancel method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        Toast::info('Operation canceled.');

        return redirect()->route('platform.index');
    }
}