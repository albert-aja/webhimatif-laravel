<?php

return [
    'preheader'         => 'Email dari :name',
    'auth' => [
        'subject'           => 'Email Aktivasi | :name',
        'activate'          => 'Aktifkan Akun :name anda',
        'confirmationText'  => 'Mohon konfirmasi email untuk mengaktifkan akun :name anda.',
        'confirmation'      => 'Konfirmasi Email',
        'expiredTime'       => 'Tautan aktivasi ini hanya berlaku 1 jam dan akan berakhir pada pukul :time',
        'notYou'            => 'Bukan Anda? Abaikan saja email ini.',
        'thanks'            => 'Terima Kasih'
    ],
    'modeChange'   => 'Pemberitahuan perubahan status website | :name',
    'maintenance' => [
        'title'     => 'Website saat ini dalam mode maintenance',
        'text1'     => 'Status website diubah menjadi <strong>Maintenance Mode</strong> oleh :admin pada pukul :time.',
        'text2'     => 'Untuk mengakses website, anda dapat menggunakan token bypass <strong>:token</strong> (cth: http://example.com/token)'
    ],
    'active' => [
        'title' => 'Website kembali diaktifkan',
        'text'  => 'Website sudah kembali diaktifkan oleh :admin pada pukul :time.',
    ]
]

?>