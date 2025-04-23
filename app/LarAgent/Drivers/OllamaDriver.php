<?php

namespace App\LarAgent\Drivers;

use LarAgent\Core\Abstractions\LlmDriver;
use LarAgent\Core\Contracts\LlmDriver as LlmDriverInterface;
use LarAgent\Core\Contracts\ToolCall as ToolCallInterface;
use LarAgent\Messages\AssistantMessage;

class OllamaDriver extends LlmDriver implements LlmDriverInterface
{
    protected array $provider;

    public function __construct(array $provider = [])
    {
        parent::__construct($provider);
        $this->provider = $provider;
    }

    public function sendMessage(array $messages, array $options = []): AssistantMessage
    {
        $baseUrl = $this->provider['base_url'] ?? 'http://localhost:11434';
        $model = $this->provider['model'] ?? env('OLLAMA_MODEL', 'llama3');

        $payload = [
            'model' => $model,
            'messages' => $messages,
            'stream' => false,
        ];

        $response = $this->callOllama($baseUrl, $payload);

        return new AssistantMessage($response['message']['content'] ?? 'No response from Ollama');
    }

    protected function callOllama(string $url, array $payload): array
    {
        $client = new \GuzzleHttp\Client;

        $res = $client->post($url.'/api/chat', [
            'json' => $payload,
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return json_decode($res->getBody()->getContents(), true);
    }

    public function toolResultToMessage(ToolCallInterface $toolCall, mixed $result): array
    {
        $content = json_decode($toolCall->getArguments(), true);
        $content[$toolCall->getToolName()] = $result;

        return [
            'role' => 'tool',
            'content' => json_encode($content),
            'tool_call_id' => $toolCall->getId(),
        ];
    }

    public function toolCallsToMessage(array $toolCalls): array
    {
        $toolCallsArray = [];

        foreach ($toolCalls as $tc) {
            $toolCallsArray[] = [
                'id' => $tc->getId(),
                'type' => 'function',
                'function' => [
                    'name' => $tc->getToolName(),
                    'arguments' => $tc->getArguments(),
                ],
            ];
        }

        return [
            'role' => 'assistant',
            'tool_calls' => $toolCallsArray,
        ];
    }
}
