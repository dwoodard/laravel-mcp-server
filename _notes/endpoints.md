# Useful RESTful Endpoints for Self-Autonomy in laravel-mcp-server

## Agents

- `GET /mcp/agents` — List all agents
- `POST /mcp/agents` — Register a new agent
- `GET /mcp/agents/{id}` — Show a specific agent
- `PUT/PATCH /mcp/agents/{id}` — Update an agent
- `DELETE /mcp/agents/{id}` — Remove an agent

## Tools

- `GET /mcp/tools` — List all tools
- `POST /mcp/tools` — Register a new tool
- `GET /mcp/tools/{id}` — Show a specific tool
- `PUT/PATCH /mcp/tools/{id}` — Update a tool
- `DELETE /mcp/tools/{id}` — Remove a tool

## Context

- `GET /mcp/context` — Get shared context
- `POST /mcp/context` — Create new context
- `PUT/PATCH /mcp/context` — Update context
- `DELETE /mcp/context` — Clear context

## Tasks

- `GET /mcp/tasks` — List all tasks
- `POST /mcp/tasks` — Assign a new task
- `GET /mcp/tasks/{id}` — Get task status/result
- `PUT/PATCH /mcp/tasks/{id}` — Update a task
- `DELETE /mcp/tasks/{id}` — Remove a task

## Messages

- `POST /mcp/messages` — Send a message
- `GET /mcp/messages/{id}` — Get a message

## SSE

- `GET /mcp/sse` — Open SSE connection for real-time updates

## Metadata & Health

- `GET /mcp/metadata` — Server metadata for discovery (name, description, features, tools)
- `GET /mcp/health` — Server health and status

## Auth & Sessions

- `POST /mcp/auth/token` — Create API token
- `DELETE /mcp/auth/token/{id}` — Revoke API token
- `POST /mcp/sessions` — Start a new session
- `DELETE /mcp/sessions/{id}` — End a session

---
These endpoints follow Laravel RESTful conventions, using the seven HTTP verbs for resource management and self-autonomy.

Consider adding endpoints for file, database, and API integration, as well as specialized tools (calculator, time, weather, etc.), inspired by community MCP servers.
