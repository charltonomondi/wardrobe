<?php

return [
    'paths' => ['api/*'], // Allow CORS for all API routes
    'allowed_origins' => ['http://localhost:5173'], // Allow requests from your frontend
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
