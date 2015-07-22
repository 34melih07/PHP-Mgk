<?php

namespace Cekirdek;

class Mgk
{
	protected $kontrol;
	protected $aksiyon;
	protected $parametereler = [];
	protected $rota;

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

	private function urlAyir()
	{
		$qS = explode('/', rtrim($_SERVER['QUERY_STRING'], '/'));
		array_shift($qS);

		$this->kontrol = isset($qS[0]) ? ucfirst($qS[0]).'Kontrol' : 'AnasayfaKontrol';
		$this->aksiyon = isset($qS[1]) ? 'aksiyon'.ucfirst($qS[1]) : 'aksiyonIndeks';

		unset($qS[0], $qS[1]);

		$this->parametreler = array_values($qS);
	}

	public function baslat()
	{
		$kontrolDosyasi = UYG_DIZINI.DA.'Kontroller'.DA.$this->kontrol.'.php';

    if (file_exists($kontrolDosyasi)) {

      $kontrol = '\Kontroller\\'.$this->kontrol;
			$obje = new $kontrol;

			if (is_callable([$obje, $this->aksiyon])) {
				return call_user_func_array([$obje, $this->aksiyon], $this->parametreler);
			}
		}
		return $this->rotayiBaslat();
	}

	private function rotayiBaslat()
	{
		$this->kontrol = null;
		$this->aksiyon = null;
		$this->parametreler = [];
		return $this->rota->baslat();
	}

	public function rota($metod, $duzenliIfade, $geriCagirim)
	{
		return $this->rota->rota($metod, $duzenliIfade, $geriCagirim);
	}
}
