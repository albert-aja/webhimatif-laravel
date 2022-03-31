<?php

return [
    'required' => [
        'input'     => ':field belum diisi.',
        'select'    => ':field belum dipilih.',
        'upload'    => ':field belum diupload.'
    ],
    'image' => [
        'image'     => 'Berkas yang diupload tidak berformat gambar.',
        'file'      => ':field harus berupa berkas',
        'max'       => 'Ukuran file melewati batas maksimal (:max Kb).',
        'mime'      => 'Ekstensi gambar yang diizinkan adalah :mime.',
    ],
    'unique' => [
        'existed'   => ':field :input sudah ada.',
        'used'      => ':field :input sudah digunakan.'
    ],
    'exists'    => 'Data yang dipilih tidak valid',
    'integer'   => ':field harus berupa angka bulat.',
    'gt'        => 'Range harga tidak seimbang.',
    'regex' => [
        'hex' => ':input bukan merupakan kode hex',
    ],
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
    ],
    'commitee' => [
        'name'  => 'Nama pengurus belum diisi.',
        'photo' => [
            'required'  => 'Foto pengurus belum diupload.',
        ],
    ],
    'position' => [
        'required'  => 'Jabatan belum diisi.',
        'unique'    => 'Jabatan :input sudah ada.'
    ]
]

?>