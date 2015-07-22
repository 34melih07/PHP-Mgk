<?php

namespace Kontroller;
use \Cekirdek\Kontrol;

/**
 * Ana kontrolü çağıran kontrol
 * Bütün kontroller için geçerli işlemler buradan yapılabilir
 */
class TemelKontrol extends Kontrol
{
	/**
	 * Başlatıcı metod
	 */
	public function __construct()
	{
		parent::__construct();
		// Görünüm fonksiyonlarını dahil eder
		$this->fonksiyonlariGetir('Gorunum');
	}
}
