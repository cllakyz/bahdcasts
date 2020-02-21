<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmEmailController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $token = request('token');
        $user = User::where('confirm_token', $token)->firstOrFail();
        if($user){
            $user->confirm();
            return redirect(route('index'));
        }
    }
}
