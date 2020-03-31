<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('./class/Student_Class.php');
$student_class = new Student_Class();
switch($requestMethod) {
	case 'GET':
		$path = explode('/', $_SERVER['REQUEST_URI']);
		if(isset($path[5])) {
			$student_class->_id = $path[5];
			$data = $student->one();
		} else {
			$data = $student_class->list();
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

        $id_student=$input['id_student'];
		$id_class=$input['id_class'];

        $student_class->_id_student=$id_student;
		$student_class->_id_class=$id_class;
        
        $result = $student_class->insert();
        
        header('Content-Type: text/plain');
        echo $result;
        break;

    case 'DELETE':
        $path = explode('/', $_SERVER['REQUEST_URI']);
		$student_class->_id = $path[5];
        $result = $student_class->delete();
		
        header('Content-Type: text/plain');
        echo $result;
        break;
    
    case 'PUT':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5])){
            echo $path[5];
            break;
        }
        else{   
            $id = $path[5];
            $student_class->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["id_student"]))
                $student_class->_id_student = $input["id_student"];
            else    
                $student_class->_id_student = null;
    
            if(isset($input["id_class"]))
                $student_class->_id_class = $input["id_class"];
            else    
                $student_class->_id_class = null;
            echo $student_class->put();
            header("HTTP/1.1 200 OK");
        }
        break;

    case 'PATCH':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5]))
            echo $path[5];
        else{   
            $id = $path[5];
            $student_class->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["id_student"]))
                $student_class->_id_student = $input["id_student"];
            else    
                $student_class->_id_student = null;
    
            if(isset($input["id_class"]))
                $student_class->_id_class = $input["id_class"];
            else    
                $student_class->_id_class = null;
            echo $student_class->patch();
            header("HTTP/1.1 200 OK");
        }
        break;
    
    default:
	    header("HTTP/1.1 405 Method Not Allowed");
	    break;
}
?>	