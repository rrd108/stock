<?php
return [
    'CakeDC/Auth.permissions' => [
        [
            'role' => '*',
            'plugin' => 'CakeDC/Users',
            'controller' => 'Users',
            'action' => ['profile', 'logout'],
        ],
        [
            'role' => '*',
            'controller' => 'Stats',
            'action' => ['index'],
        ],
        [
            'role' => '*',
            'controller' => 'Companies',
            'action' => ['setDefault'],
        ]
    ]
];
