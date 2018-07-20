<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Category extends Model {

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");
	}

	public function save()

	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", array(
			":idcategory"=>$this->getidcategory(),
			":descategory"=>$this->getdescategory()
		));
	
		$this->setData($results[0]);

	}

	public function get($idcategory)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory", [
			':idcategory'=>$idcategory
		]);

		if (count($results) === 0)
		{
			throw new \Exception("Categoria inesistente");
		}

		$this->setData($results);

	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory", [
			':idcategory'=>$this->getidcategory()
		]);

	}

}
 ?>
