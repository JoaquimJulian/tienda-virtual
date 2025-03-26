<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
            'total' => 'required|numeric', // Asegúrate de que el total esté validado correctamente
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $request->total * 100, // Convertir a centavos
                'currency' => 'eur',
                'description' => 'Pago en tu tienda online',
                'source' => $request->stripeToken,
            ]);



            // Redirigir con mensaje de éxito
            return redirect()->route('app');
        } catch (\Exception $e) {
            return back()->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }
}
