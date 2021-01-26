<?php
return [
  'Cors' => [
    'AllowOrigin' => ['http://localhost:8080', 'https://stockr.1108.cc'],
    'AllowMethods' => ['GET', 'POST', 'PATCH', 'OPTIONS', 'DELETE', 'PUT'],
    //'AllowCredentials' => true,                                 // TODO do we need this?
    'AllowHeaders' => ['ApiKey', 'Content-Type'],
    //'ExposeHeaders' => ['Link'],                              // TODO do we need this?
    'MaxAge' => 300,
  ]
];