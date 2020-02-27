<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionsController extends Controller
{
    /**
     * Subscribe page function
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubscriptionForm()
    {
        return view('subscribe');
    }

    /**
     * User create subscription
     *
     * @param Request $request
     * @return mixed
     */
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'stripeToken' => 'required|string',
            'plan'        => 'required|string',
        ]);

        return auth()->user()
            ->newSubscription($request->plan, $request->plan)
            ->create($request->stripeToken);
    }
}
