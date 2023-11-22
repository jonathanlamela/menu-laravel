<mjml>
    <mj-body background-color="#f8f9fa">
        <mj-section>
            <mj-column background-color="white" padding="32px">
                <mj-text font-size="14px" align="center">{{ $site_subtitle }}</mj-text>
                <mj-text font-size="20px" align="center">{{ $site_title }} </mj-text>
                <mj-divider border-width="1px"></mj-divider>
                <mj-text font-size="12px">
                    <p>{{ __('emails.order_updated') }}</p>
                    <p>
                        <b>{{ __('emails.order_code') }}</b> : {{ $order_id }}
                    </p>
                    <p>
                        <b>{{ __('emails.order_state') }}:</b> {{ $new_order_state_name }}
                    </p>
                </mj-text>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
