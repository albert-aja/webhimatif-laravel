<?php

return [
    'title'     => 'Website Status',
    'online'    => 'Online',
    'offline'   => 'Offline',
    'mode' => [
        'active' => [
            'title' => 'Active Mode',
            'text'  => 'Website is active and can be accessed by the user!',
        ],
        'maintenance' => [
            'title' => 'Maintenance Mode',
            'text'  => 'Currently the user cannot access the website because it is in Maintenance Mode!',
        ],
    ],
    'config' => [
        '2maintenance' => [
            'title' => 'Are you sure you want to change the website status to Maintenance Mode?',
            'text'  => 'User cannot access the website during Maintenance Mode!',
            'mode'  => 'Maintenance Mode has been activated!',
            'still' => 'Website remains active',
        ],
        '2active' => [
            'title' => 'Reactivate Website?',
            'text'  => 'Users can access the website once activated!',
            'mode'  => 'Website is active now!',
            'still' => 'Website remains in Maintenance Mode',
        ]
    ]
]

?>