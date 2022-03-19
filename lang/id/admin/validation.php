<?php

return [
    'post' => [
        'publish_date' => [
            'required'  => 'Tanggal terbit belum diisi.',
            'date'      => 'Format tanggal tidak benar.'
        ],
        'title' => [
            'required'  => 'Berita belum memiliki judul.',
            'unique'    => 'Berita dengan judul ini sudah ada.',
        ],
        'hero_image' => [
            'required'  => 'Foto belum diupload.',
            'image'     => 'Berkas yang diupload tidak berformat gambar.',
            'file'      => 'Foto harus berupa berkas',
            'max'       => 'Ukuran file melewati batas maksimal (:max Kb).',
        ],
        'article' => [
            'required'  => 'Artikel belum ditulis.'
        ],
        'division' => [
            'required' => 'Divisi belum dipilih.'
        ]
    ],
    'division' => [
        'division' => [
            'required'  => 'Nama divisi belum diisi.',
            'unique'    => 'Divisi :input sudah ada.',
        ],
        'alias' => [
            'required'  => 'Alias divisi belum diisi.',
            'unique'    => 'Alias divisi sudah digunakan.',
        ],
    ]
]

?>