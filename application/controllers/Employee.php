<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	/*Author : Snehal Hude
	Function : This function load employee list page 
	Date : 12-09-2020
	*/
	
	public function index()
	{   
		//UNSET SESSION IF DEFINED
		
		if(isset($_SESSION['edit'])){
		$this->session->unset_userdata('edit');

		}
		
		$getEmployees 		= 	$this->Common_model->getData('employees','','','id desc');
	
		$data 				= 	array(
		
			'title'	  		=> "Employees List",
			'add_btn' 		=> "Add New Employee",
			'add_url' 		=> 	site_url('add-employee'),
			'export_btn' 	=> "Export To Excel",
			'export_url' 	=> 	site_url('export-to-excel'),
			'getEmployees' 	=>	$getEmployees,
			
		);

		$this->load->view('employee/list',$data);
	}

	/*Author : Snehal Hude
	Function : This function load employee view page 
	Date : 12-09-2020
	*/
	public function view($id='')
	{
		$row 			= 	$this->Common_model->getData('employees',"",'id="'.$id.'"');

		
		$data 			= array(
		
			'title'	  		=> 	"View Employee",
			'back_url' 		=> 	site_url('employee-list'),
			'back_title' 	=> 	"Employees List",
			'id' 			=>	$row[0]->id,
			'emp_id' 	    =>	$row[0]->emp_id,
			'name' 			=>	$row[0]->name,
			'email' 		=>	$row[0]->email,
			'phone' 		=>	$row[0]->phone,
			'status' 		=>	$row[0]->status,
		); 

		$this->load->view('employee/view',$data);
	} 

	/*Author : Snehal Hude
	Function : This function load  ad employee form page 
	Date : 19-09-2020
	*/
	public function add()
	{  
		
		$this->load->view('employee/form');
	}

	/*Author : Snehal Hude
	Function : This function perform  add employee to the database and checks validtions
	Date : 12-09-2020
	*/

	public function add_action()
	{
		
		/*Data that we receive from ajax*/
		$name 		= 	$this->input->post('name');
		$email 		= 	$this->input->post('email');
        $phone 		= 	$this->input->post('phone');

        if (!isset($name) || $name == '' || $name == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            $returnData['result'] = 2 ;
            $returnData['message'] = "Please Enter Name";
            echo json_encode($returnData);exit();
        }
        if (!isset($email) || $email == '' || $email == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            $returnData['result'] = 3 ;
            $returnData['message'] = "Please Enter Email";
            echo json_encode($returnData);exit();
        }
        if (!isset($phone) || $phone == '' || $phone == 'undefined') {
            /*If Password that we recieved is invalid, go here, and return 3 as output*/
            $returnData['result'] = 4 ;
            $returnData['message'] = "Please Enter Phone No.";
            echo json_encode($returnData);exit();
        }
        //CALL THE VALIDATION RULES
		$rules = $this->_rules();

		if ($this->form_validation->run() == FALSE)
		{  
			/*If there is any form validation error, go here, and return 5 and validations errors as output */
            $returnData['result'] = 5 ;
            $returnData['message'] = validation_errors();
            echo json_encode($returnData);exit();
		}
		else
		{  
			$data = array(
	    	'name' 		=> $name,
	    	'email' 	=> $email,
	    	'phone' 	=> $phone,
	    	'created' 	=> date('Y-m-d h:i:s'),
	    	 );

		    $this->Common_model->save("employees",'',$data);

		    $emp_id = $this->db->insert_id();

		    //GENERATE UNIQUE EMPLOYEE ID
		    $employee_id = "mo_10".$emp_id;

		    $data['emp_id'] = $employee_id ;

		    //SAVE EMPLOYEE ID
		    $this->Common_model->save("employees",'id="'.$emp_id.'"',$data);

		    $this->session->set_flashdata('success_msg', '<div class="success remove">Employee has been created successfully.</div>');

		    $returnData['result'] 	= 1 ;
	        $returnData['message'] = "Employee has been created successfully.";
	        echo json_encode($returnData);exit();

		}
	}


	/*Author : Snehal Hude
	Function : This function perform  loads employee edit page with data 
	Date : 19-09-2020
	*/

	public function edit($id)
	{	
		$row 		  = 	$this->Common_model->getData('employees','',"id='".$id."'");
	
		
		$data 		  = 	array(
			'title'	  		=> "Edit Employee",
			'button'		=> "Edit",
			'back_url' 		=> site_url('employee-list'),
			'back_title' 	=> "Employees List",
			'action_url' 	=> site_url('Employee/edit_action'),
			'id' 			=> set_value('id',$row['0']->id),
			'emp_id' 	    => set_value('id',$row['0']->emp_id),
			'name' 			=> set_value('name',$row['0']->name),
			'email' 		=> set_value('price',$row['0']->email),
			'phone' 		=> set_value('quantity',$row['0']->phone),

		);

		$this->load->view('employee/edit_form',$data);
		
	}

	/*Author : Snehal Hude
	Function : This function perform  edit employee  and checks validations
	Date : 12-09-2020
	*/

	public function edit_action()
	{
		/*Data that we receive from ajax*/
		$id 		= 	$this->input->post('id');
		$name 		= 	$this->input->post('name');
		$email 		= 	$this->input->post('email');
        $phone 		= 	$this->input->post('phone');



        if (!isset($name) || $name == '' || $name == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            $returnData['result'] = 2 ;
            $returnData['message'] = "Please Enter Name";
            echo json_encode($returnData);exit();
        }
        if (!isset($email) || $email == '' || $email == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            $returnData['result'] = 3 ;
            $returnData['message'] = "Please Enter Email";
            echo json_encode($returnData);exit();
        }
        if (!isset($phone) || $phone == '' || $phone == 'undefined') {
            /*If Password that we recieved is invalid, go here, and return 3 as output*/
            $returnData['result'] = 4 ;
            $returnData['message'] = "Please Enter Phone No.";
            echo json_encode($returnData);exit();
        }
        //CALL THE VALIDATION RULES
		$rules = $this->_rules();

		if ($this->form_validation->run() == FALSE)
		{  
			/*If there is any form validation error, go here, and return 5 and validations errors as output */
            $returnData['result'] = 5 ;
            $returnData['message'] = validation_errors();
            echo json_encode($returnData);exit();
		}
		else
		{ 
			$data = array(
	    	'name' 		=> $name,
	    	'email' 	=> $email,
	    	'phone' 	=> $phone,
	    	'modified' 	=> date('Y-m-d h:i:s'),
	    	 );

		    $this->Common_model->save("employees",'id="'.$id.'"',$data);
		    $this->session->set_flashdata('success_msg', '<div class="success remove">Employee has been edited successfully.</div>');


		    $returnData['result'] 	= 1 ;
	        $returnData['message'] = "Employee has been edited successfully.";
	        echo json_encode($returnData);exit();

		}

	}

	
	/*Author : Snehal Hude
	Function : This function perform to change status of employee by using ajax
	Date : 19-09-2020
	*/
	public function change_status()
	{
		$id 	= $this->input->post('id');
		$status = $this->input->post('status');
		if($status == '1'){
			$data = array('status'=> '0');
		}else{
			$data = array('status'=> '1');
		}
        $this->Common_model->save("employees",'id="'.$id.'"',$data);
		
		
		if($status == '1'){
			$btn = '<button class="btn btn-xs btn-danger" onclick="return change_status('.$id.',0)">Inactive</button>';
		}else{
			$btn = '<button   class="btn btn-xs btn-success" onclick="return change_status('.$id.',1)">Active</button>';
		}

		$data['btn'] 		= $btn;
		$data['result'] 	= 1;
		$data['message'] 	= '<div class="success">Employee status has been changed successfully.</div>';
		
		echo json_encode($data);exit();
	}



	/*Author : Snehal Hude
	Function : This function to export employees details to excel sheet
	Date : 12-09-2020
	*/

	public function export()
	{		
			//assign filename
			$filename = 'employees_'.date('Y-m-d-h-i-s').'.csv'; 

			//get all employee data
			$employees_data = $this->Common_model->getData('employees','','','name asc');
			
			//Store in array format
			$data = [];
			foreach ($employees_data as $row) {
				
				if($row->status == 0) { $status = 'Inactive'; }else{ $status = 'Active'; }

		   		 $data[] = array(
		   		 	'name'			=> 	ucwords($row->name),
		   		 	'email'			=> 	$row->name, 
		   		 	'phone'			=>  $row->phone, 
		   		 	'status'		=>	$status
		   		 );
			}

			//define headers of file
            header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=$filename");
            header("Pragma: no-cache");
            header("Expires: 0");

			$header = array("Name","Email","Phone No","Status"); 
            $file = fopen('php://output', 'w');
			fputcsv($file, $header);
            foreach ($data as $data) {
                fputcsv($file, $data);
            }
                fclose($file);
            exit;
        
	
		
	}


	/*Author : Snehal Hude
	Function : This function set validations for add and edit employees
	Date : 12-09-2020
	*/

   public function _rules()
   {

   	  $this->form_validation->set_rules(
	        'name', 'Name', 'required|regex_match[/^[a-zA-Z ]{2,30}$/]',
	        array(
	                'required'      => '%s Required.',
	                'regex_match'      => 'Invalid %s.',
	               
	        )
			);



   	   if($this->input->post('button') == 'Add'){

   	   	 $this->form_validation->set_rules( 'email', 'Email','required|valid_email|is_unique[employees.email]',
	        array(
	                'required'      =>  '%s Required',
	                'valid_email'   => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			); 

   	   }
   	   else{
   	   	$check_email = $this->Common_model->getData('employees','id,email','email="'.$this->input->post('email').'" and id != "'.$this->input->post('id').'"');

   	   
   	   	if(!empty($check_email)){
   	   		
   	   			$is_unique ='|is_unique[employees.email]';
   	   		}else{
   	   			$is_unique = '';
   	   		}

   	   		
   	   		 $this->form_validation->set_rules( 'email', 'Email','required|valid_email'.$is_unique,
	        array(
	                'required'      =>  '%s Required',
	                'valid_email'   => 'Invalid %s.',
	                'is_unique'     => '%s you entered is already exists.'
	        )
			); 

   	   	}

   	   		
		 $this->form_validation->set_rules( 'phone', 'Phone No','required|numeric|is_unique[employees.email]',
	        array(
	                'required'      => '%s Required',
	                'numeric'       => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			);

		
		
	 
   }


}
