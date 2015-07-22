<?php

define('ANA_DIZIN', __DIR__); // Ana dizin yolu
define('DA', DIRECTORY_SEPARATOR); // Dizin ayırıcı
define('UYG_DIZINI', ANA_DIZIN.DA.'Uygulama'); // Uygulama dizin yolu
define('CEKIRDEK_DIZINI', UYG_DIZINI.DA.'Cekirdek'); // Çekirdek dizin yolu

define('ANA_URL', 'http://mgk:8888'); // Ana URL
define('UYG_ADI', 'Kara Mvc'); // Uygulama adı

define('VT_DSN', 'mysql:dbname=mvc;dbhost=localhost'); // Veritabanı DSN'i
define('VT_KULLANICI', 'mgk'); // Veritabanı kullanıcı adı
define('VT_SIFRE', 'mgk'); // Veritabanı şifresi

define('GELISTIRME_MODU', TRUE); // Geliştirme modu
define('TEMIZ_URL', TRUE); // Temiz URL (Mod Rewrite)
