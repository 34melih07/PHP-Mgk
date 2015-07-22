<?php

namespace Cekirdek;

/**
 * Model sınıfı
 * Paketlerdeki Database sınıfı ile beraber çalışır
 */
class Model extends \Paketler\Database
{
  /**
   * Otomatik başlatıcı metod
   * PDO bağlatısı yapar
   */
  public function __construct()
  {
    /**
     * Eğer tablo adı tanımlı değilse, istisna döndürür
     * İstenilirse, bu kısım kaldırılabilir
     */
    if (empty($this->tablo)) {
      throw new \Exception('Model dosyasında tablo adı belirtilmemiş');
    }

		try {
			$pdo = new \PDO(VT_DSN, VT_KULLANICI, VT_SIFRE, [

        // Türkçe karakter sorununa çözüm için
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8'
      ]);

      // Sorgulardan hata alabilmek için hata modunu ayarlıyoruz
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

      // PDO'dan dönen değerli obje olarak döndürüyoruz
      // yani $post['title'] değilde $post->title şeklinde
      // istendiği taktirde değiştirilebilir
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

      // Üst sınıfa $pdo bağlantısını göndererek çalıştırıyoruz
			return parent::__construct($pdo);

    } catch (\PDOException $e) {
      throw new \Exception('Veritabanı bağlantı hatası: ' . $e->getMessage());
    }
  }

  /**
   * Tekil sorgular için kullanılır
   * @example $model->tekilSorgu('SELECT * FROM a WHERE id=?', [$id]);
   */
  public function tekilSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchRow($sorgu, $parametreler);
  }

  /**
   * Çoklu sorgular için kullanılır
   * @example $model->cogulSorgu('SELECT * FROM a WHERE id=?', [$id]);
   */
  public function cogulSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchAll($sorgu, $parametreler);
  }

  /**
   * Sorgu çalıştırır
   */
  public function calistir($sorgu)
  {
    return parent::exec($sorgu);
  }

  /**
   * Toplam satır sayısını almak için kullanılır
   * @example $model->toplamSatirSorgu('SELECT * FROM post');
   */
  public function toplamSatirSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchCount($sorgu, $parametreler);
  }

  /**
   * Özel tekil sorgu
   * @example $model->satiriGetir('WHERE id=?', [$id]);
   */
  public function satiriGetir($kosullar = null, $parametreler = [])
  {
    return parent::getRow($this->tablo, $kosullar, $parametreler);
  }

  /**
   * Özel çoğul sorgu
   * @example $model->hepsiniGetir()
   */
  public function hepsiniGetir($kosullar = null, $parametreler = [])
  {
    return parent::getAll($this->tablo, $kosullar, $parametreler);
  }

  /**
   * Özel tekil metodu
   * @example $model->idGetir($id);
   */
  public function idGetir($id)
  {
    return parent::getId($this->tablo, $id);
  }

  /**
   * Satır sayısı döndürür
   * @example $model->toplamSatiriGetir()
   */
  public function toplamSatiriGetir($kosullar = null, $parametreler = [])
  {
    return parent::getCount($this->tablo, $kosullar, $parametreler);
  }

  /**
   * Satır ekler
   * @example $model->ekle(['baslik' => 'Gönderi başlığı', 'tarih' => '05.12.2015'])
   */
  public function ekle(array $veri)
  {
    return parent::insert($this->tablo, $veri);
  }

  /**
   * Satır günceller
   * @example $model->guncelle(['baslik' => 'Yeni Başlık'], 'WHERE id=?', [$id])
   */
  public function guncelle(array $veri, $kosullar = null, $parametreler = [])
  {
    return parent::update($this->tablo, $veri, $kosullar, $parametreler);
  }

  /**
   * Satır siler
   * @example $model->sil('WHERE id=?', [$id])
   */
  public function sil($kosullar = null, $parametreler = [])
  {
    return parent::delete($this->tablo, $kosullar, $parametreler);
  }
}
