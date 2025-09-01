<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;
use Exception;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function processPayment(Request $request, Product $product)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        try {
            $user = Auth::user();
            
            // Create or retrieve Stripe customer
            if (!$user->hasStripeId()) {
                $user->createAsStripeCustomer([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }

            // Method 1: Direct Stripe Payment Intent (Recommended)
            $paymentIntent = PaymentIntent::create([
                'amount' => $product->getPriceInCents(),
                'currency' => config('cashier.currency', 'usd'),
                'customer' => $user->stripe_id,
                'payment_method' => $request->payment_method,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('product.show', $product->id),
                // 'automatic_payment_methods' => [
                //     'enabled' => true,
                //     'allow_redirects' => 'never'
                // ],
                'description' => 'Purchase: ' . $product->name,
                'metadata' => [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'user_id' => $user->id,
                ],
            ]);

            // Handle different payment intent statuses
            if ($paymentIntent->status === 'succeeded') {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful! Thank you for your purchase.',
                    'payment_intent_id' => $paymentIntent->id
                ]);
            } elseif ($paymentIntent->status === 'requires_action') {
                return response()->json([
                    'success' => false,
                    'requires_action' => true,
                    'payment_intent' => [
                        'id' => $paymentIntent->id,
                        'client_secret' => $paymentIntent->client_secret
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed. Please try again.'
                ], 400);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed: ' . $e->getMessage()
            ], 400);
        }
    }

    // Alternative method using Laravel Cashier (if preferred)
    public function processPaymentCashier(Request $request, Product $product)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        try {
            $user = Auth::user();
            
            if (!$user->hasStripeId()) {
                $user->createAsStripeCustomer([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }

            // Use Laravel Cashier with proper options
            $paymentIntent = $user->charge(
                $product->getPriceInCents(),
                $request->payment_method,
                [
                    'description' => 'Purchase: ' . $product->name,
                    'return_url' => route('product.show', $product->id),
                    'automatic_payment_methods' => [
                        'enabled' => true,
                        'allow_redirects' => 'never'
                    ],
                    'metadata' => [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'user_id' => $user->id,
                    ],
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Thank you for your purchase.',
                'payment_intent_id' => $paymentIntent->id
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed: ' . $e->getMessage()
            ], 400);
        }
    }
}