<x-app-layout>
    <div class="max-w-sm mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Sponsored Listing for: {{ $listing->title }}</h1>
        <form action="{{ route('listings.processPayment') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="listing_id" value="{{ $listing->id }}">

            <div class="mb-5">
                <label for="card-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit or Debit Card</label>
                <div id="card-number" class="p-2.5 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600">
                    <!-- Card Number Element -->
                </div>
                <div class="mt-2 text-sm text-red-600 dark:text-red-500" id="card-errors"></div>
            </div>

            <div class="grid gap-4 mb-5 grid-cols-2">
                <div>
                    <label for="expiry" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expiration Date</label>
                    <div id="expiry" class="p-2.5 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600">
                        <!-- Expiry Element -->
                    </div>
                </div>
                <div>
                    <label for="cvc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CVC</label>
                    <div id="cvc" class="p-2.5 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600">
                        <!-- CVC Element -->
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Pay $1.00
            </button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        var cardNumber = elements.create('cardNumber', {
            style: {
                base: {
                    color: '#32325d', // Tailwind text-gray-900 for light mode
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4' // Tailwind text-gray-400 for light mode
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        var cardExpiry = elements.create('cardExpiry', {
            style: {
                base: {
                    color: '#32325d', // Tailwind text-gray-900 for light mode
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4' // Tailwind text-gray-400 for light mode
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        var cardCvc = elements.create('cardCvc', {
            style: {
                base: {
                    color: '#32325d', // Tailwind text-gray-900 for light mode
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4' // Tailwind text-gray-400 for light mode
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });

        cardNumber.mount('#card-number');
        cardExpiry.mount('#expiry');
        cardCvc.mount('#cvc');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>
</x-app-layout>
