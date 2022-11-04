<?php

namespace App\Controllers;

use App\Controller;
use App\Models\LoginForm;
use App\Models\User;
use App\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->setLayout('auth');
    }

    public function login(Request $request)
    {
        $model = new LoginForm();
        if ($request->isPostMethod()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->login()) {
                return 'success';
            }
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function register(Request $request)
    {
        $registerModel = new User();
        if ($request->isPostMethod()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->save()) {
                session()->setFlash('success', 'Register uer has successfully!');
                return redirect('/');
            }
            return $this->render('register', [
                'model' => $registerModel,
            ]);
        }
        return $this->render('register', [
            'model' => $registerModel,
        ]);
    }
}
