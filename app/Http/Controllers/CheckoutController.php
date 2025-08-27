<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\{Course, Payment};

class CheckoutController extends Controller
{
    //



    public function checkout(Course $course)
    {
        $amount = (int) round($course->price * 100); // PKR in paisa if enabled, else USD cents
        $stripe = new StripeClient(config('cashier.secret'));

        $pi = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => config('cashier.currency', 'usd'),
            'metadata' => ['course_id' => $course->id, 'user_id' => auth()->id()],
        ]);

        Payment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'amount' => $course->price,
            'status' => 'pending',
            'provider' => 'stripe',
            'provider_payment_id' => $pi->id,
        ]);

        return view('payments.checkout', [
            'clientSecret' => $pi->client_secret,
            'course' => $course,
        ]);
    }

    public function success(Request $r)
    {
        // In webhook/confirm flow, mark completed then enroll:
        // (Webhook recommended for production)
        return view('payments.success');
    }
    public function cancel()
    {
        return view('payments.cancel');
    }
}
