<?php

namespace Paketler;

/**
 * Veritabanı sınıfı
 * @author Yılmaz Demir
 * @link http://yilmazdemir.com.tr
 * @package Database
 * @version 0.1
 */
class Database
{
  /**
   * PDO sınıfını tutar
   * @var void
   */
  private $pdo;

  /**
   * SQL sorgusunu tutar
   * @var string
   */
  public $query;

  /**
   * Tablo adını tutar
   * @var string
   */
  public $table;

  /**
   * Tablodaki esas anahtarı (Primary Key) tutar
   * @var string
   */
  public $pk = 'id';

  /**
   * Başlatıcı metod
   * @param void [$pdo]
   */
  public function __construct(\PDO $pdo)
  {
		$this->pdo = $pdo;
  }

  /**
   * Tek satır veri döndürür
   * @example $db->fetchRow('SELECT * FROM table WHERE id=?', array($id))
   * @param string [$query]
   * @param array [$parameters]
   * @return array
   */
  public function fetchRow($query, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare($query);
      $this->query->execute($parameters);
      return $this->query->fetch();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Birden fazla satır halinde veri döndürür
   * @example $db->fetchAll('SELECT * FROM table WHERE age=?', array($age))
   * @param string [$query]
   * @param array [$parameters]
   * @return array
   */
  public function fetchAll($query, $parameters = [])
  {

    try {
      $this->query = $this->pdo->prepare($query);
      $this->query->execute($parameters);
      return $this->query->fetchAll();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Satır sayısını döndürür
   * @example $db->fetchCount('SELECT * FROM table WHERE age=?', array($age))
   * @param string [$query]
   * @param array [$parameters]
   * @return integer
   */
  public function fetchCount($query, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare($query);
      $this->query->execute($parameters);
      return $this->query->rowCount();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Tek satır veri döndürür
   * @example $db->getRow('table', 'WHERE id=?', array($id))
   * @param string [$table]
   * @param string [$conditions]
   * @param array [$parameters]
   * @return array
   */
  public function getRow($table, $conditions = null, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
      $this->query->execute($parameters);
      return $this->query->fetch();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Çoklu veri döndürür
   * @example $db->getAll('table', 'WHERE age=?', array($age))
   * @param string [$table]
   * @param string [$conditions]
   * @param array [$parameters]
   * @return array
   */
  public function getAll($table, $conditions = null, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
      $this->query->execute($parameters);
      return $this->query->fetchAll();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * ID'ye göre tek satır veri döndürür
   * @example $db->getId('table', $id)
   * @param string [$table]
   * @param integer [$id]
   * @return array
   */
  public function getId($table, $id)
  {
    try {
      $this->query = $this->pdo->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->pk.' = ?');
      $this->query->execute(array($id));
      return $this->query->fetch();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Satır sayısını döndürür
   * @example $db->getCount('table', 'WHERE age=?', array($age))
   * @param string [$table]
   * @param string [$conditions]
   * @param array [$parameters]
   * @return integer
   */
  public function getCount($table, $conditions = null, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare('SELECT * FROM ' . $table . ' ' . $conditions);
      $this->query->execute($parameters);
      return $this->query->rowCount();
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Tabloya veri ekler
   * @example $db->insert('table', ['title' => 'Başlık'])
   * @param string [$table]
   * @param array [$data]
   * @return integer|boolean
   */
  public function insert($table, $data)
  {
    try {
      $values = array();
  		$columns = array();

  		foreach ($data as $column => $value) {
  			$values[] = $value;
  			$columns[] = $column;
  		}

  		$columns = implode(',', $columns);
  		$marks = trim(substr(str_repeat('?,', count($values)), 0, -1));

  		$this->query = $this->pdo->prepare('INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $marks . ')');

  		if ($this->query->execute($values)) {
  			return $this->pdo->lastInsertId();
  		}
  		return false;
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Tablodaki veriyi günceller
   * @example $db->update('table', ['title' => 'Başlık'], 'WHERE id=?', array($id))
   * @param string [$table]
   * @param array [$data]
   * @param string [$conditions]
   * @param array [$parameters]
   * @return boolean
   */
  public function update($table, $data, $conditions = null, $parameters = [])
  {
    try {
      $values = array();
			$columns = array();
			foreach ($data as $column => $value) {
				$values[] = $value;
				$columns[] = $column;
			}

			$columnsAndMarks = implode('=?,', $columns) . '=?';
			$this->query = $this->pdo->prepare('UPDATE ' . $table . ' SET ' . $columnsAndMarks . ' ' .$conditions);

			return $this->query->execute(array_merge($values, $parameters));
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Tablodaki veriyi siler
   * @example $db->delete('table', 'WHERE id=?', array($id))
   * @param string [$table]
   * @param string [$conditions]
   * @param array [$parameters]
   * @return boolean
   */
  public function delete($table, $conditions = null, $parameters = [])
  {
    try {
      $this->query = $this->pdo->prepare('DELETE FROM ' . $table . ' ' . $conditions);
      return $this->query->execute($parameters);
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }

  /**
   * Bir sorgu çalıştırır
   * @example $db->exec('CREATE TABLE IF NOT EXISTS tablo')
   * @param string [$query]
   * @return boolean
   */
  public function exec($query)
  {
    try {
      return $this->pdo->exec($query);
    } catch (\PDOException $e) {
      throw new \Exception('Sorgu hatası: ' . $e->getMessage());
    }
  }
}
