<mjml>
    <mj-body background-color="#f8f9fa">
        <mj-section>
            <mj-column background-color="white" padding="32px">
                <mj-text font-size="14px" align="center">{{ $site_subtitle }}</mj-text>
                <mj-text font-size="20px" align="center">{{ $site_title }} </mj-text>
                <mj-divider border-width="1px"></mj-divider>
                <mj-text padding-top="0" padding-bottom="0" align="center">
                    {{ __('emails.reset_password_text') }}
                </mj-text>
                <mj-button href="{{ $link }}"> {{ __('emails.reset_password_btn') }}
                </mj-button>
            </mj-column>
        </mj-section>
    </mj-body>
</mjml>
