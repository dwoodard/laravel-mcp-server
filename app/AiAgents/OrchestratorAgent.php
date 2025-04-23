<?php

namespace App\AiAgents;

use LarAgent\Agent;

class OrchestratorAgent extends Agent
{
    protected $model = 'llama3.2:latest';

    protected $history = 'in_memory';

    protected $provider = 'default';

    protected $tools = [];

    public function instructions()
    {
        return <<<'INSTRUCTIONS'
        You are an intermediary assistant.
        Accept user queries, determine which specialized agent is best suited to handle the task, and forward the query to them.
        Return their response in a simplified and user-friendly format.
        INSTRUCTIONS;
    }

    public function prompt($message)
    {
        $messageLower = strtolower($message);

        return match (true) {
            str_contains($messageLower, 'code'),
            str_contains($messageLower, 'laravel'),
            str_contains($messageLower, 'vue'),
            str_contains($messageLower, 'api') => (new DeveloperAgent('developer-agent'))->respond($message),

            str_contains($messageLower, 'business'),
            str_contains($messageLower, 'strategy'),
            str_contains($messageLower, 'market') => (new BusinessAgent('business-agent'))->respond($message),

            str_contains($messageLower, 'data'),
            str_contains($messageLower, 'analytics'),
            str_contains($messageLower, 'dashboard') => (new DataAgent('data-agent'))->respond($message),

            str_contains($messageLower, 'finance'),
            str_contains($messageLower, 'budget'),
            str_contains($messageLower, 'revenue') => (new FinancialAgent('financial-agent'))->respond($message),

            str_contains($messageLower, 'sales'),
            str_contains($messageLower, 'leads'),
            str_contains($messageLower, 'outreach') => (new SalesAgent('sales-agent'))->respond($message),

            default => "I'm not sure which agent should handle this yet. Try rephrasing or being more specific."
        };

    }
}
