<?php

namespace Cekirdek;

/**
 * Görünüm sınıfı
 */
class Gorunum
{
  /**
   * Görünüm dosyasını yorumlayan metod
   * Bu sayede görünüm katmanı ayrılmış oluyor
   * Çok basit bir kullanıma sahiptir
   * @param string [$dosya] Dosya adı
   * @param array [$parametreler] Dosyaya gönderilecek parametreler
   */
  public static function yorumla($dosya, $parametreler = [])
  {
    /**
     * Görünüm dosyasının tam yolunu oluşturuyoruz
     */
    $gorunumDosyasi = UYG_DIZINI.DA.'Gorunumler'.DA.$dosya;

    // Eğer görünüm dosyası varsa işlemleri yapalım
    if (file_exists($gorunumDosyasi)) {
      /**
       * extract() fonksiyonu PHP'de array yani dizi içerisindeki
       * değerleri değişkene döndüren bir fonksiyondur
       * örneğin extract(array('a' => 'A harfi')); kodunu çalıştırdıktan sonra
       * echo $a; dediğimizde ekrana A harfi yazdırılır.
       */
      extract($parametreler);

      ob_start();
      require $gorunumDosyasi;
      echo ob_get_clean();

      // Eğer dosya yoksa, istisna yaratalım ve mesaj verelim:
    } else {
      throw new \Exception('Görünüm bulunamadı: ' . $dosya);
    }
  }
}
