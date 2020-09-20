<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	Function : This function load dashboad page 
	Date : 12-09-2020
	*/
	public function index()
	{ 
		$getUser 		= 	$this->Common_model->getData("users","","id='".$this->session->userdata('id')."'");
		$data 			= 	array('getUser' =>$getUser );
		$this->load->view('index',$data);
	}

/*Author : Snehal Hude
	Function : This function load update profile page 
	Date : 12-09-2020
	*/
	public function update_profile()
	{
		$id 			= 	$this->session->userdata('id');
		$getUser 		= 	$this->Common_model->getData("users","","id='".$id."'");

		$data 			= 	array(
			'id' 		=>  $getUser[0]->id,
			'name' 		=>  $getUser[0]->name,
			'email' 	=>  $getUser[0]->email,
			'phone' 	=>  $getUser[0]->phone,
			 );
		
		$this->load->view('user/profile',$data);
	}

	/*Author : Snehal Hude
	Function : This function is to perform  update profile action 
	Date : 12-09-2020
	*/
	public function profile_action()
	{
		$rules = $this->_rules();

		if ($this->form_validation->run() == FALSE)
		{  
				$data['edit'] = array (
	            'errors' => validation_errors(),
		        );
		        $this->session->set_userdata($data);
		    
				redirect('update-profile');
		}
		else
		{  

			$data = array(
				'name' 	=> $this->input->post('name') ,
				'email' => $this->input->post('email') ,
				'phone' => $this->input->post('phone') ,
				 );

			 $this->Common_model->save("users",'id="'.$this->input->post('id').'"',$data);

			//UNSET SESSION VARIABLE IF DEFINED
			if(isset($_SESSION['edit']['errors'])){
				$this->session->unset_userdata('edit');

			}
		     $this->session->set_flashdata('success_msg', '<div class="success">Profile has been updated successfully.</div>');

		    redirect('update-profile');


		}
	}

	/*Author : Snehal Hude
	Function : This function is to load  change password page
	Date : 12-09-2020
	*/
	public function change_password()
	{
		$this->load->view('user/change_password');
	}

	/*Author : Snehal Hude
	Function : This function is to perform  change password  action 
	Date : 12-09-2020
	*/

	public function change_password_action()
	{
		
		$rules = $this->_rules_change_password();

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('user/change_password');

		}
		else{

			$check_password  =  $this->Common_model->getData("users","","password='".md5($this->input->post('password'))."' and id = '".$this->session->userdata('id')."'");


			if(!empty($check_password)){

				$data = array(
					'password' => md5($this->input->post('new_password')), 
					'modified' => date('Y-m-d h:i:s'),
				);

				$this->Common_model->save("users",'id="'.$this->session->userdata('id').'"',$data);

				$this->session->set_flashdata('success_msg', '<div class="success">Password has been changed successfully.</div>');

		   		 redirect('change-password');



			}else{

				$this->session->set_flashdata('error_msg', '<div class="error">Incorrect Password Entered.</div>');

		    	redirect('change-password');


			}
		
		}
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

   	   	$check_email = $this->Common_model->getData('users','id,email','email="'.$this->input->post('email').'" and id != "'.$this->input->post('id').'"');



   	   
   	   	if(!empty($check_email)){
   	   		
   	   			$is_unique ='|is_unique[users.email]';
   	   		}else{
   	   			$is_unique = '';
   	   		}
	
   	   		
   	   		$this->form_validation->set_rules( 'email', 'Email','required|valid_email'.$is_unique,
	        array(
	                'required'      =>  '%s Required',
	                'valid_email'   => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			); 

   	   	
		 $this->form_validation->set_rules( 'phone', 'Phone No','required|numeric|is_unique[employees.email]',
	        array(
	                'required'      => '%s Required',
	                'numeric'       => 'Invalid %s.',
	                'is_unique'     => 'This %s already exists.'
	        )
			);

   }

   /*Author : Snehal Hude
	Function : This function is to set change password validatins rules
	Date : 12-09-2020
	*/

   	public function _rules_change_password()
	{
		
		

		$this->form_validation->set_rules('password', 'Password','required',
        array(
                'required'      => 'Please Enter %s.',
        )
		);

		$this->form_validation->set_rules('new_password', 'New Password','required|min_length[4]|max_length[12]',
        array(
                'required'      => 'Please Enter %s.',
                'min_length'   	=> '4 to 12 characters are allowed in %s',
                'max_length'   	=> '4 to 12 characters are allowed in %s',
               
        )
		);

		$this->form_validation->set_rules('confirm_password', 'Comfirm Password','required|matches[new_password]',
        array(
                'required'      => 'Please Enter %s.',
                'matches'   	=> '%s does not match with new password',
              
               
        )
		);

	
	}

}
