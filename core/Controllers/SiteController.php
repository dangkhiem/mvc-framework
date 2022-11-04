<?php

namespace App\Controllers;

use App\Controller;
use App\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => 'TDKhiem',
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        $params = [
            'name' => 'TDKhiem',
        ];
        return $this->render('contact', $params);
    }

    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'Handlibg submit data';
    }
}
