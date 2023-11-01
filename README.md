# lib-sms-viro

## Instalasi

Jalankan perintah di bawah di folder aplikasi:

```
mim app install lib-sms-viro
```

## Konfigurasi

Pastikan menambahkan informasi koneksi ke smsviro seperti di bawah pada konfigurasi aplikasi:

```php
return [
    'libSmsViro' => [
        'apikey' => 'smsviro-apikey',
        'senderid' => 'SENDER_ID'
    ]
];
```
