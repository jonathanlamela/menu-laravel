<mjml>
    <mj-body background-color="#f8f9fa">
        <mj-section>
            <mj-column background-color="white" padding="32px">
                <mj-text font-size="14px" align="center">Ristorante | Pizzeria </mj-text>
                <mj-text font-size="20px" align="center">Fittizzio </mj-text>
                <mj-divider border-width="1px"></mj-divider>
                <mj-text font-size="12px">
                    <p>Gentile cliente il tuo ordine è stato creato.</p>
                    <p>
                        <b>Codice ordine</b> : {{ $order->id }}
                    </p>
                    <p>Totale da pagare alla consegna: {{ number_format($order->total, 2) }} €</p>
                </mj-text>
                <mj-text font-weight="bold" padding-top="0" padding-bottom="0">
                    Cosa c'e nel tuo ordine
                </mj-text>
                <mj-table>
                    <tr align="left">
                        <th>Nome</th>
                        <th align="center">Prezzo</th>
                        <th align="center">Quantità</th>
                    </tr>
                    @foreach ($order->orderDetails as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td align="center">{{ number_format($item->price, 2) }} €</td>
                            <td align="center">{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </mj-table>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
