<?php
include '../lib/config.php';
include '../lib/function.php';
include '../models/building_model.php';
$page = null;
$page = (isset($_GET['page'])) ? $_GET['page'] : "list";
$title = ucwords("Ruang");

$_SESSION['menu_active'] = 1;

switch ($page) {
	case 'list':
		get_header($title);
		
		$query = select();
		$add_button = "building.php?page=form";

		include '../views/building/list.php';
		get_footer();
	break;
	
	case 'form':
		get_header();

		$close_button = "building.php?page=list";

		$query_branch = select_branch();
		
		$id = (isset($_GET['id'])) ? $_GET['id'] : null;
		if($id){

			$row = read_id($id);
		
			$action = "building.php?page=edit&id=$id";
		} else{
			
			//inisialisasi
			$row = new stdClass();
	
			$row->building_name = false;
			$row->building_img = false;
			$row->branch_id = false;
			
			$action = "building.php?page=save";
		}

		include '../views/building/form.php';
		get_footer();
	break;

	case 'save':
	
		extract($_POST);

		$i_name = get_isset($i_name);
		$i_branch_id = get_isset($i_branch_id);
		
		$path = "../img/building/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? $_FILES['i_img']['name'] : "";
		$i_img = str_replace(" ","",$i_img);
		
		$date = ($_FILES['i_img']['name']) ? time()."_" : "";
		
		$data = "'',
					
					'$i_name',
					'".$date.$i_img."',
					'$i_branch_id'
					
			";
			
			//echo $data;

			create($data);
			if($i_img){
				move_uploaded_file($i_img_tmp, $path.$date.$i_img);
			}
			
			header("Location: building.php?page=list&did=1");
		
		
	break;

	case 'edit':

		extract($_POST);

		$id = get_isset($_GET['id']);
		$i_name = get_isset($i_name);
		$i_branch_id = get_isset($i_branch_id);
		
		$path = "../img/building/";
		$i_img_tmp = $_FILES['i_img']['tmp_name'];
		$i_img = ($_FILES['i_img']['name']) ? $_FILES['i_img']['name'] : "";
		$i_img = str_replace(" ","",$i_img);
		
		$date = ($_FILES['i_img']['name']) ? time()."_" : "";
		
				if($i_img){
				
			
				if(move_uploaded_file($i_img_tmp, $path.$date.$i_img)){
					$get_img_old = get_img_old($id);
					if(file_exists($path.$get_img_old)){
						unlink($path.$get_img_old);
					}
					
					$data = "building_name = '$i_name',
							
							building_img = '$date$i_img',
							branch_id = '$i_branch_id'

					";
				}
			
			
			}else{
				$data = "building_name = '$i_name',
						branch_id = '$i_branch_id'
					";
			}
			
		update($data, $id);
			
			header('Location: building.php?page=list&did=2');

		

	break;

	case 'delete':

		$id = get_isset($_GET['id']);

		$path = "../img/building/";	
		
		$get_img_old = get_img_old($id);
					if(file_exists($path.$get_img_old)){
						unlink($path.$get_img_old);
					}


		delete($id);

		header('Location: building.php?page=list&did=3');

	break;
}

?>