<?php

namespace Cekirdek;

class Model extends \Paketler\Database
{
  public function __construct()
  {
    if (empty($this->tablo)) {
      throw new \Exception('Model dosyasında tablo adı belirtilmemiş');
    }

		try {
			$pdo = new \PDO(VT_DSN, VT_KULLANICI, VT_SIFRE, [
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET utf8'
      ]);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
			return parent::__construct($pdo);
    } catch (\PDOException $e) {
      throw new \Exception('Veritabanı bağlantı hatası: ' . $e->getMessage());
    }
  }

  public function tekliSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchRow($sorgu, $parametreler);
  }

  public function cokluSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchAll($sorgu, $parametreler);
  }

  public function toplamSatirSorgu($sorgu, $parametreler = [])
  {
    return parent::fetchCount($sorgu, $parametreler);
  }

  public function satiriGetir($kosullar = null, $parametreler = [])
  {
    return parent::getRow($this->tablo, $kosullar, $parametreler);
  }

  public function hepsiniGetir($kosullar = null, $parametreler = [])
  {
    return parent::getAll($this->tablo, $kosullar, $parametreler);
  }

  public function idGetir($id)
  {
    return parent::getId($this->tablo, $id);
  }

  public function toplamSatiriGetir($kosullar = null, $parametreler = [])
  {
    return parent::getCount($this->tablo, $kosullar, $parametreler);
  }

  public function ekle(array $veri)
  {
    return parent::insert($this->tablo, $veri);
  }

  public function guncelle(array $veri, $kosullar = null, $parametreler = [])
  {
    return parent::update($this->tablo, $veri, $kosullar, $parametreler);
  }

  public function sil($kosullar = null, $parametreler = [])
  {
    return parent::delete($this->tablo, $kosullar, $parametreler);
  }

  public function calistir($sorgu)
  {
    return parent::exec($sorgu);
  }
}
