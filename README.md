====== soal no 2.
== menggunakan laravel 10, serta database mysql.
//. clone project_merkle pada url berikut.
    == https://github.com/Rifkichairil/project_merkle

//. duplikat file .env.example menjadi .env

//. kemudian silahkan buat database yang nanti akan disesuaikan pada .env
    <!-- DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=<nama_database>
    DB_USERNAME=root
    DB_PASSWORD= -->


//. lakukan composer install dengan.
    == composer install

//. lakukan gerate key untuk .env
    == php artisan key:generate

//. kemudian lakukan migrate dengan.
    == php artisan migrate.

note: jika berhasil databse yang akan telah dibuat akan terrisi.
note: untuk login menggunakan Admin@merkle.com dan PasswordWeeding123
note: disini saya menggunakan auth sanctum untuk proses login pada api admin.

//. install sanctum dengan
    == composer require laravel/sanctum
    == doc => https://laravel.com/docs/10.x/sanctum


//. membuat command model dengan 
    == php artisan make:model <nama_model>
    
//. membuat command controller dengan 
    == php artisan make:controller <nama_controller>

//. membuat command request dengan (menggunakan ini agar terlihat lebih rapih pada tampilan controllernya, serta validasi terdapat pada semua file request yang dibuat. )
    == php artisan make:request <nama_request>

//. membuat command rule dengan (digunakan jika menggunakan custom rule)
    == php artisan make:rule <nama_rule>

note: biasanya ketika malakukan clone akan terjadi route not devine, bisa diatasi dengan cara
    == php artisan route:cache

//. unutk validasi pada phone. saya tidak menggunakan required karena takut data tersebut disalah gunakan.
