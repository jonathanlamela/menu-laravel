@component('mail::message')
    <p>Gentile cliente abbiamo ricevuto il tuo pagamento.</p>
    <p><b>Codice ordine</b> : {{ $order->id }}</p>
    <p>Hai pagato: {{ number_format($order->total, 2) }} €</p>

    <b>Cosa c'era nel tuo ordine</b><br />
    <table style="width:100%">
        <thead>
            <tr>
                <td style="font-weight:bold">Nome</td>
                <td style="font-weight:bold">Prezzo</td>
                <td style="font-weight:bold">Quantità</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_details as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ number_format($item->price, 2) }} €</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endcomponent
