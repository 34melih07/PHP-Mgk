<?php

namespace Cekirdek;

class Rota
{
	/**
	 * @var array
	 */
	private $rotalar = [];

	/**
	 * Farklı açıklamalar Mgk.php dosyasında aynı isimli metodda yapıldı
	 * Bu metod sınıf içinde bilgileri depolar
	 */
	public function rota($metod, $duzenliIfade, $geriCagirim)
	{
		$this->rotalar[] = [$metod, rtrim($duzenliIfade, '/'), $geriCagirim];
	}

	/**
	 * Kontrol dosyasını oluşturan metod
	 * Rotaları çek ederken kullanılır
	 * @param string [$geriCagirim]
	 */
	private function kontrolCagir($geriCagirim)
	{
		$geriCagirim = explode('@', $geriCagirim);
		$kontrol = $geriCagirim[0].'Kontrol';
		$aksiyon = 'aksiyon'.ucfirst($geriCagirim[1]);

		$kontrolDosyasi = UYG_DIZINI.DA.'Kontroller'.DA.$kontrol.'.php';

		if (file_exists($kontrolDosyasi)) {
			$kontrol = '\Kontroller\\'.$kontrol;
			$obje = new $kontrol;

			// Benzer açıklamalar Mgk.php dosyasında yapıldı
			if (is_callable([$obje, $aksiyon])) {
				return [$obje, $aksiyon];
			}
		}
		Hata::sayfaBulunamadi();
	}

	/**
	 * Rotayı başlatan metod
	 * Bu metodda rotalar çek edilir ve buna göre çağırılır
	 * Daha detaylı açıklama eklenecek...
	 */
	public function baslat()
	{
		$karsiliklar = [
			':num' => '(\d+)',
			':sef' => '([a-zA-ZÇŞĞÜÖİçşğüöı0-9+_\-\. ]+)',
			':her' => '(.*)'
		];

		foreach($this->rotalar as $rota) {
			$im = $rota[0]; // İstek metodu (REQUEST_METHOD)
			$di = $rota[1]; // Düzenli ifade
			$gc = $rota[2]; // Geri çağırım

			if ($_SERVER['REQUEST_METHOD'] === $im || $im === 'ALL') {
				$di = '/^' . str_replace('/', '\/', strtr($di, $karsiliklar)) . '$/';

				if (preg_match($di, rtrim($_SERVER['QUERY_STRING'], '/'), $parametreler)) {
					array_shift($parametreler);

					if (is_string($gc)) $gc = $this->kontrolCagir($gc);
					return call_user_func_array($gc, array_values($parametreler));
				}
			}
		}
		Hata::sayfaBulunamadi();
	}
}
