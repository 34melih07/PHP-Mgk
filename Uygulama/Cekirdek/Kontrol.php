<?php

namespace Cekirdek;

/**
 * Kontrol katmanı sınıfı
 */
class Kontrol
{
	/**
	 * Model bilgisini tutar
	 * @var string
	 */
	protected $model;

	/**
	 * Başlatıcı metod
	 */
	public function __construct()
	{

	}

	protected function modelGetir($model)
	{
		$modelDosyasi = UYG_DIZINI.DA.'Modeller'.DA.$model.'.php';

		if (file_exists($modelDosyasi)) {
			$model = '\Modeller\\'.$model;
			return new $model;
		}
		throw new \Exception('Model bulunamadı: ' . $model);
	}

	protected function modelBelirle($model)
	{
		$this->model = $this->modelGetir($model);
		return $this->model;
	}

	protected function yorumla($gorunum, $parametreler = [])
  {
    return Gorunum::yorumla($gorunum, $parametreler);
  }

	protected function fonksiyonlariGetir($fonksiyonlar)
	{
		$fonksiyonDosyasi = UYG_DIZINI.DA.'Fonksiyonlar'.DA.$fonksiyonlar.'.php';

		if (file_exists($fonksiyonDosyasi)) {
			require $fonksiyonDosyasi;
		} else {
			throw new \Exception('Fonksiyon kütüphanesi bulunamadı: ' . $fonksiyonlar);
		}
	}

	protected function yonlendir($yol)
	{
		header('Location: ' . $yol);
	}

	protected function url()
  {
    if (TEMIZ_URL) {
			$baslangic = ANA_URL;
		} else {
			$baslangic = ANA_URL.DA.'?';
		}

    return $baslangic.DA.implode('/', func_get_args());
  }
}
