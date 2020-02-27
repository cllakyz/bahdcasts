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
        $this->setSeo('Bahdcasts', 'The best web development training');
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

    /**
     * Change subscription plan
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        $this->validate($request, [
            'plan' => 'required|string|in:monthly,yearly'
        ]);

        $user = auth()->user();
        $userPlan = $user->subscriptions->first()->stripe_plan;

        if ($request->plan === $userPlan) {
            return redirect()->back();
        }

        $user->subscription($userPlan)->swap($request->plan);

        return redirect()->back();
    }
}
