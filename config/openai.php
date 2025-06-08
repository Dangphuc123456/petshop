<?php

return [

    // Lấy API Key từ file .env
    'api_key' => env('CHATBOT_API_KEY'),

    // Model mặc định
    'default_model' => 'gpt-3.5-turbo',

    // URL API OpenAI (mặc định)
    'base_url' => 'https://api.openai.com/v1/',

    // Timeout khi gọi API (tuỳ chọn)
    'timeout' => 30,
];
