<?php

namespace Cekirdek;

/**
 * Hata kontrol sınıfı
 * Hataları kolayca kontrol etmemize yarar
 */
class Hata
{
	/**
	 * İstisna yakalama sınıfı. Buradaki metodu Mgk.php dosyasında
	 * set_exception_handler('\Cekirdek\Hata::istisnaYakala');
	 * satırında, istisnaları kontrol etmek için kullanıyoruz
	 * @param string [$e] Hata detayları
	 */
	public static function istisnaYakala(\Exception $e)
	{
		header('HTTP/1.1 500 Internal Server Error');
		Gorunum::yorumla('500.php', ['e' => $e]);
		exit;
	}

	/**
	 * 404 Sayfa bulunamadı metodu
	 * Bu metodu istediğimiz yerde kullanabiliyoruz
	 * \Cekirdek\Hata::sayfaBulunamadi() şeklinde bir kullanımda
	 * Sayfa bulunamadı hatası verecektir. Kullanmadan evvel herhangi bir
	 * sayfa içeriği tanımlanmamış (header tanımlanmamış) olması gerekiyor
	 */
	public static function sayfaBulunamadi()
	{
		header('HTTP/1.0 404 Not Found');
		Gorunum::yorumla('404.php');
		exit;
	}
}
