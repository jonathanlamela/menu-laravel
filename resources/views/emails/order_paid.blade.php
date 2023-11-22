<mjml>
    <mj-body background-color="#f8f9fa">
        <mj-section>
            <mj-column background-color="white" padding="32px">
                <mj-text font-size="14px" align="center">{{ $site_subtitle }}</mj-text>
                <mj-text font-size="20px" align="center">{{ $site_title }} </mj-text>
                <mj-divider border-width="1px"></mj-divider>
                <mj-text font-size="12px">
                    <p>{{ __('emails.order_paid') }}</p>
                    <p>
                        <b>{{ __('emails.order_code') }}</b> : {{ $order->id }}
                    </p>
                    <p>{{ __('emails.total_paid') }}: {{ number_format($order->total_paid, 2) }} €</p>
                </mj-text>
                <mj-text font-weight="bold" padding-top="0" padding-bottom="0">
                    {{ __('emails.order_content') }}
                </mj-text>
                <mj-table>
                    <tr align="left">
                        <th>{{ __('emails.detail_name') }}</th>
                        <th align="center">{{ __('emails.detail_price') }}</th>
                        <th align="center">{{ __('emails.detail_quantity') }}</th>
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
