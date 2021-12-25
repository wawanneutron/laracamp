<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Checkout\paid;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function updatePaid(Request $request, Checkout $checkout)
    {
        if (!$checkout->is_paid) {
            $checkout->is_paid = true;
            $checkout->updated_at = date('Y-m-d H:i:s');
            Mail::to($checkout->user->email)->send(new paid($checkout));

            $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated!");
        } else {
            $checkout->is_paid = false;
            $checkout->updated_at = date('Y-m-d H:i:s');
            $request->session()->flash('cancle', "Checkout with ID {$checkout->id} has been canled!");
        }
        $checkout->save();
        return redirect(route('admin.dashboard'));
    }
}
