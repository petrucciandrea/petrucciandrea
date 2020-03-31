<?php
/**
 * @package class
 *
 * @author Andrea Petrucci
 *   
 */
 
include("DBConnection.php");
class Classes 
{
    protected $db;
	public $_id;
	public $_year;
    public $_section;
 
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    //insert
    public function insert() {
		try {
    		$sql = 'INSERT INTO class (year, section)  VALUES (:year, :section)';
			$stmt = $this->db->prepare($sql);
			$data = [
			    'year' => $this->_year,
			    'section' => $this->_section,
			];
	    	$stmt->execute($data);
			return "Insert";
		} catch (Exception $e) {
    		die("Oh noes! There's an error in the query! <br>".$e);
		}
    }
   
    // getAll 
    public function list() {
    	try {
    		$sql = "SELECT * FROM class";
		    $stmt = $this->db->prepare($sql);
 
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
	}
	
	
    // getOne
    public function one() {
    	try {
    		$sql = "SELECT * FROM class WHERE id=:id";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
		    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
    }
	
	//delete by id
    public function delete() {
		try {
			$sql = "DELETE FROM student_class WHERE id_class = :id;";
		    $stmt = $this->db->prepare($sql);
			$data=[ 
				'id'=>$this->_id
			];
			$stmt->execute($data);
		} catch (Exception $e) {
		    die("1  Oh noes! There's an error in the query!");
		}
		try{
    		$sql = "DELETE FROM class WHERE id = :id);";
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'id' => $this->_id
			];
		    $stmt->execute($data);
		    return "Deleted";
		} catch (Exception $e) {
		    die("2  Oh noes! There's an error in the query!");
		}
	}
	
	public function put() {
		try {

			$sql = "UPDATE class SET year = :year, section = :section WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			$data = [
				'id' => $this->_id,
				'year' => $this->_year,
				'section' => $this->_section
			];

			$stmt->execute($data);
			return "Modified";
		} catch (Exception $e) {
			header("HTTP/1.1 500 Internal server error");
			die("Oh noes! There's an error in the query!".$e);
		}
	}
	public function patch() {
		try {
			$campi="";
			if(!is_null($this->_year))
				$campi .= "year = :year,";

			if(!is_null($this->_section))
				$campi .= "section = :section,";

			$campi = rtrim($campi,",");

			$sql = "UPDATE class SET ".$campi." WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			
			$data = [
				'id' => $this->_id,
			];
			if(!is_null($this->_year))
				$data['year'] = $this->_year;

			if(!is_null($this->_section))
				$data['section'] = $this->_section;
				
			echo $sql;
			$stmt->execute($data);
			return "Modified";
		} catch (Exception $e) {
			header("HTTP/1.1 500 Internal server error");
			die("Oh noes! There's an error in the query!".$e);
		}
	}
}
?>