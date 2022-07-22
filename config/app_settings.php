<?php

return [

    // All the sections for the settings page
    'sections' => [
        'app' => [
            'title' => 'Impostazioni generali',
            'icon' => 'fa fa-cog', // (optional)

            'inputs' => [
                [
                    'name' => 'app_name', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Nome del sito', // label for input
                    // optional properties
                    'placeholder' => 'Nome Sito', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|min:2|max:20', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
            ]
        ],
        'shipping' => [
            'title' => 'Spedizioni',
            'icon' => 'fa fa-cog',
            'inputs' => [
                [
                    'name' => 'shipping_costs', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Costi di spedizione', // label for input
                    // optional properties
                    'placeholder' => '0.00', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required|numeric', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
            ]
        ],
        'order' => [
            'title' => 'Ordini',
            'icon' => 'fa fa-cog',
            'inputs' => [
                [
                    'name' => 'order_state_created', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Stato per ordine pagato', // label for input
                    'placeholder' => 'Ordine creato', // placeholder for input
                    'class' => 'form-control mb-3', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
                [
                    'name' => 'order_state_paid', // unique key for setting
                    'type' => 'text', // type of input can be text, number, textarea, select, boolean, checkbox etc.
                    'label' => 'Stato per ordine pagato', // label for input
                    'placeholder' => 'Ordine pagato', // placeholder for input
                    'class' => 'form-control', // override global input_class
                    'style' => '', // any inline styles
                    'rules' => 'required', // validation rules for this input
                    'value' => '', // any default value
                    'hint' => '' // help block text for input
                ],
            ]
        ],
    ],

    // Setting page url, will be used for get and post request
    'url' => '/amministrazione/impostazioni',

    // Any middleware you want to run on above route
    'middleware' => [
        "can:isAdmin"
    ],

    // Route Names
    'route_names' => [
        'index' => 'settings.index',
        'store' => 'settings.store',
    ],

    // View settings
    'setting_page_view' => 'admin/impostazioni/index',
    'flash_partial' => 'app_settings::_flash',

    // Setting section class setting
    'section_class' => 'mb-3',
    'section_heading_class' => 'fw-bold',
    'section_body_class' => '',

    // Input wrapper and group class setting
    'input_wrapper_class' => 'form-group',
    'input_class' => 'form-control',
    'input_error_class' => 'has-error',
    'input_invalid_class' => 'is-invalid',
    'input_hint_class' => 'form-text text-muted',
    'input_error_feedback_class' => 'text-danger',

    // Submit button
    'submit_btn_text' => 'Salva impostazioni',
    'submit_success_message' => 'Impostazioni salvate.',

    // Remove any setting which declaration removed later from sections
    'remove_abandoned_settings' => false,

    // Controller to show and handle save setting
    'controller' => '\QCod\AppSettings\Controllers\AppSettingController',

    // settings group
    'setting_group' => function () {
        // return 'user_'.auth()->id();
        return 'default';
    }
];
