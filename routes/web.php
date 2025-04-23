<?php

use App\AiAgents\OrchestratorAgent;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-agent', function () {
    $message = request('message', 'How do I write a Laravel API controller?');

    $response = (new OrchestratorAgent('orchestrator-agent'))->respond($message);

    // Render the response as Markdown using Laravel's Markdown facade
    $renderedMarkdown = Markdown::parse($response)->toHtml();

    // Show the rendered markdown as HTML on the page
    return response($renderedMarkdown)->header('Content-Type', 'text/html');
})
    ->name('debug-agent');
