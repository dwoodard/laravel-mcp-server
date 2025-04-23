<?php

namespace App\AiAgents;

use LarAgent\Agent;

class FinancialAgent extends Agent
{
    protected $model = 'llama3.2:latest';

    protected $history = 'in_memory';

    protected $provider = 'default';

    protected $tools = [];

    public function instructions()
    {
        return <<<'INSTRUCTIONS'
        You are a financial advisor.
        Handle budgeting, forecasting, cost analysis, and financial planning. 
        Prioritize clarity and accuracy.
        INSTRUCTIONS;
    }

    public function prompt($message)
    {
        return $message;
    }
}
