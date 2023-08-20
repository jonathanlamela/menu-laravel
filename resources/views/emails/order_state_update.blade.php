<mjml>
    <mj-body background-color="#f8f9fa">
        <mj-section>
            <mj-column background-color="white" padding="32px">
                <mj-text font-size="14px" align="center">Ristorante | Pizzeria </mj-text>
                <mj-text font-size="20px" align="center">Fittizzio </mj-text>
                <mj-divider border-width="1px"></mj-divider>
                <mj-text font-size="12px">
                    <p>Gentile cliente ci sono delle novità sul tuo ordine.</p>
                    <p>
                        <b>Codice ordine</b> : {{ $order_id }}
                    </p>
                    <p>
                        <b>Stato ordine:</b> {{ $new_order_state_name }}
                    </p>
                </mj-text>

            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
