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
            'action' => ['accessible', 'setDefault'],
        ],
        [
            'role' => '*',
            'controller' => '*',
            'action' => ['index'],
        ],
        [
            'role' => '*',
            'controller' => 'Invoices',
            'action' => ['add', 'billingo', 'edit', 'import', 'view'],
        ],
        [
            'role' => '*',
            'controller' => 'Partners',
            'action' => ['add', 'edit'],
        ],
        [
            'role' => '*',
            'controller' => 'Products',
            'action' => ['stock', 'add', 'edit', 'view'],
        ],
    ]
];