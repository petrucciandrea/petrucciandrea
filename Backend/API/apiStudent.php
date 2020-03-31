<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();
switch($requestMethod) {
    case 'GET':
        $path = explode('/', $_SERVER['REQUEST_URI']);
		if(isset($path[5])) {
			$student->_id = $path[5];
			$data = $student->one();
        } else if(isset($_GET['idClass'])) {
            $idClass = $_GET['idClass'];
			$student->_idClass = $idClass;
			$data = $student->classList();
		} else {
			$data = $student->list();
		}
		if(!empty($data)) {
          $js_encode = json_encode($data, true);
        } else {
          $js_encode = json_encode('There is no record yet.', true);
        }
        header('Content-Type: application/json');
		echo $js_encode;
		break;
    
    case 'POST':
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);

        $name=$input['name'];
		$surname=$input['surname'];
		$sidiCode=$input['sidi_code'];
        $taxCode=$input['tax_code'];

        $student->_name=$name;
		$student->_surname=$surname;
		$student->_sidiCode=$sidiCode;
        $student->_taxCode=$taxCode;
        
        $result = $student->insert();
        
        header('Content-Type: text/plain');
        echo $result;
        break;

    case 'DELETE':
        $path = explode('/', $_SERVER['REQUEST_URI']);
		$id = $path[5];
		$student->_id = $id;
        $result = $student->delete();
		
        header('Content-Type: text/plain');
        echo $result;
        break;
    
    case 'PUT':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5])){
            echo "Error";
        }
        else{   
            $id = $path[5];
            $student->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["name"]))
                $student->_name = $input["name"];
            else    
                $student->_name = null;
    
            if(isset($input["surname"]))
                $student->_surname = $input["surname"];
            else    
                $student->_surname = null;

            if(isset($input["sidi_code"]))
                $student->_sidiCode = $input["sidi_code"];
            else    
                $student->_sidiCode = null;
    
            if(isset($input["tax_code"]))
                $student->_taxCode = $input["tax_code"];
            else    
                $student->_taxCode = null;

            echo $student->put();
            header("HTTP/1.1 200 OK");
        }
        break;

    case 'PATCH':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5]))
            echo $path[5];
        else{   
            $id = $path[5];
            $student->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["name"]))
                $student->_name = $input["name"];
            else    
                $student->_name = null;
            if(isset($input["surname"]))
                $student->_surname = $input["surname"];
            else    
                $student->_surname = null;
            if(isset($input["sidi_code"]))
                $student->_sidiCode = $input["sidi_code"];
            else    
                $student->_sidiCode = null;
            if(isset($input["tax_code"]))
                $student->_taxCode = $input["tax_code"];
            else    
                $student->_taxCode = null;
            
            echo $student->patch();
            header("HTTP/1.1 200 OK");
        }
        break;
    
    default:
	    header("HTTP/1.1 405 Method Not Allowed");
	    break;
}
?>	