<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Isian :attribute harus diterima.',
    'active_url'           => 'Isian :attribute bukan URL yang sah.',
    'after'                => 'Isian :attribute harus tanggal setelah :date.',
    'after_or_equal'       => 'Isian :attribute harus tanggal setelah atau sama dengan :date.',
    'alpha'                => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash'           => 'Isian :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num'            => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    'array'                => 'Isian :attribute harus berupa sebuah array.',
    'before'               => 'Isian :attribute harus tanggal sebelum :date.',
    'before_or_equal'      => 'Isian :attribute harus tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => 'Isian :attribute harus antara :min dan :max.',
        'file'    => 'Isian :attribute harus antara :min dan :max kilobytes.',
        'string'  => 'Isian :attribute harus antara :min dan :max karakter.',
        'array'   => 'Isian :attribute harus antara :min dan :max item.',
    ],
    'boolean'              => 'Isian :attribute harus berupa true atau false',
    'confirmed'            => 'Konfirmasi :attribute tidak cocok.',
    'date'                 => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals'          => 'Isian :attribute harus tanggal yang sama dengan :date.',
    'date_format'          => 'Isian :attribute tidak cocok dengan format :format.',
    'different'            => 'Isian :attribute dan :other harus berbeda.',
    'digits'               => 'Isian :attribute harus berupa angka :digits.',
    'digits_between'       => 'Isian :attribute harus antara angka :min dan :max.',
    'dimensions'           => 'Isian :attribute harus merupakan dimensi gambar yang sah.',
    'distinct'             => 'Isian :attribute memiliki nilai yang duplikat.',
    'email'                => 'Isian :attribute harus berupa alamat surel yang valid.',
    'ends_with'            => 'Isian :attribute harus diakhiri dengan: :values.',
    'exists'               => 'Isian :attribute yang dipilih tidak valid.',
    'file'                 => 'Isian :attribute harus berupa file.',
    'filled'               => 'Isian :attribute wajib diisi.',
    'gt' => [
        'numeric'   => 'Isian :attribute harus lebih besar dari :value.',
        'file'      => 'Isian :attribute harus lebih besar dari :value kilobytes.',
        'string'    => 'Isian :attribute harus lebih besar dari :value karakter.',
        'array'     => 'Isian :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric'   => 'Isian :attribute harus lebih besar dari atau sama dengan :value.',
        'file'      => 'Isian :attribute harus lebih besar dari atau sama dengan :value kilobytes.',
        'string'    => 'Isian :attribute harus lebih besar dari atau sama dengan :value karakter.',
        'array'     => 'Isian :attribute harus memiliki :value item atau lebih.',
    ],
    'image'                => 'Isian :attribute harus berupa gambar.',
    'in'                   => 'Isian :attribute yang dipilih tidak valid.',
    'in_array'             => 'Isian :attribute tidak terdapat dalam :other.',
    'integer'              => 'Isian :attribute harus merupakan bilangan bulat.',
    'ip'                   => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4'                 => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'                 => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json'                 => 'Isian :attribute harus berupa JSON string yang valid.',
    'lt' => [
        'numeric'   => 'Isian :attribute harus kurang dari :value.',
        'file'      => 'Isian :attribute harus kurang dari :value kilobytes.',
        'string'    => 'Isian :attribute harus kurang dari :value karakter.',
        'array'     => 'Isian :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric'   => 'Isian :attribute harus kurang dari atau sama dengan :value.',
        'file'      => 'Isian :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string'    => 'Isian :attribute harus kurang dari atau sama dengan :value karakter.',
        'array'     => 'Isian :attribute tidak boleh lebih dari :value item.',
    ],
    'max'                  => [
        'numeric' => 'Isian :attribute seharusnya tidak lebih dari :max.',
        'file'    => 'Isian :attribute seharusnya tidak lebih dari :max kilobytes.',
        'string'  => 'Isian :attribute seharusnya tidak lebih dari :max karakter.',
        'array'   => 'Isian :attribute seharusnya tidak lebih dari :max item.',
    ],
    'mimes'                => 'Isian :attribute harus dokumen berjenis : :values.',
    'mimetypes'            => 'Isian :attribute harus berupa file bertipe: :values.',
    'min'                  => [
        'numeric' => 'Isian :attribute harus minimal :min.',
        'file'    => 'Isian :attribute harus minimal :min kilobytes.',
        'string'  => 'Isian :attribute harus minimal :min karakter.',
        'array'   => 'Isian :attribute harus minimal :min item.',
    ],
    'not_in'               => 'Isian :attribute yang dipilih tidak valid.',
    'not_regex'            => 'Isian :attribute format tidak valid.',
    'numeric'              => 'Isian :attribute harus berupa angka.',
    'password'             => 'Kata sandi tidak benar',
    'present'              => 'Isian :attribute wajib ada.',
    'regex'                => 'Format isian :attribute tidak valid.',
    'required'             => 'Isian :attribute wajib diisi.',
    'required_if'          => 'Isian :attribute wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Isian :attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => 'Isian :attribute wajib diisi bila terdapat :values.',
    'required_without'     => 'Isian :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Isian :attribute wajib diisi bila tidak terdapat ada :values.',
    'same'                 => 'Isian :attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Isian :attribute harus berukuran :size.',
        'file'    => 'Isian :attribute harus berukuran :size kilobyte.',
        'string'  => 'Isian :attribute harus berukuran :size karakter.',
        'array'   => 'Isian :attribute harus mengandung :size item.',
    ],
    'starts_with'          => 'Isian :attribute harus dimulai dengan: :values.',
    'string'               => 'Isian :attribute harus berupa string.',
    'timezone'             => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique'               => 'Isian :attribute sudah ada sebelumnya.',
    'uploaded'             => 'Isian :attribute gagal mengunggah.',
    'url'                  => 'Format isian :attribute tidak valid.',
    'uuid'                 => 'Isian :attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address'                  => 'alamat',
        'affiliate_url'            => 'URL afiliasi',
        'age'                      => 'usia',
        'amount'                   => 'jumlah',
        'announcement'             => 'pengumuman',
        'area'                     => 'daerah',
        'audience_prize'           => 'hadiah penonton',
        'audience_winner'          => 'audience winner',
        'available'                => 'tersedia',
        'birthday'                 => 'hari ulang tahun',
        'body'                     => 'badan',
        'city'                     => 'kota',
        'company'                  => 'company',
        'compilation'              => 'kompilasi',
        'concept'                  => 'konsep',
        'conditions'               => 'kondisi',
        'content'                  => 'konten',
        'contest'                  => 'contest',
        'country'                  => 'negara',
        'cover'                    => 'menutupi',
        'created_at'               => 'dibuat di',
        'creator'                  => 'pencipta',
        'currency'                 => 'mata uang',
        'current_password'         => 'kata sandi saat ini',
        'customer'                 => 'pelanggan',
        'date'                     => 'tanggal',
        'date_of_birth'            => 'tanggal lahir',
        'dates'                    => 'tanggal',
        'day'                      => 'hari',
        'deleted_at'               => 'dihapus pada',
        'description'              => 'deskripsi',
        'display_type'             => 'tipe tampilan',
        'district'                 => 'daerah',
        'duration'                 => 'durasi',
        'email'                    => 'surel',
        'excerpt'                  => 'kutipan',
        'filter'                   => 'Saring',
        'finished_at'              => 'selesai pada',
        'first_name'               => 'nama depan',
        'gender'                   => 'jenis kelamin',
        'grand_prize'              => 'hadiah utama',
        'group'                    => 'kelompok',
        'hour'                     => 'jam',
        'image'                    => 'gambar',
        'image_desktop'            => 'gambar desktop',
        'image_main'               => 'gambar utama',
        'image_mobile'             => 'gambar seluler',
        'images'                   => 'gambar-gambar',
        'is_audience_winner'       => 'adalah pemenang penonton',
        'is_hidden'                => 'tersembunyi',
        'is_subscribed'            => 'berlangganan',
        'is_visible'               => 'terlihat',
        'is_winner'                => 'adalah pemenang',
        'items'                    => 'item',
        'key'                      => 'kunci',
        'last_name'                => 'nama belakang',
        'lesson'                   => 'pelajaran',
        'line_address_1'           => 'alamat baris 1',
        'line_address_2'           => 'alamat baris 2',
        'login'                    => 'Gabung',
        'message'                  => 'pesan',
        'middle_name'              => 'nama tengah',
        'minute'                   => 'menit',
        'mobile'                   => 'seluler',
        'month'                    => 'bulan',
        'name'                     => 'nama',
        'national_code'            => 'kode nasional',
        'number'                   => 'nomor',
        'password'                 => 'kata sandi',
        'password_confirmation'    => 'konfirmasi kata sandi',
        'phone'                    => 'telepon',
        'photo'                    => 'foto',
        'portfolio'                => 'portofolio',
        'postal_code'              => 'kode Pos',
        'preview'                  => 'pratinjau',
        'price'                    => 'harga',
        'product_id'               => 'ID Produk',
        'product_uid'              => 'UID produk',
        'product_uuid'             => 'UUID produk',
        'promo_code'               => 'Kode promosi',
        'province'                 => 'propinsi',
        'quantity'                 => 'kuantitas',
        'reason'                   => 'alasan',
        'recaptcha_response_field' => 'bidang respons recaptcha',
        'referee'                  => 'wasit',
        'referees'                 => 'wasit',
        'reject_reason'            => 'menolak alasan',
        'remember'                 => 'ingat',
        'restored_at'              => 'dipulihkan pada',
        'result_text_under_image'  => 'teks hasil di bawah gambar',
        'role'                     => 'peran',
        'rule'                     => 'aturan',
        'rules'                    => 'aturan',
        'second'                   => 'detik',
        'sex'                      => 'jenis kelamin',
        'shipment'                 => 'pengiriman',
        'short_text'               => 'teks pendek',
        'size'                     => 'ukuran',
        'skills'                   => 'keterampilan',
        'slug'                     => 'siput',
        'specialization'           => 'spesialisasi',
        'started_at'               => 'dimulai pada',
        'state'                    => 'negara',
        'status'                   => 'status',
        'street'                   => 'jalan',
        'student'                  => 'siswa',
        'subject'                  => 'subyek',
        'tag'                      => 'menandai',
        'tags'                     => 'tag',
        'teacher'                  => 'guru',
        'terms'                    => 'ketentuan',
        'test_description'         => 'deskripsi tes',
        'test_locale'              => 'uji lokal',
        'test_name'                => 'nama tes',
        'text'                     => 'teks',
        'time'                     => 'waktu',
        'title'                    => 'judul',
        'type'                     => 'jenis',
        'updated_at'               => 'diperbarui pada',
        'user'                     => 'pengguna',
        'username'                 => 'nama pengguna',
        'value'                    => 'nilai',
        'winner'                   => 'winner',
        'work'                     => 'work',
        'year'                     => 'tahun',
    ],
];
