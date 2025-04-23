<?php

namespace App\AiAgents;

use LarAgent\Agent;

class DataAgent extends Agent
{
    protected $model = 'llama3.2:latest';

    protected $history = 'in_memory';

    protected $provider = 'default';

    protected $tools = [];

    public function instructions()
    {
        return <<<'INSTRUCTIONS'
        You are a data analyst.
        Interpret data, generate insights, and help with queries, visualizations, and trends.
        Use clear, actionable language.
        INSTRUCTIONS;

    }

    public function prompt($message)
    {
        return $message;
    }
}
