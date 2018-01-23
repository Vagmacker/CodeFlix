<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Forms\UserSettingsForm;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class UserSettingsController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * UserSettingsController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user-settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.auth.settings', compact('form'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $form = \FormBuilder::create(UserSettingsForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $this->repository->update($data, \Auth::user()->id);
        $request->session()->flash('message', 'Senha alterada com sucesso!');

        return redirect()->route('admin.user-settings.edit');
    }
}