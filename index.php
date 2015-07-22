<?php

require __DIR__.'/ayar.php';

require CEKIRDEK_DIZINI.DA.'OtomatikBaslatici.php';
\Cekirdek\OtomatikBaslatici::kayit();

$uygulama = new \Cekirdek\Mgk;

$uygulama->rota('GET', '/giris', 'Anasayfa@indeks');
$uygulama->rota('GET', '/isim/:sef', 'Anasayfa@isim');

$uygulama->baslat();
