<?php

namespace App\AiAgents;

use LarAgent\Agent;

class SalesAgent extends Agent
{
    protected $model = 'llama3.2:latest';

    protected $history = 'in_memory';

    protected $provider = 'default';

    protected $tools = [];

    public function instructions()
    {
        return <<<'INSTRUCTIONS'
     You are a sales strategist.
      Assist with sales funnels, messaging, lead generation, and objection handling. 
      Keep suggestions practical and persuasive."
    INSTRUCTIONS;
    }

    public function prompt($message)
    {
        return $message;
    }
}
