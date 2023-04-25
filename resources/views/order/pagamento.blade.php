@extends('layouts')

@section('title', 'Pagamento ordine')

@section('topbar')
    <x-topbar>
        <x-topbar-left>
        </x-topbar-left>
        <x-topbar-right>
            <x-cart-button></x-cart-button>
            <x-account-manage></x-account-manage>
        </x-topbar-right>
    </x-topbar>
@endsection

@section('header')
    <div class="g-0 row">
        <x-header></x-header>
    </div>
@endsection

@section('content')
    <div class="row g-0 flex-grow-1 p-4">
        <div class="col-lg-12">
            <script src="https://js.stripe.com/v3/"></script>

            <script type="text/javascript">
                // Create a Stripe client.
                var stripe = Stripe("{{ $checkout_public_key }}");
                stripe.redirectToCheckout({
                        // Get the id field from the Checkout Session creation API response
                        sessionId: '{{ $checkout_session_id }}'
                    })
                    .then(function(result) {
                        // If `redirectToCheckout` fails due to a browser or network
                        // error, display the localized error message to your customer
                        // using `result.error.message`.
                        if (result.error) {
                            alert(result.error.message);
                        }
                    })
                    .catch(function(error) {
                        console.error("Error:", error);
                    });
            </script>
        </div>
    </div>
@endsection
