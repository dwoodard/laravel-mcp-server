<?php

namespace App\MCP\Tools;

use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class MyCustomTool implements ToolInterface
{
    /**
     * Get the tool name.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'my-custom';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Description of MyCustomTool';
    }

    /**
     * Get the input schema for the tool.
     *
     * @return array
     */
    public function getInputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'param1' => [
                    'type' => 'string',
                    'description' => 'First parameter description',
                ],
                // Add more parameters as needed
            ],
            'required' => ['param1'],
        ];
    }

    /**
     * Get the tool annotations.
     *
     * @return array
     */
    public function getAnnotations(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param array $arguments Tool arguments
     * @return mixed
     */
    public function execute(array $arguments): string
    {
        Validator::make($arguments, [
            'param1' => ['required', 'string'],
            // Add more validation rules as needed
        ])->validate();

        $param1 = $arguments['param1'] ?? 'default';

        // Implement your tool logic here
        return "Tool executed with parameter: {$param1}";
    }
}
