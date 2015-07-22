<?php

require __DIR__.'/ayar.php';

/**
 * Otomatik Başlatıcı sınıfını dahil edip kayit() methodunu çağırıyoruz
 * Bu sayede kullanmak istediğimiz sınıf otomatik olarak sayfaya dahil
 * edilecek (require/include) ve sınıf çalıştırılacak. Ekstradan
 * Sınıf dosyasını çağırmamıza/dahil etmemize gerek kalmayacak.
 */
require CEKIRDEK_DIZINI.DA.'OtomatikBaslatici.php';
\Cekirdek\OtomatikBaslatici::kayit();

/**
 * Uygulamayı oluşturuyoruz
 * Örneğin burada çağırdığımız Mgk sınıfı Cekirdek dizini içerisinde bulunan
 * Mgk.php dosyası ve onun içinde isim uzayı tanımlanmış sınıf olan Mgk sınıfıdır.
 * Yukarıdaki otomatik başlatıcı sınıf sayesinde new \Isim\Uzayi\SinifAdi()
 * şeklinde sınıfları çağırabiliyoruz.
 */
$uygulama = new \Cekirdek\Mgk();

/**
 * Rota tanımlamaları
 */
$uygulama->rota('GET', '/giris', 'Anasayfa@indeks');
$uygulama->rota('GET', '/isim/:sef', 'Anasayfa@isim');

// Uygulamayı başlatalım
$uygulama->baslat();
