<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\PayPal;
use App\Models\StatusBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Str;
use DateTime;

class PayPalPaymentController extends Controller
{

    public function handlePayment()
    {
        $booking = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_processing()->id]
        ])->first();

        $received = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_received()->id]
        ])->first();

        if ($booking) {
            $data = [];
            $data['items'] =
                [
                    [
                        'name' => Auth::user()->username,
                        'price' => $booking->car->price_start,
                        'desc'  => Auth::user()->username . 'rentalcar' . $booking->car_id,
                        'qty' => 1
                    ]
                ];
            $data['invoice_id'] = "PAYPAL_BOOKING" . Str::random(10) . Auth::user()->id . $booking->car_id;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Bill";
            $data['return_url'] = route('success.payment');
            $data['cancel_url'] = route('cancel.payment');
            $data['total'] = $booking->car->price_start;

            $pay_pal = new PayPal();
            $pay_pal->paypal_id = $data['invoice_id'];
            $pay_pal->booking_id = $booking->id;
            $pay_pal->user_id = $booking->user_id;
            $pay_pal->description = $data['invoice_description'];
            $pay_pal->total_paypal = $data['total'];
            $pay_pal->status = PayPal::STATUS_UNCOMPLETED;
            $pay_pal->save();
        }
        if ($received) {
            $pick_up_date = new DateTime($received->pick_up_date);
            $return_date = new DateTime($received->return_date);
            $hour = $return_date->diff($pick_up_date)->h;
            $day = $return_date->diff($pick_up_date)->d;
            $total_time = $day * 24 + $hour;
            $payable = $total_time * $received->car->price_hourly . ".00";

            $data = [];
            $data['items'] =
                [
                    [
                        'name' => Auth::user()->username,
                        'price' => $payable,
                        'desc'  => Auth::user()->username . 'rentalcar' . $received->car_id,
                        'qty' => 1
                    ]
                ];
            $data['invoice_id'] = "PAYPAL_RECEIVED" . Str::random(10) . Auth::user()->id;
            $data['invoice_description'] = "Order #{$data['invoice_id']} Bill";
            $data['return_url'] = route('success.payment');
            $data['cancel_url'] = route('cancel.payment');
            $data['total'] = $payable;

            $pay_pal = new PayPal();
            $pay_pal->paypal_id = $data['invoice_id'];
            $pay_pal->booking_id = $received->id;
            $pay_pal->user_id = $received->user_id;
            $pay_pal->description = $data['invoice_description'];
            $pay_pal->total_paypal = $data['total'];
            $pay_pal->status = PayPal::STATUS_UNCOMPLETED;
            $pay_pal->save();
        }

        $paypalModule = new ExpressCheckout;

        $response = $paypalModule->setExpressCheckout($data);
        $response = $paypalModule->setExpressCheckout($data, true);

        if ($response['paypal_link'] == null) {
            $booking = Booking::where([
                ['user_id', Auth::user()->id],
                ['status_id', $this->status_processing()->id]
            ])->first();

            $booking->status_id = $this->status_waiting()->id;
            $booking->save();

            $received = Booking::where([
                ['user_id', Auth::user()->id],
                ['status_id', $this->status_received()->id]
            ])->first();

            $received->status_id = $this->status_booked()->id;
            $received->save();
        }

        return redirect($response['paypal_link']);
    }

    public function paymentCancel()
    {
        $booking = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_processing()->id]
        ])->first();
        if ($booking) {
            $booking->status_id = $this->status_waiting()->id;
            $booking->save();
            $pay_pal = PayPal::where([
                ['user_id', Auth::user()->id],
                ['booking_id', $booking->id],
                ['status', PayPal::STATUS_UNCOMPLETED]
            ])->first();
            PayPal::find($pay_pal->id)->delete();
        }

        $received = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_received()->id]
        ])->first();
        if ($received) {
            $received->status_id = $this->status_booked()->id;
            $received->save();
            $pay_pal = PayPal::where([
                ['user_id', Auth::user()->id],
                ['booking_id', $received->id],
                ['status', PayPal::STATUS_UNCOMPLETED]
            ])->first();
            PayPal::find($pay_pal->id)->delete();
        }

        return redirect()->route('home.user')->with('message', 'Your payment has been declend');
    }

    public function paymentSuccess(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $booking = Booking::where([
                ['user_id', Auth::user()->id],
                ['status_id', $this->status_processing()->id]
            ])->first();
            if ($booking) {
                $booking->status_id = $this->status_booked()->id;
                $booking->save();

                $pay_pal = PayPal::where([
                    ['user_id', Auth::user()->id],
                    ['booking_id', $booking->id],
                    ['status', PayPal::STATUS_UNCOMPLETED]
                ])->first();
                $pay_pal->status = PayPal::STATUS_COMPLETED;
                $pay_pal->save();
            }

            $received = Booking::where([
                ['user_id', Auth::user()->id],
                ['status_id', $this->status_received()->id]
            ])->first();
            if ($received) {
                $received->status_id = $this->status_complete()->id;
                $received->save();

                $pay_pal = PayPal::where([
                    ['user_id', Auth::user()->id],
                    ['booking_id', $received->id],
                    ['status', PayPal::STATUS_UNCOMPLETED]
                ])->first();

                $pay_pal->status = PayPal::STATUS_COMPLETED;
                $pay_pal->save();
            }

            return redirect()->route('home.user')->with('message', 'Payment was successfull');
        }
        $booking = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_processing()->id]
        ])->first();
        if ($booking) {
            $booking->status_id = $this->status_waiting()->id;
            $booking->save();
        }

        $received = Booking::where([
            ['user_id', Auth::user()->id],
            ['status_id', $this->status_received()->id]
        ])->first();

        if ($received) {
            $received->status_id = $this->status_booked()->id;
            $received->save();
        }

        return redirect()->route('home.user')->with('message', 'Error occured!');
    }

    function booking(Request $request)
    {
        $booking =  Booking::find($request->id);

        $booking->status_id = $this->status_processing()->id;
        $booking->save();

        return redirect()->route('make.payment');
    }

    function received(Request $request)
    {
        $received =  Booking::find($request->id);
        $received->status_id = $this->status_received()->id;
        $received->save();

        return redirect()->route('make.payment');
    }

    public function status_complete()
    {
        return StatusBooking::where('name_status', 'complete')->first();
    }

    public function status_received()
    {
        return StatusBooking::where('name_status', 'received')->first();
    }

    public function status_processing()
    {
        return StatusBooking::where('name_status', 'processing')->first();
    }

    public function status_booked()
    {
        return StatusBooking::where('name_status', 'booked')->first();
    }

    public function status_waiting()
    {
        return StatusBooking::where('name_status', 'waiting')->first();
    }
}
