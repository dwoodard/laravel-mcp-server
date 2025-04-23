<?php

// config for Maestroerror/LarAgent
return [

    /**
     * Default driver to use, binded in service provider
     * with \LarAgent\Core\Contracts\LlmDriver interface
     */
    // 'default_driver' => \LarAgent\Drivers\OpenAi\OpenAiCompatible::class,
    'default_driver' => App\LarAgent\Drivers\OllamaDriver::class,

    /**
     * Default chat history to use, binded in service provider
     * with \LarAgent\Core\Contracts\ChatHistory interface
     */
    'default_chat_history' => \LarAgent\History\InMemoryChatHistory::class,

    /**
     * Always keep provider named 'default'
     * You can add more providers in array
     * by copying the 'default' provider
     * and changing the name and values
     */
    'providers' => [
        'default' => [
            'label' => 'openai',
            'api_key' => env('OPENAI_API_KEY'),
            'default_context_window' => 50000,
            'default_max_completion_tokens' => 10000,
            'default_temperature' => 1,
        ],
        'ollama' => [
            'driver' => App\LarAgent\Drivers\OllamaDriver::class,
            'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
            'model' => 'llama3.2:latest',
        ],
    ],
];
