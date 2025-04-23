<?php

namespace App\MCP\Tools\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class ReadFileStorageTool implements ToolInterface
{
    /**
     * Get the tool name.
     */
    public function getName(): string
    {
        return 'read_file_storage';
    }

    /**
     * Get the tool description.
     */
    public function getDescription(): string
    {
        return 'Read a file from Laravel storage by path.';
    }

    /**
     * Get the input schema for the tool.
     */
    public function getInputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'file' => [
                    'type' => 'string',
                    'description' => 'The path to the file in storage to read',
                ],
            ],
            'required' => ['file'],
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
            'file' => ['required', 'string'],
        ])->validate();

        $filePath = $arguments['file'];

        // Check if the file exists in storage
        if (! Storage::exists($filePath)) {
            return "There is no file called '{$filePath}'";
        }

        // Use Laravel Storage facade to read the file
        $contents = Storage::get($filePath);

        return $contents;
    }
}
