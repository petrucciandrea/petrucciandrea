<?php
/**
 * @package class
 *
 * @author Andrea Petrucci
 *   
 */
 
include("DBConnection.php");
class Student 
{
    protected $db;
	public $_id;
	public $_idClass;
    public $_name;
    public $_surname;
    public $_sidiCode;
    public $_taxCode;
 
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    //insert
    public function insert() {
		try {
    		$sql = 'INSERT INTO student (name, surname, sidi_Code, tax_Code)  VALUES (:name, :surname, :sidiCode, :taxCode)';
			$stmt = $this->db->prepare($sql);
			$data = [
			    'name' => $this->_name,
			    'surname' => $this->_surname,
			    'sidiCode' => $this->_sidiCode,
			    'taxCode' => $this->_taxCode,
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
    		$sql = 'SELECT * FROM student';
		    $stmt = $this->db->prepare($sql);
 
		    $stmt->execute();
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
	}
	
	//get the  list of the student in the class
	public function classList(){
		try {
    		$sql = 'SELECT s.* FROM student s inner join student_class sc on s.id=sc.id_student WHERE sc.id_class=:idClass';
		    $stmt = $this->db->prepare($sql);
		    $data = [
		    	'idClass' => $this->_idClass
			];
		    $stmt->execute($data);
		    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $e) {
		    die("Oh noes! There's an error in the query!");
		}
	}

    // getOne
    public function one() {
    	try {
    		$sql = "SELECT * FROM student WHERE id=:id";
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
			$sql = "DELETE FROM student_class WHERE id_student = :id;";
		    $stmt = $this->db->prepare($sql);
			$data=[ 
				'id'=>$this->_id
			];
			$stmt->execute($data);
		} catch (Exception $e) {
		    die("1  Oh noes! There's an error in the query!");
		}
		try{
    		$sql = "DELETE FROM student WHERE id = :id;";
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
			$sql = "UPDATE student SET name = :name, surname = :surname, sidi_code = :sidiCode, tax_code = :taxCode WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			$data = [
				'id' => $this->_id,
			    'name' => $this->_name,
			    'surname' => $this->_surname,
			    'sidiCode' => $this->_sidiCode,
			    'taxCode' => $this->_taxCode,
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
			if(!is_null($this->_name))
				$campi .= "name = :name,";

			if(!is_null($this->_surname))
				$campi .= "surname = :surname,";

			if(!is_null($this->_sidiCode))
				$campi .= "sidi_code = :sidiCode,";

			if(!is_null($this->_taxCode))
				$campi .= "tax_code = :taxCode,";

			$campi = rtrim($campi,",");

			$sql = "UPDATE student SET ".$campi." WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			
			$data['id']= $this->_id;
			 
			if(!is_null($this->_name))
				$data['name'] = $this->_name;

			if(!is_null($this->_surname))
				$data['surname'] = $this->_surname;

			if(!is_null($this->_sidiCode))
				$data['sidiCode'] = $this->_sidiCode;

			if(!is_null($this->_taxCode))
				$data['taxCode'] = $this->_taxCode;

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