<?php

namespace App\MCP\Tools\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class ListFileStorageTool implements ToolInterface
{
    /**
     * Get the tool name.
     */
    public function getName(): string
    {
        return 'list_file_storage';
    }

    /**
     * Get the tool description.
     */
    public function getDescription(): string
    {
        return 'List files in a given Laravel storage directory.';
    }

    /**
     * Get the input schema for the tool.
     */
    public function getInputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'directory' => [
                    'type' => 'string',
                    'description' => 'The path to the directory in storage to list files from',
                ],
            ],
            'required' => ['directory'],
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
     */
    public function execute(array $arguments): array
    {
        Validator::make($arguments, [
            'directory' => ['string'],
        ])->validate();

        // Default to root if not provided
        $directory = $arguments['directory'] ?? '';

        // Use directoryExists for Laravel 9+, but only if directory is not root
        if ($directory !== '' && method_exists(\Illuminate\Support\Facades\Storage::class, 'directoryExists')) {
            if (! Storage::directoryExists($directory)) {
                return ["There is no directory called '{$directory}'"];
            }
        } elseif ($directory !== '' && ! is_dir(storage_path("app/{$directory}"))) {
            return ["There is no directory called '{$directory}'"];
        }

        // Use allFiles to list files recursively from the given directory (or root)
        return Storage::allFiles($directory);
    }
}
