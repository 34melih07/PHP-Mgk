<?php

namespace Cekirdek;

class Gorunum
{
  /**
   * Başlatıcı metod
   */
  public function __construct($dosya = null, $parametreler = [])
  {
    return $this->render($dosya, $parametreler);
  }

  public static function yorumla($dosya, $parametreler = [])
  {
    $gorunumDosyasi = UYG_DIZINI.DA.'Gorunumler'.DA.$dosya;

    if (file_exists($gorunumDosyasi)) {
      extract($parametreler);
      ob_start();
      require $gorunumDosyasi;
      echo ob_get_clean();
    } else {
      throw new \Exception('Görünüm bulunamadı: ' . $dosya);
    }
  }
}
