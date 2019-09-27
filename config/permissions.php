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
            'controller' => 'Companies',
            'action' => ['setDefault'],
        ],
        [
            'role' => '*',
            'controller' => 'Invoices',
            'action' => ['index'],
        ],
        [
            'role' => '*',
            'controller' => 'Products',
            'action' => ['index'],
        ],
        [
            'role' => '*',
            'controller' => 'Stats',
            'action' => ['index'],
        ],
    ]
];
