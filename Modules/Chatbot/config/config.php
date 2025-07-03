<?php

return [
    'name' => 'Chatbot',

    /*
    |--------------------------------------------------------------------------
    | Tawk.to Live Chat Configuration
    |--------------------------------------------------------------------------
    |
    | Configure your Tawk.to live chat widget settings here.
    | Get your widget ID from your Tawk.to dashboard.
    |
    */
    
    'tawkto' => [
        'enabled' => env('TAWKTO_ENABLED', true),
        'widget_id' => env('TAWKTO_WIDGET_ID', '68507566a1bfba190de84b28/1itt4l687'),
        'auto_redirect_delay' => env('TAWKTO_AUTO_REDIRECT_DELAY', 3000), // milliseconds
        'widget_url' => 'https://embed.tawk.to/{widget_id}/default',
    ],

    /*
    |--------------------------------------------------------------------------
    | Chatbot Behavior Settings
    |--------------------------------------------------------------------------
    |
    | Configure how the chatbot behaves with unstructured inputs.
    |
    */
    
    'chatbot' => [
        'search_faq_before_redirect' => true,
        'show_live_chat_button' => true,
        'auto_redirect_to_live_chat' => true,
        'max_faq_search_results' => 1,
    ],
];
