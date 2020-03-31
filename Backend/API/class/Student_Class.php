<?php
/**
 * @package class
 *
 * @author Andrea Petrucci
 *   
 */
 
include("DBConnection.php");
class Student_Class 
{
    protected $db;
	public $_id;
	public $_id_student;
    public $_id_class;
 
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    //insert
    public function insert() {
		try {
    		$sql = 'INSERT INTO student_class (id_student, id_class)  VALUES (:id_student, :id_class)';
			$stmt = $this->db->prepare($sql);
			$data = [
			    'id_student' => $this->_id_student,
			    'id_class' => $this->_id_class,
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
    		$sql = "SELECT * FROM student_class";
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
    		$sql = "SELECT * FROM student_class WHERE id=:id";
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
		try{
    		$sql = "DELETE FROM student_class WHERE id = :id);";
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

			$sql = "UPDATE student_class SET id_student = :id_student, id_class = :id_class WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			$data = [
				'id' => $this->_id,
				'id_student' => $this->_id_student,
				'id_class' => $this->_id_class
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
			if(!is_null($this->_id_student))
				$campi .= "id_student = :id_student,";

			if(!is_null($this->_id_class))
				$campi .= "id_class = :id_class,";

			$campi = rtrim($campi,",");

			$sql = "UPDATE class SET ".$campi." WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			
			$data = [
				'id' => $this->_id,
			];
			if(!is_null($this->_id_student))
				$data['id_student'] = $this->_id_student;

			if(!is_null($this->_id_class))
				$data['id_class'] = $this->_id_class;
				
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