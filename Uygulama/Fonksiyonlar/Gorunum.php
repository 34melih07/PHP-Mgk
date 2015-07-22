<?php

/**
 * View katmanı fonksiyonları
 * View dosyalarında kullanılmak için fonksiyonlar içerir
 */

 if (!function_exists('url')) {
 	/**
    * URL döndürür
    * @return string URL
    */
   function url()
   {
     return ANA_URL.implode('/', func_get_args());
   }
 }

 if (!function_exists('gorunum')) {
 	/**
    * View katmanı dosyası yolu döndürür
    * @return string
    */
   function gorunum($dosya)
   {
     return UYG_DIZINI.DA.'Gorunumler'.DS.$dosya;
   }
 }
