<?php

namespace Kontroller;

class AnasayfaKontrol extends TemelKontrol
{
	public function aksiyonIndeks()
	{
		$degiskenler['sayfaBasligi'] = 'Mgk Kod Çatısı';
		return $this->yorumla('index.php', $degiskenler);
		// veya:
		// return $this->yorumla('index.php', ['sayfaBasligi' => 'Mgk Kod Çatısı']);
	}

	public function aksiyonIsim($gelenIsim)
	{
		return $this->yorumla('isim.php', ['isim' => $gelenIsim]);
	}
}
