<?php
return [
  'AllowOrigin' => 'localhost:8080',
  'AllowMethods' => ['GET', 'POST', 'PATCH', 'OPTIONS', 'DELETE', 'PUT'],
  'AllowCredentials' => true, // TODO do we need this?
  'AllowHeaders' => ['Origin', 'Content-Type', 'Accept', 'X-Requested-With', 'ApiKey', 'Access-Control-Request-*'],
  'ExposeHeaders' => ['Link'],  // TODO do we need this?
  'MaxAge' => 300,
];