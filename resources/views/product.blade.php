<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Product Details -->
                    <div class="space-y-6">
                        <!-- <div class="relative overflow-hidden rounded-2xl">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=400&fit=crop" 
                                 alt="{{ $product->name }}" 
                                 class=" h-80 object-cover">
                            <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                Sale
                            </div>
                        </div> -->
                        
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>
                            <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">{{ $product->description }}</p>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-4xl font-bold text-gray-900 dark:text-white">${{ $product->price }}</span>
                            <span class="text-sm text-gray-500 bg-green-100 px-2 py-1 rounded-full">Free Shipping</span>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl p-6">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">Complete Your Purchase</h3>
                        
                        <form id="payment-form" class="space-y-4">
                            @csrf
                            
                            <!-- Customer Information -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Full Name
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ Auth::user()->name ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                       required>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email Address
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ Auth::user()->email ?? '' }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-600 dark:border-gray-500 dark:text-white"
                                       required>
                            </div>
                            
                            <!-- Stripe Card Element -->
                            <div>
                                <label for="card-element" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Credit Card Information
                                </label>
                                <div id="card-element" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white">
                                    <!-- Stripe Elements will create form elements here -->
                                </div>
                                <div id="card-errors" class="text-red-600 text-sm mt-2"></div>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" 
                                    id="submit-payment" 
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-blue font-semibold py-4 px-6 rounded-lg transition duration-200 flex items-center justify-center space-x-2 shadow-lg">
                                <span id="button-text">Pay {{ $product->getFormattedPrice() }}</span>
                                <svg id="spinner" class="animate-spin h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </form>
                        
                        <!-- Security Info -->
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                🔒 Your payment information is encrypted and secure
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Successful!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Thank you for your purchase of <strong>{{ $product->name }}</strong>!
                        You will receive a confirmation email shortly.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Failed</h3>
                <div class="mt-2 px-7 py-3">
                    <p id="error-message" class="text-sm text-gray-500">
                        An error occurred while processing your payment.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="closeErrorModal" 
                            class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Try Again
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config("services.stripe.key") }}');
        const elements = stripe.elements();

        // Create card element with custom styling
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    fontFamily: 'Inter, system-ui, sans-serif',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
                invalid: {
                    color: '#9e2146',
                },
            },
        });

        cardElement.mount('#card-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-payment');
        const buttonText = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Disable submit button and show spinner
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');

            // Create payment method instead of token
            const { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
                billing_details: {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                }
            });

            if (error) {
                // Show error to customer
                document.getElementById('card-errors').textContent = error.message;
                resetButton();
            } else {
                // Send payment method to server
                submitPayment(paymentMethod);
            }
        });

        function submitPayment(paymentMethod) {
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('payment_method', paymentMethod.id);
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);

            fetch('{{ route("payment.process", $product) }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success modal
                    document.getElementById('successModal').classList.remove('hidden');
                } else {
                    // Show error modal
                    document.getElementById('error-message').textContent = data.message;
                    document.getElementById('errorModal').classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('error-message').textContent = 'An unexpected error occurred. Please try again.';
                document.getElementById('errorModal').classList.remove('hidden');
            })
            .finally(() => {
                resetButton();
            });
        }

        function resetButton() {
            submitButton.disabled = false;
            buttonText.classList.remove('hidden');
            spinner.classList.add('hidden');
        }

        // Handle real-time validation errors
        cardElement.on('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Close error modal
        document.getElementById('closeErrorModal').addEventListener('click', function() {
            document.getElementById('errorModal').classList.add('hidden');
        });

        // Close modals when clicking outside
        document.getElementById('successModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });

        document.getElementById('errorModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>