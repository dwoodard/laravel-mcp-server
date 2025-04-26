<?php

namespace App\MCP\Tools;

use Illuminate\Support\Facades\Validator;
use OPGG\LaravelMcpServer\Services\ToolService\ToolInterface;

class FileSystemTool implements ToolInterface
{
    /**
     * Get the tool name.
     */
    public function getName(): string
    {
        return 'file-system';
    }

    /**
     * Get the tool description.
     */
    public function getDescription(): string
    {
        return 'Provides secure CRUD file system access: list, read, write, update, and delete files.';
    }

    /**
     * Get the input schema for the tool.
     */
    public function getInputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'operation' => [
                    'type' => 'string',
                    'enum' => ['list', 'read', 'write', 'update', 'delete'],
                    'description' => 'The file operation to perform.',
                ],
                'path' => [
                    'type' => 'string',
                    'description' => 'The file or directory path (relative to storage/app).',
                ],
                'content' => [
                    'type' => 'string',
                    'description' => 'The file content (for write/update operations).',
                ],
                'isBackground' => [
                    'type' => 'boolean',
                    'description' => 'Whether the operation should run in the background.',
                ],
            ],
            'required' => ['operation', 'path', 'isBackground'],
        ];
    }

    /**
     * Get the tool annotations.
     */
    public function getAnnotations(): array
    {
        return [
            'category' => 'filesystem',
            'security' => 'Access is restricted and validated. Only permitted directories are accessible.',
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array  $arguments  Tool arguments
     */
    public function execute(array $arguments): mixed
    {
        Validator::make($arguments, [
            'operation' => ['required', 'string', 'in:list,read,write,update,delete'],
            'path' => ['required', 'string'],
            'content' => ['sometimes', 'string'],
            'isBackground' => ['required', 'boolean'],
        ])->validate();

        $operation = $arguments['operation'];
        $path = ltrim($arguments['path'], '/');
        $content = $arguments['content'] ?? null;
        $storage = app('filesystem')->disk('local');

        switch ($operation) {
            case 'list':
                if ($storage->exists($path) && $storage->getDriver()->getAdapter()->isDirectory($path)) {
                    return $storage->files($path);
                }

                return $storage->allFiles($path);
            case 'read':
                if (! $storage->exists($path)) {
                    return ['error' => 'File does not exist.'];
                }

                return $storage->get($path);
            case 'write':
                if ($storage->exists($path)) {
                    return ['error' => 'File already exists. Use update to modify.'];
                }
                $storage->put($path, $content ?? '');

                return ['success' => true];
            case 'update':
                if (! $storage->exists($path)) {
                    return ['error' => 'File does not exist. Use write to create.'];
                }
                $storage->put($path, $content ?? '');

                return ['success' => true];
            case 'delete':
                if (! $storage->exists($path)) {
                    return ['error' => 'File does not exist.'];
                }
                $storage->delete($path);

                return ['success' => true];
            default:
                return ['error' => 'Invalid operation.'];
        }
    }
}
