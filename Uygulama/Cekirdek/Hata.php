<?php

namespace Cekirdek;

class Hata
{
	public static function istisnaYakala(\Exception $e)
	{
		header('HTTP/1.1 500 Internal Server Error');
		Gorunum::yorumla('500.php', ['e' => $e]);
		exit;
	}

	public static function sayfaBulunamadi()
	{
		header('HTTP/1.0 404 Not Found');
		Gorunum::yorumla('404.php');
		exit;
	}
}
