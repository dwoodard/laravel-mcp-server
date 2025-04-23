<?php

use App\AiAgents\OrchestratorAgent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-agent', function () {
    $message = request('message', 'How do I write a Laravel API controller?');

    $response = (new OrchestratorAgent('orchestrator-agent'))->respond($message);

    return response()->json([
        'input' => $message,
        'response' => $response,
    ]);
})
    ->name('debug-agent');
