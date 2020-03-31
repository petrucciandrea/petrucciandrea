<?php
$requestMethod = $_SERVER["REQUEST_METHOD"];
include('./class/Class.php');
$classe = new Classes();
switch($requestMethod) {
    case 'GET':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(isset($path[5])){
			$id = $path[5];
			$classe->_id = $id;
			$data = $classe->one();
		} else {
			$data = $classe->list();
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

        $year=$input['year'];
		$section=$input['section'];

        $classe->_year=$year;
		$classe->_section=$section;
        
        header('Content-Type: text/plain');
        echo $classe->insert();
        break;

    case 'DELETE':
		$path = explode('/', $_SERVER['REQUEST_URI']);
        $classe->_id = $path[5];
        
        header('Content-Type: text/plain');
        echo $classe->delete();
        break;
    
    case 'PUT':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5])){
            echo $path[5];
            break;
        }
        else{   
            $id = $path[5];
            $classe->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["year"]))
                $classe->_year = $input["year"];
            else    
                $classe->_year = null;
    
            if(isset($input["section"]))
                $classe->_section = $input["section"];
            else    
                $classe->_section = null;
            echo $classe->put();
            header("HTTP/1.1 200 OK");
        }
        break;

    case 'PATCH':
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if(!isset($path[5]))
            echo $path[5];
        else{   
            $id = $path[5];
            $classe->_id = $id;
    
            $inputJSON = file_get_contents('php://input');
            $input = json_decode($inputJSON, TRUE);
    
            if(isset($input["year"]))
                $classe->_year = $input["year"];
            else    
                $classe->_year = null;
    
            if(isset($input["section"]))
                $classe->_section = $input["section"];
            else    
                $classe->_section = null;
            echo $classe->patch();
            header("HTTP/1.1 200 OK");
        }
        break;
    
    default:
	    header("HTTP/1.1 405 Method Not Allowed");
	    break;
}
?>	