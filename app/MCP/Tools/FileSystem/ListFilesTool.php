<?php

namespace App\MCP\Tools\FileSystem;

use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class ListFilesTool implements ToolInterface
{
    /**
     * Get the tool name.
     */
    public function getName(): string
    {
        return 'list-files';
    }

    /**
     * Get the tool description.
     */
    public function getDescription(): string
    {
        return 'Description of FileSystem/ListFilesTool';
    }

    /**
     * Get the input schema for the tool.
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
     */
    public function getAnnotations(): array
    {
        return [];
    }

    /**
     * Execute the tool.
     *
     * @param  array  $arguments  Tool arguments
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
