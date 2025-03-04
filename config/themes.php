<?php

return [
    'default' => 'volantijetcatering',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

        'velocity' => [
            'views_path' => 'resources/themes/velocity/views',
            // 'assets_path' => 'public/themes/velocity/assets',
            'name' => 'Velocity',
            'parent' => 'default'
        ],
    

    'volantijetcatering' => [
        'views_path' => 'resources/themes/volantijetcatering/views',
        'assets_path' => 'public/themes/volantijetcatering/assets',
        'name' => 'volantijetcatering',
        'parent' => 'default'
    ],

],

    'admin-default' => 'default',

    'admin-themes' => [
        'default' => [
            'views_path' => 'resources/admin-themes/default/views',
            'assets_path' => 'public/admin-themes/default/assets',
            'name' => 'Default'
        ]
    ]
];
