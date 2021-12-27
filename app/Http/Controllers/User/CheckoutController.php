<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\checkout\StoreRequest;
use App\Mail\Checkout\AfterCheckout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Camp;
use App\Models\Checkout;
use Exception;
use Midtrans;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set midtrans configuration
        Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Camp $camp)
    {
        if ($camp->isRegistered) {
            $request->session()->flash('error', "You already registered on {$camp->title} camp.");
            return redirect(route('user.dashboard'));
        }
        return view('pages.checkout.index', ['camp' => $camp]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Camp $camp)
    {

        // mapping request data
        $data = $request->only([
            'name', 'email', 'occupation', 'card_number', 'expired', 'cvc'
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['camp_id'] = $camp->id;
        $data['created_at'] = date('Y-m-d H:i:s');

        // update user data
        $user = Auth::user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->occupation = $data['occupation'];
        $user->save();

        // create checkout
        $checkout = Checkout::create($data);
        // midtrans
        $this->getSnapRedirect($checkout);
        // send email
        Mail::to($user->email)->send(new AfterCheckout($checkout));
        return redirect(route('success.checkout'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function successCheckout()
    {
        return view('pages.checkout.success-checkout');
    }
    /**
     * midtrans handler
     */
    public function getSnapRedirect(Checkout $checkout)
    {
        $orderId    = $checkout->id . '-' . Str::random(5);
        $price      = $checkout->camp->price * 1000;

        $checkout->midtrans_booking_code = $orderId;
        $transaction_details = [
            'order_id'      => $orderId,
            'gross_amount'  => $price
        ];
        $item_details[] = [
            'id'            => $orderId,
            'price'         => $price,
            'quantity'      => 1,
            'name'          => "Payment for {$checkout->camp->title} camp",
            'merchant_name' => 'Laracamp'
        ];
        $dataUser = [
            'first_name'    =>  $checkout->user->name,
            'last_name'     =>  "",
            'email'         =>  $checkout->user->email,
            'phone'         =>  $checkout->user->phone,
            'address'       =>  $checkout->user->address,
            'city'          =>  "",
            'postal_code'   =>  "",
            'country_code'  =>  "IDN"
        ];
        $customer_details = [
            'first_name'        =>  $checkout->user->name,
            'last_name'         =>  "",
            'email'             =>  $checkout->user->email,
            'phone'             =>  $checkout->user->phone,
            'billing_address'   => $dataUser,
            'shipping_address'  => $dataUser
        ];
        $midtrans_params = [
            'transaction_details'   =>  $transaction_details,
            'item_details'          =>  $item_details,
            'customer_details'      =>  $customer_details
        ];
        try {
            // get snap payment URL
            $paymentUrl = \Midtrans\Snap::createTransaction($midtrans_params)->redirect_url;
            $checkout->midtrans_url = $paymentUrl;
            $checkout->save();
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
    }
}
