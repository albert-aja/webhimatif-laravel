<?php

return [
    'title'                 => 'Status Website',
    'online'                => 'Online',
    'offline'               => 'Offline',
    'status_maintenance'    => 'Saat ini website tidak dapat diakses oleh user karena sedang maintenance',
    'status_active'         => 'Website sedang aktif dan dapat diakses oleh user',
    'config' => [
        '2maintenance' => [
            'title' => 'Yakin ingin mengubah website menjadi Maintenance Mode?',
            'text'  => 'User tidak dapat mengakses website selama Maintenance Mode!',
            'mode'  => 'Maintenance Mode telah diaktifkan!',
            'still' => 'Website tetap aktif',
        ],
        '2active' => [
            'title' => 'Aktifkan Kembali Website?',
            'text'  => 'User dapat mengakses kembali website setelah diaktifkan!',
            'mode'  => 'Website sudah aktif sekarang!',
            'still' => 'Website tetap dalam Maintenance Mode',
        ]
    ]
]

?>