@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Checkout for Order #{{ $order->id }}</h2>

    <div class="card p-3 mt-3" style="border-color:#ff6600;">
        <h5>Products:</h5>
        <ul>
            @if($order->products && $order->products->count())
                @foreach($order->products as $item)
                    <li>{{ $item->name }} - Qty: {{ $item->pivot->quantity }} - ${{ $item->price }}</li>
                @endforeach
            @else
                <li>No products in this order.</li>
            @endif
        </ul>

        <h4>Total: ${{ $order->total_price }}</h4>

        <!-- Stripe Payment Form -->
        <form id="payment-form">
            <div id="card-element" class="mb-3"></div>
            <button id="submit" class="btn btn-warning w-100" style="background-color:#ff6600; border:none;">
                Pay ${{ $order->total_price }}
            </button>
            <div id="card-errors" role="alert" class="mt-2 text-danger"></div>
        </form>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const clientSecret = "{{ $clientSecret }}";

    const elements = stripe.elements();

    // Only include card number, expiry, and CVC (hide ZIP)
    const card = elements.create('card', { hidePostalCode: true });
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        submitBtn.disabled = true;

        const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: { card }
        });

        if(error) {
            document.getElementById('card-errors').textContent = error.message;
            submitBtn.disabled = false;
        } else if(paymentIntent.status === 'succeeded') {
            // Post to server to mark order as paid
            fetch("{{ route('checkout.success', ['order' => $order->id]) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(res => window.location.href = "{{ route('user.orders') }}");
        }
    });
</script>
@endsection
