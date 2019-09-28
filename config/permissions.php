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
            'controller' => '*',
            'action' => ['index'],
        ],
        [
            'role' => '*',
            'controller' => 'Invoices',
            'action' => ['import'],
        ],
        [
            'role' => '*',
            'controller' => 'Products',
            'action' => ['stock'],
        ],
    ]
];
