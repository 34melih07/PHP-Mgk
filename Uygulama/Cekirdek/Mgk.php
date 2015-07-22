<?php

namespace Cekirdek;

/**
 * Uygulamayı yöneten sınıf
 */
class Mgk
{
	/**
	 * Kontrol katmanının adını taşır
	 * @var string
	 */
	protected $kontrol;

	/**
	 * Aksiyonun adını taşır
	 * @var string
	 */
	protected $aksiyon;

	/**
	 * Parametre adlarını taşır
	 * @var array
	 */
	protected $parametereler = [];

	/**
	 * Rota sınıfını taşır
	 * @var void
	 */
	protected $rota;

	/**
	 * Başlatıcı metod
	 * Bu metod uygulamanın geliştirme moduna göre ayarlar yapar
	 * Hata ayıklamayı belirler, URL barından bilgi alarak
	 * ayırır ve rota katmanını çağırır
	 */
	public function __construct()
	{
		if (GELISTIRME_MODU) {
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
		} else {
			error_reporting(0);
			ini_set('display_errors', 0);
		}

		set_exception_handler('\Cekirdek\Hata::istisnaYakala');

		$this->urlAyir();
		$this->rota = new Rota;
	}

	/**
	 * URL'leri ayıran metod
	 * siteadresi.com/anasayfa/aksiyonTest/parametreler/1/2
	 * şeklinde gelen bir isteği
	 * $kontrol = 'kontrol'
	 * $aksiyon = 'aksiyonTest'
	 * $parametreler = array('parametreler', 1, 2)
	 * şeklinde ayarlar ve sınıf içinde işlem yapmak üzere saklar
	 */
	private function urlAyir()
	{
		$qS = explode('/', rtrim($_SERVER['QUERY_STRING'], '/'));
		array_shift($qS);

		$this->kontrol = isset($qS[0]) ? ucfirst($qS[0]).'Kontrol' : 'AnasayfaKontrol';
		$this->aksiyon = isset($qS[1]) ? 'aksiyon'.ucfirst($qS[1]) : 'aksiyonIndeks';

		unset($qS[0], $qS[1]);

		$this->parametreler = array_values($qS);
	}

	/**
	 * Uygulamayı başlatan metod
	 * Kontrol, aksiyon ve parametre bilgilerini kullanarak
	 * bilgiler dahilinde uygulamayı çalıştırır. Odak noktası
	 * call_user_func_array fonksiyonudur. Bu sayede işlem yapar
	 */
	public function baslat()
	{
		$kontrolDosyasi = UYG_DIZINI.DA.'Kontroller'.DA.$this->kontrol.'.php';

    if (file_exists($kontrolDosyasi)) {

      $kontrol = '\Kontroller\\'.$this->kontrol;
			$obje = new $kontrol;

			// Eğer alınan bilgiler çağırılabilirse
			if (is_callable([$obje, $this->aksiyon])) {
				/**
				 * Bu fonksiyon sayesinde sınıf ve metodları parametreler kullanarak
				 * çağırabiliyoruz. Uygulama, yani çatı bu şekilde çalışıyor.
				 * Daha detaylı bilgi için PHP dökümantasyonuna bakabilirsiniz
				 */
				return call_user_func_array([$obje, $this->aksiyon], $this->parametreler);
			}
		}
		/**
		 * Eğer kontrol dosyası yoksa ve gelen bilgiler çağırılabilir değilse
		 * Rota sınıfını devreye sokuyoruz. Yani, rota sınıfı ikinci planda kalıyor
		 */
		return $this->rotayiBaslat();
	}

	/**
	 * Kontrol dosyası/metod bulunamadığında başlayan metod
	 */
	private function rotayiBaslat()
	{
		$this->kontrol = null;
		$this->aksiyon = null;
		$this->parametreler = [];
		return $this->rota->baslat();
	}

	/**
	 * Rotaları bu metod ile belirliyoruz
	 * @param string [$metod] İstek metodu (GET, POST, PUT, DELETE vs.)
	 * @param string [$duzenliIfade] yani /sayfa/5 ya da /sayfa/:num
	 * ya da /sayfa/((\d+)) şeklinde kullanılabilmesi mümkün
	 * @param string [$geriCagirim] Çağırılacak fonksiyon ya da Sınıf/metod
	 */
	public function rota($metod, $duzenliIfade, $geriCagirim)
	{
		return $this->rota->rota($metod, $duzenliIfade, $geriCagirim);
	}
}
