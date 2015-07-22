<?php

namespace Cekirdek;

/**
 * Otomatik yükleyici sınıfı
 */
class OtomatikBaslatici
{
	/**
	 * @return void
	 */
	public static function kayit()
	{
		return spl_autoload_register(__NAMESPACE__ . "\\OtomatikBaslatici::baslat");
	}

	/**
	 * @param string [$className] Sınıf adı
	 */
	public static function baslat($sinifAdi)
	{
		$sinifAdi = ltrim($sinifAdi, '\\');
    $dosyaAdi  = '';
    $isimUzayi = '';
    if ($IuSonPoz = strrpos($sinifAdi, '\\')) {
        $isimUzayi = substr($sinifAdi, 0, $IuSonPoz);
        $sinifAdi = substr($sinifAdi, $IuSonPoz + 1);
        $dosyaAdi  = str_replace('\\', DA, $isimUzayi) . DA;
    }
    $dosyaAdi .= str_replace('_', DA, $sinifAdi) . '.php';
    $dosyaAdi = UYG_DIZINI.DA.$dosyaAdi;

    if (file_exists($dosyaAdi)) {
			require $dosyaAdi;
    }
	}
}
