# Model Context Protocol notes

php artisan make:mcp-tool MyCustomTool
//app/MCP/Tools/MyCustomTool.php

// MCP Inspector
npx @modelcontextprotocol/inspector node build/index.js

## Project Plan: laravel-mcp-server

## Project Overview

laravel-mcp-server is a Laravel-based implementation of the Model Context Protocol (MCP) server. It enables secure, real-time communication between AI agents, tools, and clients using Server-Sent Events (SSE) and a pub/sub messaging pattern. The server is designed for modularity, security, and compliance with MCP specifications.

## Objectives

- Implement a secure MCP server using Laravel
- Enable real-time communication via SSE
- Support modular tool and agent registration
- Use a pub/sub messaging pattern (e.g., Redis)
- Provide simple routing and middleware configuration

## Key Components & Features

- SSE endpoints for real-time updates
- Tool and agent registration (artisan commands & config)
- Pub/sub adapter integration (starting with Redis)
- Message routing and event handling
- Middleware for security and access control

## Workflow

1. Clients connect to SSE endpoints for real-time updates
2. Agents and tools are registered and orchestrated via MCP
3. Clients send requests to /message endpoints
4. Server processes requests and publishes responses via pub/sub
5. SSE delivers responses to clients in real time

## Milestones & Deliverables

- Initial Laravel & MCP server setup
- SSE endpoint implementation
- Tool/agent registration system
- Pub/sub messaging integration
- Core message routing & event handling
- Testing and validation
- Documentation and usage examples

## Challenges & Mitigation

- SSE compatibility: Use supported web servers (Octane, Nginx, etc.)
- Security: Implement robust middleware and access controls
- Integration: Ensure tools and agents comply with MCP specs
- Scalability: Use Redis and optimize pub/sub patterns

## Integration with MCP Ecosystem

- Expose a `/mcp/metadata` endpoint for server discovery (name, description, features, tools)
- Add `/mcp/health` endpoint for health/status checks
- Implement authentication endpoints for API key/session management
- Ensure endpoints return standardized JSON and support CORS
- Document how to submit your server to mcp.so for directory listing
- Consider adding tools for file, database, and API integration (see community servers for inspiration)

## Example Integrations (Inspired by Community MCP Servers)

- File system access with access controls
- Database querying (SQL, NoSQL)
- Web scraping or browser automation
- API connectors (e.g., GitHub, Slack, AWS, Figma, etc.)
- Specialized tools (calculator, time, weather, etc.)

## Next Steps

- Complete initial setup and configuration
- Implement and test each core feature
- Document usage and best practices
