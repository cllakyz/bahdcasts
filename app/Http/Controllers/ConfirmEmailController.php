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
        $user = User::where('confirm_token', $token)->first();
        if($user){
            $user->confirm();
            session()->flash('success', 'Your email has been confirmed.');
        }
        else{
            session()->flash('error', 'Confirmation token not recognised.');
        }
        return redirect(route('index'));
    }
}
