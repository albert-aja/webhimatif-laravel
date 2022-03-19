<?php

return [
    'title'     => 'Status Website',
    'online'    => 'Online',
    'offline'   => 'Offline',
    'mode' => [
        'active' => [
            'title' => 'Active Mode',
            'text'  => 'Website sedang aktif dan dapat diakses oleh user!',
        ],
        'maintenance' => [
            'title' => 'Maintenance Mode',
            'text'  => 'Saat ini user tidak dapat mengakses website karena sedang dalam Maintenance Mode!',
        ],
    ],
    'config' => [
        '2maintenance' => [
            'title' => 'Yakin ingin mengubah website menjadi Maintenance Mode?',
            'text'  => 'User tidak dapat mengakses website selama Maintenance Mode!',
            'mode'  => 'Maintenance Mode telah diaktifkan!',
            'still' => 'Website tetap aktif',
        ],
        '2active' => [
            'title' => 'Aktifkan Kembali Website?',
            'text'  => 'User dapat mengakses website setelah diaktifkan!',
            'mode'  => 'Website sudah aktif sekarang!',
            'still' => 'Website tetap dalam Maintenance Mode',
        ]
    ]
]

?>