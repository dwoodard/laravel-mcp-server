<?php

use App\AiAgents\OrchestratorAgent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-agent', function () {
    $message = request('message', 'How do I write a Laravel API controller?');

    $response = (new OrchestratorAgent('orchestrator-agent'))->respond($message);

    $renderedMarkdown = \Illuminate\Support\Facades\Markdown::parse($response)->toHtml();

    return response($renderedMarkdown)->header('Content-Type', 'text/html');
})
    ->name('debug-agent');
