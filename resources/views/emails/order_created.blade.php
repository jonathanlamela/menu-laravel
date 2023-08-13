@component('mail::message')
    <p>Gentile cliente il tuo ordine è stato creato.</p>
    <p><b>Codice ordine</b> : {{ $order->id }}</p>
    <p>Totale da pagare alla consegna: {{ number_format($order->total, 2) }} €</p>


    <b>Cosa c'e nel tuo ordine</b><br />
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
