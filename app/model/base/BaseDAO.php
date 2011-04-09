<?php
/**
 * Thin PHP Framework (TPF) 2011 http://thinphp.com
 *
 * Licensed under TPF License at http://bit.ly/TPFLicense
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011, Thin PHP Framework Team
 * @link          http://thinphp.com
 * @package       app.model.base
 * @license       TPF License http://bit.ly/TPFLicense
 */
defined('BASE') or exit('Direct script access is not allowed!');
require_once BASE.'/app/model/base/IBaseDAO.php';
require_once BASE.'/app/model/base/DBFactory.php';

/** 
 * This Base DAO class. Model DAO classes must extend this class.
 */

class BaseDAO implements IBaseDao
{
	protected $dbh;
	protected $table;
	
	/**
	 * Constructor to create a DAO for a specific table
	 * @param table Name of the table
	 */
	public function __construct($table)
	{
		$this->table = $table;
		$this->dbh = DBFactory::getDBHandler();				
	}
	
	public function execute($sql, $paramArr)
	{		
		if ($this->dbh == null) return;
		$stmt = $this->dbh->prepare($sql);
		if ($stmt != null) $stmt->execute($paramArr);
	}
	
	public function getAll()
	{
		if ($this->dbh == null) return;
		$sql = 'SELECT * FROM '.$this->table;
		$res = $this->dbh->query($sql);
		return $res->fetchAll();
	}
	
	public function countAll()
	{
		if ($this->dbh == null) return;
		$sql = 'SELECT COUNT(*) FROM '.$this->table;
		$res = $this->dbh->query($sql);
		return $res->fetchColumn();
	}

	public function getById($id)
	{		
		if ($this->dbh == null) return;
		$sql = 'SELECT * FROM '.$this->table.' WHERE '.$this->table.'Id = :id';
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		return $q->fetchAll();
	}
			
	public function removeById($id)
	{
		$sql = 'DELETE FROM '.$this->table.' WHERE '.$this->table.'Id = :id';
		$stmt = $this->dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
	}
	
	public function remove($obj)
	{
		// will be implemented by extending classes
		return;
	}
	
	public function create($obj)
	{
		// will be implemented by extending classes
		return;
	}
	
	public function update($obj)
	{
		// will be implemented by extending classes
		return;
	}
}
?>