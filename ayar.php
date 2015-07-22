<?php

/**
 * Dizin ayarlamaları
 * Dosya sistemi için kullanılan dizin ayarlamaları
 * İhtiyaç halinde, Uygulama dizinini değiştirmeniz önerilir
 * http://siteadresi.com/Uygulama şeklinde erişimi güvenlik
 * açısından sıkıntılı olabilir. Bu yüzden bu dizini ana dizinden
 * bi üst dizine taşımanızı öneririm. Daha sonra değeri
 * ../Uygulama şeklinde değiştrebilirsiniz.
 */
define('ANA_DIZIN', __DIR__); // Ana dizin yolu
define('DA', DIRECTORY_SEPARATOR); // Dizin ayırıcı yani '/'
define('UYG_DIZINI', ANA_DIZIN.DA.'Uygulama'); // Uygulama dizin yolu
define('CEKIRDEK_DIZINI', UYG_DIZINI.DA.'Cekirdek'); // Çekirdek dizin yolu

/**
 * Uygulama URL ve ad bilgileri
 */
define('ANA_URL', 'http://mgk:8888'); // Ana URL
define('UYG_ADI', 'Kara Mvc'); // Uygulama adı

/**
 * Veritabanı bağlantı bilgileri
 * Veritabanı bağlantısı kurarken PDO sınıfından yararlanılır
 * Daha detaylı ayar yapmak isterseniz /Uygulama/Cekirdek/Model.php
 * dosyasını düzenleyebilirsiniz
 */
define('VT_DSN', 'mysql:dbname=mvc;dbhost=localhost'); // Veritabanı DSN'i
define('VT_KULLANICI', 'mgk'); // Veritabanı kullanıcı adı
define('VT_SIFRE', 'mgk'); // Veritabanı şifresi

/**
 * Geliştirme modu değiştirmeniz gereken önemli ayarlardandır
 * Eğer lokalde, sistemi geliştiriyorsanız TRUE değeri alması
 * Siteyi yayınladıysanız FALSE değeri alması önemlidir.
 * FALSE değeri aldığı taktirde, olabilecek herhangi bir hata ya da
 * istisna detayı kullanıcıya gösterilmeyecektir. Böylelikle
 * güvenlik açısından herhangi bir bilgi açığa çıkmayacaktır
 *
 * Temiz URL ise, Apache'de mod_rewrite eklentisinin aktif olup
 * olmamasıyla alakalıdır. Eğer kullanabiliyorsanız TRUE, kullanamıyorsanız
 * FALSE olarak değiştiriniz. FALSE yaptığınız taktirde URL'ler
 * siteadresi.com/?/kontrol/aksiyon/parametreler/1/2 şeklinde olacaktır
 * TRUE olursa siteadresi.com/kontrol/aksiyon/parametreler/1/2 şeklinde
 * olacaktır
 */
define('GELISTIRME_MODU', TRUE); // Geliştirme modu
define('TEMIZ_URL', TRUE); // Temiz URL (Mod Rewrite)
