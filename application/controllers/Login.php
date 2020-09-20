<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	Function : This function load admin login page 
	Date : 19-09-2020
	*/
	
	public function index()
	{ 

		$this->load->view('start/login');
	}

	/*Author : Snehal Hude
	Function : This function to perform  admin login functionality 
	Date : 16-09-2020
	*/

	public function login_action()
	{
		/*Data that we receive from ajax*/
		$email 		= 	$this->input->post('email');
        $password 	= 	$this->input->post('password');

        if (!isset($email) || $email == '' || $email == 'undefined') {
            /*If Username that we recieved is invalid, go here, and return 2 as output*/
            echo 2; exit();
        }
        if (!isset($password) || $password == '' || $password == 'undefined') {
            /*If Password that we recieved is invalid, go here, and return 3 as output*/
            echo 3; exit();
        }
        //CALL THE VALIDATION RULES
		$rules = $this->_rules_login();

		if ($this->form_validation->run() == FALSE)
		{  
			/*If Both Username &  Password that we recieved is invalid, go here, and return 4 as output*/
            echo 4;exit();
		}
		else
		{  
			$con = "email = '".$email."' and password = '".md5($password)."' ";

			$chk_user = $this->Common_model->getData("users"," ",$con);

			if(!empty($chk_user)){

				
				if($chk_user[0]->is_verified == 0 || $chk_user[0]->status == 0){

 					/*If user is not verified and status is inactive , go here, and return 6 as output*/

					echo 6; exit();

				}else{

					/*If everything is fine, then go here, and return 1 as output and set session*/

					$sessionData = array( 
						'id'  		=> 	$chk_user[0]->id, 
						'name'  	=> 	$chk_user[0]->name,
						'email'     => 	$chk_user[0]->email, 
						'phone'     => 	$chk_user[0]->phone, 
						'user_type' => 	$chk_user[0]->user_type, 
						'logged_in' => TRUE
					 );  

					$this->session->set_userdata($sessionData);
					echo 1; exit();
				}



			}else{
				 /*If Both Username &  Password that we recieved is invalid, go here, and return 5 as output*/
                echo 5; exit();
			}
			

		}
		
	}

	public function login_action___()
	{	
		//CALL THE VALIDATION RULES
		$rules = $this->_rules_login();

		if ($this->form_validation->run() == FALSE)
		{  
			$this->load->view('start/login');
		}
		else
		{  
			$con = "email = '".$this->input->post('email')."' and password = '".md5($this->input->post('password'))."' ";

			$chk_user = $this->Common_model->getData("users"," ",$con);

		 if(!empty($chk_user)) {

			if($chk_user[0]->is_verified == 0 || $chk_user[0]->status == 0){

				$this->session->set_flashdata('error_msg', '<div class="error">Your account is Inactive. Please contact admin. </div>');

				redirect('login');

			}else{

				$sessionData = array( 
					'id'  		=> 	$chk_user[0]->id, 
					'name'  	=> 	$chk_user[0]->name,
					'email'     => 	$chk_user[0]->email, 
					'phone'     => 	$chk_user[0]->phone, 
					'user_type' => 	$chk_user[0]->user_type, 
					'logged_in' => TRUE
				 );  

				 $this->session->set_userdata($sessionData);
				 redirect('dashboard');
			}

		}else{

			$this->session->set_flashdata('error_msg', '<div class="error">Invalid login credentials..!!</div>');
			redirect('login');
		}

			
	    }
	}

	/*Author : Snehal Hude
	Function : This function to load  forgot password page
	Date : 16-09-2020
	*/

	public function fogot_password()
	{ 
		
		$this->load->view('start/fogot_password');
	}

	/*Author : Snehal Hude
	Function : This function to perform forgot password functionality and send reset password url to the registered email address
	Date : 16-09-2020
	*/
	public function forgot_password_action()
	{
		//CALL THE VALIDATION RULES
		$rules = $this->_rules_forgot_password();

		if ($this->form_validation->run() == FALSE)
		{  
			$this->load->view('start/fogot_password');
		}
		else
		{ 
			$chk_email = $this->Common_model->getData('users','',"email = '".$this->input->post('email')."'");


			if(!empty($chk_email)){

				if($chk_email[0]->is_verified != 1 || $chk_email[0]->status != 1){

					$this->session->set_flashdata('error_msg', '<div class="error">Your account is Inactive. Please contact admin. </div>');

					redirect('forgot-password');

				}

				$remember_token = sha1(rand(0000,1111));
				$data['remember_token'] = $remember_token;
				$this->Common_model->save("users","id='".$chk_email[0]->id."'",$data);

				$reset_password_url = site_url().'reset-password/'.$remember_token;

				if(!empty($chk_email[0]->name)){

					$name = $chk_email[0]->name;
				} else {
					$name = $chk_email[0]->email;
				}
				
				//SEND MAIL USING mail() function
				 $to = $chk_email[0]->email;

		         $subject = "Laa - Reset Password URL";
		         
		         $message = "<p>Hello ".$name.",</p>";
		         $message .= "<p>To reset your password <br/> <a href=".$reset_password_url." target='_blank'><b>Click Here!</b></a></p>";

		         $header = "From:info@myoffice.com \r\n";
		         $header .= "Cc:admin@myoffice.com \r\n";
		         $header .= "MIME-Version: 1.0\r\n";
		         $header .= "Content-type: text/html\r\n";
		         
		         $retval = mail ($to,$subject,$message,$header);
		         
		         if( $retval == true ) {
		         	$this->session->set_flashdata('success_msg', '<div class="success">Password reset URL has been sent to your registred email address !</div>');
		         	redirect('login');
		           
		         }else {

		         	$this->session->set_flashdata('error_msg', '<div class="error">Mail could not be sent...</div>');
		         	redirect('login');

		         }


			}else{

				$this->session->set_flashdata('error_msg', '<div class="error">Email you entered is not registred!!</div>');
				redirect('forgot-password');

			}


		}
	}

	/*Author : Snehal Hude
	Function : This function to load reset password page that url is share on users email
	Date : 16-09-2020
	*/

	public function reset_password($token)
	{
		$data = array(

			'token' => $token,
		);
		
		$this->load->view('start/reset_password',$data);
	}

	/*Author : Snehal Hude
	Function : This function to perform reset password functionality
	Date : 16-09-2020
	*/

	public function reset_password_action($token='')
	{
		
		$rules = $this->_rules_reset_password();
		
		if ($this->form_validation->run() == FALSE){  

			$data = array(

			'token' => $token,
			);
		
		$this->load->view('start/reset_password',$data);

		
		}
		else
		{ 
			$get_user_id = $this->Common_model->getData('users','id',"remember_token='".$token."'");

			if($get_user_id){

				$data = array(
				'password' 	 => md5($this->input->post('password')) ,
				'modified' => date('Y-m-d h:i:s'),
				);

				$this->Common_model->save("users","id='".$get_user_id[0]->id."'",$data);

				$this->session->set_flashdata('success_msg', '<div class="success">Password has been reset successfully.</div>');

				redirect('login');

			}
			else{
				$this->session->set_flashdata('error_msg', '<div class="error">Invalid Reset Password..!</div>');

				redirect('login');
			}
			

			
		}
	}


	/*Author : Snehal Hude
	Function : This function to logout the session and unset all the session values
	Date : 16-09-2020
	*/


	public function logout()
	{ 
		 $user_data = $this->session->all_userdata();
		
		foreach ($user_data as $key => $value) {
            if ($key != 'id' && $key != 'name' && $key != 'email' && $key != 'user_type' && $key != 'logged_in' ) {
                $this->session->unset_userdata($key);
            }
        }
   		 $this->session->sess_destroy();
			redirect('login');
	}

	/*Author : Snehal Hude
	Function : This function defines validation rules for login functionality
	Date : 16-09-2020
	*/

	public function _rules_login()
	{
		$this->form_validation->set_rules('email', 'Email','required|valid_email',
        array(
                'required'      => 'Please Enter %s.',
                'valid_email'   => 'Invalid %s.',
        )
		);

	

		$this->form_validation->set_rules('password', 'Password','required',
        array(
                'required'      => 'Please Enter %s.',
            
          )
		);

	
	}

	/*Author : Snehal Hude
	Function : This function defines validation rules for forgot password functionality
	Date : 16-09-2020
	*/

	public function _rules_forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email','required|valid_email',
        array(
                'required'      => 'Please Enter %s.',
                'valid_email'   => 'Invalid %s.',
              
        )
		);

		
	}

	/*Author : Snehal Hude
	Function : This function defines validation rules for reset password functionality
	Date : 16-09-2020
	*/

	public function _rules_reset_password()
	{
		

		$this->form_validation->set_rules('password', 'Password','required|min_length[4]|max_length[12]',
        array(
                'required'      => 'Please Enter %s.',
                'min_length'   	=> '4 to 12 characters are allowed in %s',
                'max_length'   	=> '4 to 12 characters are allowed in %s',
               
        )
		);

		$this->form_validation->set_rules('confirm_password', 'Comfirm Password','required|matches[password]',
        array(
                'required'      => 'Please Enter %s.',
                'matches'   	=> '%s does not match with password',
              
               
        )
		);

	
	}


}
