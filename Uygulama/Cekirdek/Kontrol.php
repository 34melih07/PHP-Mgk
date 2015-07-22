<?php

namespace Cekirdek;

/**
 * Kontrol katmanı sınıfı
 * Kontroller dosyasında kullanılmak üzere metodlar içerir
 * Örneğin, model veya fonksiyon çağırma metodları,
 * Yönlendirme, url üretme metodları gibi
 * İstendiği taktirde eklemeler yapılabilir
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
	 * Eklemeler yapılabilir
	 * Kaldırılmaması önerilir
	 */
	public function __construct()
	{

	}

	/**
	 * Model getiren metod
	 * @param string [$model] Model dsoyası adı
	 */
	protected function modelGetir($model)
	{
		// Dosyanın tam yolunu ayarlıyoruz
		$modelDosyasi = UYG_DIZINI.DA.'Modeller'.DA.$model.'.php';

		// Eğer dosya varsa
		if (file_exists($modelDosyasi)) {
			// Yeni bir model objesi oluşturuyoruz
			$model = '\Modeller\\'.$model;
			return new $model;
		}
		// Eğer dosya yoksa, istisna yaratıyoruz
		throw new \Exception('Model bulunamadı: ' . $model);
	}

	/**
	 * Sınıf içerisinde kullanılmak üzere model dosyasını belirleyen
	 * metoddur. Belirlendikten sonra sınıf içerisindeki $model değişkenine
	 * modeli yükler ve kontrol katmanında kullanılmasını sağlar
	 * @param string [$model] Model dosyası adı
	 */
	protected function modelBelirle($model)
	{
		$this->model = $this->modelGetir($model);
		return $this->model;
	}

	/**
	 * Görünüm dosyası yorumlayan metod
	 * Detaylar /Uygulama/Cekirdek/Gorunum.php dosyasında mevcut
	 * @param string [$gorunum] Görünüm dosyası
	 * @param array [$parametreler] Parametreler
	 */
	protected function yorumla($gorunum, $parametreler = [])
  {
    return Gorunum::yorumla($gorunum, $parametreler);
  }

	/**
	 * Kullanmak istediğimiz fonksiyonları çağıran metod
	 * Kullaınmı basittir, fonksiyon dosyasını çağırır
	 * yani include/require eder. Dosya yoksa hata verir
	 */
	protected function fonksiyonlariGetir($fonksiyonlar)
	{
		$fonksiyonDosyasi = UYG_DIZINI.DA.'Fonksiyonlar'.DA.$fonksiyonlar.'.php';

		if (file_exists($fonksiyonDosyasi)) {
			require $fonksiyonDosyasi;
		} else {
			throw new \Exception('Fonksiyon kütüphanesi bulunamadı: ' . $fonksiyonlar);
		}
	}

	/**
	 * Yönlendirme yapar
	 * @param string [$yol] Yönlendirilecek yer
	 */
	protected function yonlendir($yol)
	{
		header('Location: ' . $yol);
	}

	/**
	 * URL döndürür
	 * Fonksiyon parametrelerini alarak çalışır
	 * Temiz URL özelliği aktifse ona göre veri döndürür
	 */
	protected function url()
  {
		$baslangic = TEMIZ_URL ? ANA_URL : ANA_URL.DA.'?';
    return $baslangic.DA.implode('/', func_get_args());
  }
}
