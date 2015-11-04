<?php
include_once 'config.php';
/**
 * Database Helper Function templates
 */
/*
select(table name, where clause as associative array)
insert(table name, data as associative array, mandatory column names as array)
update(table name, column names as associative array, where clause as associative array, required columns as array)
delete(table name, where clause as array)
*/


// Users
	$app->get('/users', function() { 
	    global $db;
	    $error['status'] =	'error';
	    $error['message'] =	'No users found !!!';	
	    $users = $db->users();
	    if($users){
		$error['status'] = 'success';
		$error['message'] = 'Users loaded from database !!';
		foreach( $users as $p_id => $product ){
			$error['data'][] = $product;
		}
	   }	    		
	  echo json_encode($error);
	  exit;
	});

	$app->post('/users', function() use ($app) { 
            global $db;
	    $data = json_decode($app->request->getBody());
            $data = (array) $data;	    
            $error['status'] = 'error';
            $error['message'] = 'User cannot be added !!!';
	    $rows = $db->users->insert($data);
	    if($rows){
                $error['status'] = 'success';
		$error["message"] = "User added successfully.";
                $error['data'] = $rows['id'];
            }    
	    
            echo json_encode($error);
            exit;
	});

	$app->put('/users/:id', function($id) use ($app) { 
            global $db;        
	    $data = json_decode($app->request->getBody(),true);            
            //$data = sort($data);
            //$obj[]  = (array)$data;
            $data = toArray($data);
            //$data['is_arr'] = 1;
	    //print_r($data); 
	    $error['status'] = 'error' ;
	    $error['message'] = 'User cannot be updated!!!';		   
	    $product = $db->users[$id];	   
	   
	    if($product){
                if($db->users()->where('id = ?', $id)->update($data)){ 
                  $error['status'] = 'success';
		  $error["message"] = "User information updated successfully.";   
                }                
           }
	    echo json_encode($error);
	    exit;	
	});
        
        $app->post('/users/update/:id', function($id) use ($app) { 
            //$data = array();   
            global $db;
	    $data = json_decode($app->request->getBody(),true);            
            //$data = sort($data);
            //$obj[]  = (array)$data;
            $data = toArray($data);
            //$data['is_arr'] = 1;	    
	    $error['status'] = 'error' ;
	    $error['message'] = 'User cannot be updated!!!';		   
	    
	    $product = $db->users()[$id];	            	    
	    if($product){                          
                if($db->users()->where('id = ?', $id)->update($data)){                                
                 $error['status'] = 'success';
		 $error["message"] = "User information updated successfully.";   
                }                
           }
	    echo json_encode($error);
	    exit;	
	});

	$app->delete('/users/:id', function($id) { 
	    global $db;
	    $product = $db->users[$id];	
	   $error['status'] = 'error';
	    if($product && $product->delete() ){
		$error['status'] = 'success';
		$error["message"] = "User removed successfully.";
	    }else{
		 $error["message"] = "User cannot be deleted.";
	   }
	    echo json_encode( $error );
	    exit;
	});	
        
        function toArray($obj){
            if (is_object($obj)) $obj = (array)$obj;
            if (is_array($obj)) {
                $new = array();
                foreach ($obj as $key => $val) {
                    $new[$key] = toArray($val);
                }
            } else {
                $new = $obj;
            }
            return $new;
        }

	$app->run();
?>
