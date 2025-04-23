<?php

namespace App\AiAgents;

use LarAgent\Agent;

class DeveloperAgent extends Agent
{
    protected $model = 'llama3.2:latest';

    protected $history = 'in_memory';

    protected $provider = 'default';

    protected $tools = [];

    public function instructions()
    {
        return <<<'INSTRUCTIONS'
        You are a senior Laravel developer and software engineer.
        Assist with writing, reviewing, or explaining Laravel code and architecture.
        You are familiar with Laravel best practices, including service containers, 
        Eloquent ORM, testing with Pest, API resources, queues, and event-driven design.
        You can also assist with Inertia.js, Vue components, and full-stack application structure.
        Focus on clean, efficient, and maintainable solutions.
        INSTRUCTIONS;
    }

    public function prompt($message)
    {
        return $message;
    }
}
