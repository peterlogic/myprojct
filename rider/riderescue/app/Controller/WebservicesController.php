<?php
	#Project : E-Mac
	App::uses('AppController', 'Controller');
	class WebservicesController extends AppController 
	{
		public $uses = array('Category','User','Allergen','AllergenUser');
  		public function beforeFilter() 
		{
			parent::beforeFilter();
			$this->Auth->allow(array('signup','login','forgot','admin_reset','changepass','myProfile','profile_edit','categories','allergens','allergens_user','get_product_by_bar_code','get_products_by_ingredients','get_products_by_ingredients_and_category','get_products_by_category'));
		}	
		
		# //http://dev414.trigma.us/E-Mac/Webservices/signup?username=gurudutt1&profile_image=trigma-100x100.png&email=gurudutt.sharma@trigma.in&register_type=facebook&password=123456&contact=1234567890
		public function signup () 
		{
			$data['User']['username']		=	isset ($_REQUEST['username']) ? $_REQUEST['username'] : '';
			$data['User']['profile_image']	=	isset ($_REQUEST['profile_image']) ? $_REQUEST['profile_image'] : '';
			$data['User']['email']				=	isset ($_REQUEST['email']) ? $_REQUEST['email'] : '';
			$data['User']['contact']			=	isset ($_REQUEST['contact']) ? $_REQUEST['contact'] : '';
			$data['User']['register_type']	=	isset ($_REQUEST['register_type']) ? $_REQUEST['register_type'] : '';		
			$data['User']['status'] 				=	1;
			$data['User']['register_date'] 	= 	date ("Y-m-d"); 
			$data['User']['usertype_id']  	=  2;
			
			if ($_REQUEST['register_type']	==	"facebook")  {	
				if (isset($_REQUEST['fb_id']) =='')  {
					$response					= 	array('success'=>0,'message'=>'Facebook id empty, please send fb_id');
					echo json_encode($response);die;
				}
				$data['User']['fb_id']  			=  @$_REQUEST['fb_id'];		
				$getFbIDStatus 					=  $this->User->find('first',array('conditions'=>array('User.fb_id'=>$_REQUEST['fb_id'])));
				if (empty($getFbIDStatus))  {
					$fbexist 						= 	$this->User->find('first',array('conditions'=>array('AND'=>array('User.fb_id'=>$_REQUEST['fb_id']))));
					if (empty($fbexist))  {						
						$this->User->create();               
						if ($this->User->save($data)) {
							$user_id  				= 	$this->User->getLastInsertID();
							$this->User->query ("update users set password= '' where id = '".$user_id."'");
							$response 			= 	array('success'=>1,'message'=>'User Register Successfully with facebook');
							$response['data'] 			= 	array('user_id'=>$user_id);
							echo json_encode($response);die;
						}  else  {
							$response				= 	array('success'=>0,'message'=>'Please try again');
							echo json_encode($response);die;
						}
					}  else  {
						$response					= 	array('success'=>3,'message'=>'Facebook id exist, please try another email');
						echo json_encode($response);die;
					} 			
				}  else  {
					$response 					= 	array('success'=>3,'message'=>'facebook id  already exist, please try another user');
					echo json_encode($response);die;
				}
			}  	elseif($_REQUEST['register_type']	==	"twiter") {
					if (isset($_REQUEST['twiter_id']) =='')  {
						$response					= 	array('success'=>0,'message'=>'Twiter id empty, please send twiter_id');
						echo json_encode($response);die;
					}
					$data['User']['twiter_id']  				=  $_REQUEST['twiter_id'];
					
					$getlnIDStatus 							=  $this->User->find('first',array('conditions'=>array('User.twiter_id'=>$_REQUEST['twiter_id'])));
					if (empty($getlnIDStatus))  {
						$twitexist 								= 	$this->User->find('first',array('conditions'=>array('AND'=>array('User.twiter_id'=>$_REQUEST['twiter_id']))));
						if (empty($twitexist)) 	{
						$this->User->create();               
						if ($this->User->save($data)) {
							$user_id  						= 	$this->User->getLastInsertID();
							$this->User->query("update users set password= '' where id = '".$user_id."'");
							$response 					= 	array('success'=>1,'message'=>'User Register Successfully with twiter');
							$response['data']	= 	array('user_id'=>$user_id);
							echo json_encode($response);die;
							exit;
						} 
						else 
						{
							$response					= 	array('success'=>0,'message'=>'Please try again');
							echo json_encode($response);
							exit;
						}
					}
					else
					{
						$response						= 	array('success'=>3,'message'=>'Email id exist, please try another email');
						echo json_encode($response);
						exit;		    
					} 				
				} 
				else 
				{
						$response 					= 	array('success'=>3,'message'=>'linked in already exist, please try another user');
						echo json_encode($response);
						exit;		    
				}
			}  else if($_REQUEST['register_type']== "manual")  {					
				//$data['User']['password']  	=  @$_REQUEST['password'];
				$data['User']['password']  	=  AuthComponent::password($_REQUEST['password']);
				$exist 								= 	$this->User->find("first", array("conditions" => array("User.username" => $data['User']['username'])));
				if (empty($exist))  {
					$emailexist 					= 	$this->User->find('first',array('conditions'=>array('AND'=>array('User.email'=>$data['User']['email']))));
					if (empty($emailexist))  {
						$this->User->create();               
						if ($this->User->save($data)) {
							$user_id    			=  $this->User->getLastInsertID();							
							if(@$_REQUEST['profile_image']!='') {  
								$name				=  $user_id."profileImage.png";
								$this->User->saveField('profile_image',$name);
								@$_REQUEST['profile_image']	=  str_replace('data:image/png;base64,', '', @$_REQUEST['profile_image']);
								$_REQUEST['profile_image'] 		=  str_replace(' ', '+',$_REQUEST['profile_image']);
								$unencodedData						=  base64_decode($_REQUEST['profile_image']);
								$pth 											=  WWW_ROOT.'files' . DS . 'profileimage' . DS .$name;
								file_put_contents($pth, $unencodedData);
							 }
							 $isf	 			= 	$this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
							$user_id		=	isset ($isf['User']['id']) ? $isf['User']['id'] : '';	
							$username	=	isset ($isf['User']['username']) ? $isf['User']['username'] : '';								
							$email			=	isset ($isf['User']['email']) ? $isf['User']['email'] : '';	
							$contact		=	isset ($isf['User']['contact']) ? $isf['User']['contact'] : '';	
							$usertype_id	=	isset ($isf['User']['usertype_id']) ? $isf['User']['usertype_id'] : '';	
							
							$response  = array(	'success'=>1,'message'=>'User Register Successfully');
							$response['data'] = array (
								'user_id' 		=> $user_id,
								'username'	=> $username,
								'image'			=> FULL_BASE_URL.$this->webroot.'files' . DS . 'profileimage'. DS .$isf['User']['profile_image'],
								'email'			=> $email,
								'usertype_id'	=> $usertype_id							
							);
							echo json_encode($response);die;
						}  else  {
							$response			= 	array('success'=>0,'message'=>'Please try again');
							echo json_encode($response);die;
						}
					}  else  {
						$response						= 	array('success'=>3,'message'=>'Email id exist, please try another email');
						echo json_encode($response);die;
					} 					
				}  else  {
					$response 							= 	array('success'=>3,'message'=>'User already exist, please try another user');
					echo json_encode($response);die;
				}		
			}
			exit;			
		}
		
		// http://dev414.trigma.us/E-Mac/Webservices/login?email=gurudutt.sharma123@trigma.in&password=123456
		function login ($u = null,$p = null)	
		{
			$this->request->data['User']['username']	=	$_REQUEST['email'];
			$this->request->data['User']['password']	= 	$_REQUEST['password'];                 
			$usern 			= 	$this->request->data['User']['username'];
			$us 				= 	$this->User->find("first", array("conditions" => array("OR"=>array("User.email"=>$usern,"User.username" => $usern))));
			
			if (empty($us))  {
				$response =	array('message'=>"Invalid username and password",'success' =>0);
				echo json_encode($response);exit; 				
			}
			if ($us['User']['status'] != '1') { 
				$response =	array('message'=>"Your account has been blocked by Administrator",'success' =>0);
				echo json_encode($response);exit; 
			}
			App::Import('Utility', 'Validation'); 
			$pass 			=	AuthComponent::password($this->data['User']['password']); 
			//echo $pass;die;
			$user 			=	$this->request->data['User']['username'];
			$isf 				= 	$this->User->find(
				'first', array(
					'conditions' 	=> array(
						'AND' 		=> array(
							'OR'=>array(
								'User.email' 		=> $user,
								"User.username" => $user
							), 
							'User.password' => $pass
						)
					)
				)
			);
			if (!$isf) {
				$response = 	array('message'=>"Invalid Password",'success' =>0);
				echo json_encode($response);exit; 					
			} 
			$resp 			= 	"You have successfully logged-In";
			$type 			=	$isf['User']['usertype_id'];						
				
			$user_id		=	isset ($isf['User']['id']) ? $isf['User']['id'] : '';
			$username	=	isset ($isf['User']['username']) ? $isf['User']['username'] : '';
			$email			=	isset ($isf['User']['email']) ? $isf['User']['email'] : '';
			$profile_image	=	isset ($isf['User']['profile_image']) ? FULL_BASE_URL.$this->webroot.'files' . DS . 'profileimage'. DS .$isf['User']['profile_image'] : '';
			
			$response		=	array (
				'message'	=> $resp,
				'user_id' 	=> $user_id,
				'username'=> $username,
				'email'		=> $email,
				'profile_image'	=> $profile_image,
				'success'		=> 1
			);
			//pr ($response);die;
			echo json_encode($response);exit; 
		}
		
		// http://dev414.trigma.us/E-Mac/Webservices/forgot?email=gurudutt.sharma@trigma.in
		public function forgot () 
		{
			$email 						= 	$_REQUEST['email'];
			$fu 							= 	$this->User->find('first', array('conditions' => array('User.email' => $email)));
			if (empty($fu)) {  
				$response[] 			= array('success'=>0,'message'=>"Email does not exist");
				echo json_encode($response);exit;		
			}
		
			if ($fu['User']['status'] != "1") {
				$response[] 			= array('success'=>0,'message'=>"Your account has been blocked by Administrator");
				echo json_encode($response);exit;
			}
			
			$name = $fu['User']['email'];
			if  ($fu['User']['username'] != '')  {
				$name = $fu['User']['username'];
			} 
			$key 						=	Security::hash(String::uuid(), 'sha512', true);
			$hash 						= 	sha1($fu['User']['email'] . rand(0, 100));
			$url 							= 	Router::url(array('controller' => 'admin/users', 'action' => 'reset'), true) . '/' . $key . '#' . $hash;
			$ms 							= 	"<p>Hi <br/>".$name.",<br/><a href=".$url.">Click here</a> to reset your password.</p><br /> ";
			$fu['User']['token'] 		= $key;
			$this->User->id 		= $fu['User']['id'];
			if ($this->User->saveField('token', $fu['User']['token'])) {
				$l 							= new CakeEmail();
				$l->emailFormat ('html')->template ('signup', 'fancy')->subject ('Reset Your Password')->to ($email)->from ('gurudutt.sharma@trigma.in')->send($ms);
				$response[]			= array('success'=>1,'message'=>"Check Your Email To Reset your password");
				echo json_encode($response);
				exit;
			} 	else {				
				$response[] 			= array('success'=>0,'message'=>"Please try again");
				echo json_encode($response);
				exit;                                
			}
		}
		
		//	http://dev414.trigma.us/N-110BB/Webservices/reset?email=gurudutt.sharma@trigma.in
		public function admin_reset($token = null) 
		{
			$this->User->recursive = -1;
			if (!empty($token)) {
				$u = $this->User->findBytoken($token);
				if ($u) {
					$this->User->id = $u['User']['id'];
					if (!empty($this->data)) {
					    if ($this->data['User']['password'] != '') {
							if ($this->data['User']['password_confirm'] != '') {
								if ($this->data['User']['password'] != $this->data['User']['password_confirm']) {
									$this->Session->setFlash("Both the passwords are not matching...");
									return;
								}
								$this->User->data = $this->data;
								$this->User->data['User']['username'] = $u['User']['username'];
								$new_hash = sha1($u['User']['username'] . rand(0, 100)); //created token
								$this->User->data['User']['token'] = $new_hash;
								if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {
									//	if($this->request->data['User']['password'] == $this->request->data['User']['confirm_password'] ){
									if ($this->User->save($this->User->data)) {
										echo "Your password has been updated";
										exit;
									}
								} else {
									$this->set('errors', $this->User->invalidFields());
								}
							} else {
								$this->Session->setFlash("Both fields are required...");
								return;
							}
						} else {
								$this->Session->setFlash("Both fields are required...");
								return;
							}
					}
				} else {
					$this->Session->setFlash('Token Corrupted, Please Retry.the reset link <a style="cursor: pointer; color: rgb(0, 102, 0); text-decoration: none; background: url("http://files.adbrite.com/mb/images/green-double-underline-006600.gif") repeat-x scroll center bottom transparent; margin-bottom: -2px; padding-bottom: 2px;" name="AdBriteInlineAd_work" id="AdBriteInlineAd_work" target="_top">work</a> only for once.');
				}
			}
		}
		
		//    4. http://dev414.trigma.us/E-Mac/webservices/changepass?email=gurudutt.sharma@trigma.in&opass=123456&cpass=gurudutt&newpass=gurudutt
		public function changepass () 
		{         
			$result			=  array();
			$password 	=	AuthComponent::password($_REQUEST['opass']);
			$em				=	$_REQUEST['email'];
			$pass			=	$this->User->find('first',array('conditions'=>array('OR'=>array('User.username'=>$em,'User.email' => $em))));
			
			if (empty($pass))  {
				$result['message']				=	"Your email id does not exist.";  
				echo json_encode($result);
				exit;
			}

			$result['user_id']	=	@$pass['User']['id'];
			if ($pass['User']['password']==$password) {
				if ($_REQUEST['newpass'] != $_REQUEST['cpass'] ) {
					$result['message']="New password and Confirm password field do not match";                          
				}	else  {
					$_REQUEST['opass'] 	= $_REQUEST['newpass'];
					$this->User->id 			= $pass['User']['id'];
					if($this->User->exists())	{
						$pass	= array('User'=>array('password'=>$_REQUEST['newpass']));
						if($this->User->save($pass)) {
							$result	=	array('success'=>1,'message'=>"Password updated");
						}
					}
				}
			}	else {
				$result	=	array('success'=>0,'message'=>"Your old password did not match.");
			}        
			echo json_encode($result);
			exit;
		}
		
		//http://dev414.trigma.us/E-Mac/webservices/myProfile?id=2316
		public function myProfile() 
		{  
			$id	=	$_REQUEST['id'];
			$this->User->id	=	$id;
			if($this->User->exists	())  {    
				$user=$this->User->find ('all',array('conditions'=>  array('User.id'=>$id)));
				foreach ($user as $key => $value) {
					$url 				= FULL_BASE_URL.$this->webroot.'files' .DS. 'profileimage';
					$username 	= !empty($value['User']['username'])?$value['User']['username'] :'';
					$email			= !empty($value['User']['email'])?$value['User']['email'] :'';
					$contact			= !empty($value['User']['contact'])?$value['User']['contact'] :'';
					$profile_image	=	isset ($value['User']['profile_image']) ? FULL_BASE_URL.$this->webroot.'files' . DS . 'profileimage'. DS .$value['User']['profile_image'] : '';
			
					$data			=  array (
						'id'			=>$value['User']['id'],
						'username'=>$username,
						'email'		=>$email,
						'profile_image'=>$profile_image,
						'contact'	=>$contact,
						'success'		=>1
					);
				}        
				echo json_encode($data);exit;
			} else {
				$data = array('success'=>0,'msg'=>'Invalid User');
				 echo json_encode($data);exit;
			}    
		}
		
		// http://dev414.trigma.us/E-Mac/webservices/profile_edit?id=207&username=gurudutt1&profile_image=profileimage2.png&contact=123456
		public function profile_edit () 
		{
			$this->loadModel('User');
			$this->User->id = $_REQUEST['id'];
			if (!$this->User->exists()) 
			{	
				throw new NotFoundException(__('Invalid user'));
			}
			$user_email_exist	=	$this->User->find ('first',array('conditions'=>array('User.id'=>$_REQUEST['id'])));
			$result	=  array ();
			if (!empty($user_email_exist)) {
										
				if(!empty($_REQUEST['username']))  {
					$this->request->data['User']['username']	= $_REQUEST['username'];
				} 			
				if(!empty($_REQUEST['contact']))  {
					$this->request->data['User']['contact']	= $_REQUEST['contact'];
				} 				
								
				$id = $_REQUEST['id'];
			
				if ($this->User->save($this->request->data)) {
					if(isset($_REQUEST['profile_image']) && !empty($_REQUEST['profile_image']))  {
						$ti=date('Y-m-d-g:i:s');
						$dname= $ti.$id."image.png";
						$this->User->saveField('profile_image',$dname);
						@$_REQUEST['profile_image']= str_replace('data:image/png;base64,', '', $_REQUEST['profile_image']);
						$_REQUEST['profile_image'] = str_replace(' ', '+',$_REQUEST['profile_image']);
						$unencodedData=base64_decode($_REQUEST['profile_image']);
						$pth3 = WWW_ROOT.'files' . DS . 'profileimage'. DS .$dname;
						file_put_contents($pth3, $unencodedData);
					}
					$user	=	$this->User->find('first',array('conditions'=>  array('User.id'=>$id)));	
					if (!empty($user['User']['profile_image'])){
						$profileImage = FULL_BASE_URL.$this->webroot.'files' . DS . 'profileimage'. DS .$user['User']['profile_image'];
					} else {
						$profileImage = '';
					}
					$user_id		=	isset ($user['User']['id']) ? $user['User']['id'] : '';
					$username	=	isset ($user['User']['username']) ? $user['User']['username'] : '';
					$email			=	isset ($user['User']['email']) ? $user['User']['email'] : '';
					$contact			=	isset ($user['User']['contact']) ? $user['User']['contact'] : '';
					$profile_image	=	isset ($user['User']['profile_image']) ? FULL_BASE_URL.$this->webroot.'files' . DS . 'profileimage'. DS .$user['User']['profile_image'] : '';
					
					$result['id']					= $user['User']['id']; 
					$result['username']		= $user['User']['username']; 
					$result['contact']			= $user['User']['contact']; 
					$result['profile_image']			= $profile_image; 
					$result['email']			= $user['User']['email']; 
					$result['message']		= 'The details has been updated';
				} 
				else {
					$result['message']= 'The details could not be saved. Please, try again.';    
				}
				echo json_encode($result);
				exit();
			} else {
				$result['message']= 'Somthing error eccor';    
				echo json_encode($result);
				exit();
			}
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/categories
		public function categories () 
		{
			$data 	= 	$this->Category->find ('all');
			//pr ($data);die;
			if (empty($data)) {
				$response[] = array('status'=>0,'msg'=>'no category found.');
				echo json_encode ($response);exit;
			}	
			foreach($data as $value) {
				$response[]	=	array(
					'status'				=>1,
					'category_id'		=>$value['Category']['id'],
					'category_name'=>$value['Category']['name'],										
				);
			}
			//pr ($response);
			echo json_encode($response);exit;
		}		
		
		//http://dev414.trigma.us/E-Mac/Webservices/allergens
		public function allergens () 
		{
			$data 	= 	$this->Allergen->find ('all');
			//pr ($data);die;
			if (empty($data)) {
				$response[] = array('status'=>0,'msg'=>'no category found.');
				echo json_encode ($response);exit;
			}	
			foreach($data as $value) {
				$response[]	=	array(
					'status'				=>1,
					'alergen_id'		=>$value['Allergen']['id'],
					'allergen_name'=>$value['Allergen']['name'],										
				);
			}
			//pr ($response);
			echo json_encode($response);exit;
		}		
		
		//http://dev414.trigma.us/E-Mac/Webservices/add_allergens_user?user_id=3&allergen_id=3
		public function add_allergens_user () 
		{
			$data['AllergenUser']['user_id']		=	$_REQUEST['user_id'];
			$data['AllergenUser']['allergen_id']	=	$_REQUEST['allergen_id'];
			$data['AllergenUser']['date']			=	date('Y-m-d');
			if ($_REQUEST['user_id'] =='' or $_REQUEST['allergen_id'] =='') {
				$response[] = array('status'=>0,'msg'=>'wrong request.');
				echo json_encode ($response);exit;
			}	
			if ($this->AllergenUser->save($data))  {
				$response[] = array('status'=>1,'msg'=>'Success.');
				echo json_encode ($response);exit;
			}
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/allergens_user?user_id=3
		public function allergens_user () 
		{
			if ($_REQUEST['user_id'] =='' ) {
				$response[] = array('status'=>0,'msg'=>'wrong request.');
				echo json_encode ($response);exit;
			}	
			$users_allergen	=	$this->AllergenUser->find(
				'all',array(
					'conditions'=>array(
						'AllergenUser.user_id'=>$_REQUEST['user_id']
					),
					'contain'=>array (
						'Allergen'=>array(
							'fields'=>array(
								'Allergen.name'
							)
						)
					),
					'fields'=>array('id','allergen_id')
				)
			);
			foreach($users_allergen as $info) {
				$users_allergens[]	=	$info['Allergen']['name'];
			}	

			$allergen	=	$this->Allergen->find('all');

			$response = array('success'=>1,'message'=>'success');
			foreach($allergen as $value) {
				if(in_array($value['Allergen']['name'],$users_allergens))  {
					$response['data'][]	=	array(
						'allergen_id'		=>$value['Allergen']['id'],
						'allergen_name'=>$value['Allergen']['name'],										
						'allergen'			=>1,										
					);
				}  else  {
					$response['data'][]	=	array(
						'allergen_id'		=>$value['Allergen']['id'],
						'allergen_name'=>$value['Allergen']['name'],										
						'allergen'			=>0,										
					);
				}
				$allergen1[]	=	$value['Allergen']['name'];
			}			
			// pr ($allergen1);
			// pr ($response);die;
			echo json_encode ($response);exit;
			
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/testing?user_id=2260
		public function testing() 
		{
			Configure::write('debug',2);
			App::import('Vendor', 'factual-php-driver-master',array('file'=>'factual-php-driver-master/Factual.php'));
			
			$tableName = "products-cpg";
			
			$factual_api_key     = "ivg1N0ckRGOCBEh0WuZihMDY9T7DYzZmVXifYu5o";
            $factual_api_sec     = "tE9hakw2MiU643lfDYcustbrdJ5p8g9da4vi5oB1";
            $mapbox_access_token = "YOUR_MAPBOX_ACCESS_TOKEN";
            $mapbox_map_id       = "YOUR_MAP_ID";            
			/** instantiate Factual driver **/
            $factual = new Factual($factual_api_key, $factual_api_sec);
            //Search for products containing the word "shampoo"
			
			$query = new FactualQuery;
			//$query->search("shampoo");
			$query->field("upc")->equal("080878053605"); 
			$res = $factual->fetch($tableName, $query); 
			echo "<pre>";print_r($res->getData());			
			die;
		}	
		//https://www.factual.com/data/t/healthcare-providers-us#offset=40 (for pagination)
		//http://developer.factual.com/working-with-factual-products/
		//https://github.com/Factual/factual-php-driver
		//http://dev414.trigma.us/E-Mac/Webservices/get_product_by_bar_code?barcode=051000029546
		public function get_product_by_bar_code () 
		{
			$barcode = $_REQUEST['barcode'];			
			Configure::write('debug',2);
		
			if (@$barcode  == '')  {
				$response[] = array('status'=>0,'msg'=>'no products found.');
				echo json_encode ($response);exit;
			}
			
			App::import('Vendor', 'factual-php-driver-master',array('file'=>'factual-php-driver-master/Factual.php'));			
			$tableName = "products-cpg-nutrition";  //https://www.factual.com/data/t/products-cpg-nutrition/schema
			
			// Gurudutt Sharma
			//$factual_api_key	= "ivg1N0ckRGOCBEh0WuZihMDY9T7DYzZmVXifYu5o";
            //$factual_api_sec	= "tE9hakw2MiU643lfDYcustbrdJ5p8g9da4vi5oB1";
			
			// Sahil Seth
			$factual_api_key		= "t8XWKIhg02eRyhuM0epfa97HS8f8SOzu0Nbn6lE1";
            $factual_api_sec	= "Lm6qmefb1sjDhpSHkUbdlND7gAlogmvv43fOEKsl";
            
			$mapbox_access_token = "YOUR_MAPBOX_ACCESS_TOKEN";
            $mapbox_map_id	= "YOUR_MAP_ID";            
			/** instantiate Factual driver **/
            $factual = new Factual($factual_api_key, $factual_api_sec);
            //Search for products containing the word "shampoo"
			
			$query	= new FactualQuery;
			//$query->search("shampoo");
			//$query->limit('all');
			//$query->offset('20'); //https://www.factual.com/data/t/healthcare-providers-us#offset=40
			$query->field("upc")->equal($barcode); 
			//$query->field("ingredients")->equal($ingredients); 
			//$query->field("category")->equal($category); 
			$res 	= $factual->fetch($tableName, $query); 
			$data	= $res->getData();	
			$response=	array ('success'=>1,'message'=>'Success.');		
			//echo "<pre>";print_r($res->getData());die;			
			$image		= array();
			$ingredient	= array();
			foreach($data as $value) {
				//pr ($value);die;
				$factual_id = '';
				$product_name = '';
				$upc = '';
				$avg_price = '';
				$brand = '';
				
				if (!empty($value['image_urls']))  {
					foreach($value['image_urls'] as $images) {
						$image[]		=	array(
							'images'				=> $images,
						);
					}
				}
				if (!empty($value['ingredients']))  {
					foreach($value['ingredients'] as $ing) {
						$ingredient[]		=	array(
							'ingredients'				=> $ing,
						);
					}
				}
				
				if (@$value['factual_id'] != '')  		{  $factual_id = $value['factual_id'];  }
				if (@$value['product_name'] != '')  {  $product_name = $value['product_name'];  }
				if (@$value['upc'] != '')  					{  $upc = $value['upc'];  }
				if (@$value['avg_price'] != '')  		{  $avg_price = $value['avg_price'];  }
				if (@$value['category'] != '')  			{  $category = $value['category'];  }
				if (@$value['brand'] != '')  				{  $brand = $value['brand'];  }
				
				$response['data'][]		=	array(
					'factual_id'				=> $factual_id,
					'product_name'		=> $product_name,
					'upc'						=> $upc,
					'avg_price'				=> $avg_price,
					'brand'						=> $brand,
					'category'				=> $category,
					'images'					=> $image,
					'ingredients'				=> $ingredient,
				);
			}
			//echo "<pre>";print_r($res->getData());			
			echo json_encode ($response);exit;
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/get_products_by_ingredients?ingredients=Pork
		public function get_products_by_ingredients () 
		{
			$ingredients = $_REQUEST['ingredients'];
			Configure::write('debug',2);
		
			if (@$ingredients  == '')  {
				$response[] = array('status'=>0,'msg'=>'no products found.');
				echo json_encode ($response);exit;
			}
			
			App::import('Vendor', 'factual-php-driver-master',array('file'=>'factual-php-driver-master/Factual.php'));			
			$tableName = "products-cpg-nutrition";  //https://www.factual.com/data/t/products-cpg-nutrition/schema
			
			// Gurudutt Sharma
			//$factual_api_key	= "ivg1N0ckRGOCBEh0WuZihMDY9T7DYzZmVXifYu5o";
            //$factual_api_sec	= "tE9hakw2MiU643lfDYcustbrdJ5p8g9da4vi5oB1";
			
			// Sahil Seth
			$factual_api_key		= "t8XWKIhg02eRyhuM0epfa97HS8f8SOzu0Nbn6lE1";
            $factual_api_sec	= "Lm6qmefb1sjDhpSHkUbdlND7gAlogmvv43fOEKsl";
            
			$mapbox_access_token = "YOUR_MAPBOX_ACCESS_TOKEN";
            $mapbox_map_id	= "YOUR_MAP_ID";            
			/** instantiate Factual driver **/
            $factual = new Factual($factual_api_key, $factual_api_sec);
            //Search for products containing the word "shampoo"
			
			$query	= new FactualQuery;
			//$query->search("shampoo");
			//$query->limit('all');
			$query->offset('20'); //https://www.factual.com/data/t/healthcare-providers-us#offset=40
			$query->field("ingredients")->equal($ingredients); 
			//$query->field("category")->equal($category); 
			$res 	= $factual->fetch($tableName, $query); 
			$data	= $res->getData();	
			$response=	array ('success'=>1,'message'=>'Success.');		
			//echo "<pre>";print_r($res->getData());			
			$image		= array();
			$ingredient	= array();
			foreach($data as $value) {
				//pr ($value);die;
				$factual_id = '';
				$product_name = '';
				$upc = '';
				$avg_price = '';
				$brand = '';
				
				if (!empty($value['image_urls']))  {
					foreach($value['image_urls'] as $images) {
						$image[]		=	array(
							'images'				=> $images,
						);
					}
				}
				if (!empty($value['ingredients']))  {
					foreach($value['ingredients'] as $ing) {
						$ingredient[]		=	array(
							'ingredients'				=> $ing,
						);
					}
				}
				
				if (@$value['factual_id'] != '')  		{  $factual_id = $value['factual_id'];  }
				if (@$value['product_name'] != '')  {  $product_name = $value['product_name'];  }
				if (@$value['upc'] != '')  					{  $upc = $value['upc'];  }
				if (@$value['avg_price'] != '')  		{  $avg_price = $value['avg_price'];  }
				if (@$value['category'] != '')  			{  $category = $value['category'];  }
				if (@$value['brand'] != '')  				{  $brand = $value['brand'];  }
				
				$response['data'][]		=	array(
					'factual_id'				=> $factual_id,
					'product_name'		=> $product_name,
					'upc'						=> $upc,
					'avg_price'				=> $avg_price,
					'brand'						=> $brand,
					'category'				=> $category,
					'images'					=> $image,
					'ingredients'				=> $ingredient,
				);
			}
			//echo "<pre>";print_r($res->getData());			
			echo json_encode ($response);exit;
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/get_products_by_category?category=Hair Shampoo&user_id=2
		public function get_products_by_category () 
		{
			$category = $_REQUEST['category'];
			Configure::write('debug',2);
		
			if (@$category == '')  {
				$response[] = array('status'=>0,'msg'=>'no products found.');
				echo json_encode ($response);exit;
			}
			$users_allergen	=	$this->AllergenUser->find(
				'all',array(
					'conditions'=>array(
						'AllergenUser.user_id'=>$_REQUEST['user_id']
					),
					'contain'=>array (
						'Allergen'=>array(
							'fields'=>array(
								'Allergen.name'
							)
						)
					),
					'fields'=>array('id','allergen_id')
				)
			);
			
			foreach($users_allergen as $info) {
				$users_allergens[]	=	$info['Allergen']['name'];
			}
			App::import('Vendor', 'factual-php-driver-master',array('file'=>'factual-php-driver-master/Factual.php'));			
			$tableName = "products-cpg-nutrition";  //https://www.factual.com/data/t/products-cpg-nutrition/schema
			
			// Gurudutt Sharma
			//$factual_api_key	= "ivg1N0ckRGOCBEh0WuZihMDY9T7DYzZmVXifYu5o";
            //$factual_api_sec	= "tE9hakw2MiU643lfDYcustbrdJ5p8g9da4vi5oB1";
			
			// Sahil Seth
			$factual_api_key		= "t8XWKIhg02eRyhuM0epfa97HS8f8SOzu0Nbn6lE1";
            $factual_api_sec	= "Lm6qmefb1sjDhpSHkUbdlND7gAlogmvv43fOEKsl";
            
			$mapbox_access_token = "YOUR_MAPBOX_ACCESS_TOKEN";
            $mapbox_map_id	= "YOUR_MAP_ID";            
			/** instantiate Factual driver **/
            $factual = new Factual($factual_api_key, $factual_api_sec);
            //Search for products containing the word "shampoo"
			
			$query	= new FactualQuery;
			//$query->search("shampoo");
			//$query->limit('all');
			$query->offset('20'); //https://www.factual.com/data/t/healthcare-providers-us#offset=40
			//$query->field("ingredients")->equal($ingredients); 
			$query->field("category")->equal($category); 
			$res 	= $factual->fetch($tableName, $query); 
			$data	= $res->getData();	
			$response=	array ('success'=>1,'message'=>'Success.');		
			//echo "<pre>";print_r($res->getData());			
			$image		= array();
			$ingredient	= array();
			foreach($data as $value) {
				//pr ($value);die;
				$factual_id = '';
				$product_name = '';
				$upc = '';
				$avg_price = '';
				$brand = '';
				foreach($value['image_urls'] as $images) {
					$image[]		=	array(
						'images'				=> $images,
					);
				}
				
				$ingredients = '';
				$ingredient_status ='No';		
				if (!empty($value['ingredients']))  {
					foreach($value['ingredients'] as $ing) {
						if (in_array($ing,$users_allergens))  {
							$ingredient[]		=	array(
								'ingredients'				=> $ing,
							);
							$ingredient_status = 'Yes';
						}  else {
							$ingredient[]		=	array(
								'ingredients'				=> $ing,
							);
						}
					}
				}  
				
				//pr ($ingredient);
				//pr ($users_allergens);die;			
				if (@$value['factual_id'] != '')  		{  $factual_id = $value['factual_id'];  }
				if (@$value['product_name'] != '')  {  $product_name = $value['product_name'];  }
				if (@$value['upc'] != '')  					{  $upc = $value['upc'];  }
				if (@$value['avg_price'] != '')  		{  $avg_price = $value['avg_price'];  }
				if (@$value['category'] != '')  			{  $category = $value['category'];  }
				if (@$value['brand'] != '')  				{  $brand = $value['brand'];  }
				
				$response['data'][]		=	array(
					'factual_id'				=> $factual_id,
					'ingredient_status'	=> $ingredient_status,
					'product_name'		=> $product_name,
					'upc'						=> $upc,
					'avg_price'				=> $avg_price,
					'brand'						=> $brand,
					'category'				=> $category,
				);
			}
			//echo "<pre>";print_r($res->getData());			
			echo json_encode ($response);exit;
		}	
		
		//http://dev414.trigma.us/E-Mac/Webservices/get_products_by_ingredients_and_category?ingredients=Cocamide Dea&category=Hair Shampoo
		public function get_products_by_ingredients_and_category () 
		{
			Configure::write('debug',2);
			$ingredients	= $_REQUEST['ingredients'];
			$category 		= $_REQUEST['category'];
			
			if ($ingredients == '' or $category == '')  {
				$response[] = array('status'=>0,'msg'=>'no products found.');
				echo json_encode ($response);exit;
			}
			
			App::import('Vendor', 'factual-php-driver-master',array('file'=>'factual-php-driver-master/Factual.php'));			
			$tableName = "products-cpg-nutrition";  //https://www.factual.com/data/t/products-cpg-nutrition/schema
			
			// Gurudutt Sharma
			//$factual_api_key	= "ivg1N0ckRGOCBEh0WuZihMDY9T7DYzZmVXifYu5o";
            //$factual_api_sec	= "tE9hakw2MiU643lfDYcustbrdJ5p8g9da4vi5oB1";
			
			// Sahil Seth
			$factual_api_key		= "t8XWKIhg02eRyhuM0epfa97HS8f8SOzu0Nbn6lE1";
            $factual_api_sec	= "Lm6qmefb1sjDhpSHkUbdlND7gAlogmvv43fOEKsl";
            
			$mapbox_access_token = "YOUR_MAPBOX_ACCESS_TOKEN";
            $mapbox_map_id	= "YOUR_MAP_ID";            
			/** instantiate Factual driver **/
            $factual = new Factual($factual_api_key, $factual_api_sec);
            //Search for products containing the word "shampoo"
			
			$query	= new FactualQuery;
			//$query->search("shampoo");
			//$query->limit('all');
			$query->offset('20'); //https://www.factual.com/data/t/healthcare-providers-us#offset=40
			$query->field("ingredients")->equal($ingredients); 
			$query->field("category")->equal($category); 
			$res 	= $factual->fetch($tableName, $query); 
			$data	= $res->getData();	
			$response=	array ('success'=>1,'message'=>'Success.');		
			//echo "<pre>";print_r($res->getData());	
			$image		= array();
			$ingredient	= array();			
			foreach($data as $value) {
				//pr ($value);die;
				$factual_id = '';
				$product_name = '';
				$upc = '';
				$avg_price = '';
				$brand = '';
				foreach($value['image_urls'] as $images) {
					$image[]		=	array(
						'images'				=> $images,
					);
				}
				if (!empty($value['ingredients']))  {
					foreach($value['ingredients'] as $ing) {
						$ingredient[]		=	array(
							'ingredients'				=> $ing,
						);
					}
				}
				
				if (@$value['factual_id'] != '')  		{  $factual_id = $value['factual_id'];  }
				if (@$value['product_name'] != '')  {  $product_name = $value['product_name'];  }
				if (@$value['upc'] != '')  					{  $upc = $value['upc'];  }
				if (@$value['avg_price'] != '')  		{  $avg_price = $value['avg_price'];  }
				if (@$value['brand'] != '')  				{  $brand = $value['brand'];  }
				
				$response['data'][]		=	array(
					'factual_id'				=> $factual_id,
					'product_name'		=> $product_name,
					'upc'						=> $upc,
					'avg_price'				=> $avg_price,
					'brand'						=> $brand,
					'images'					=> $image,
				);
			}
			//echo "<pre>";print_r($res->getData());			
			echo json_encode ($response);exit;
		}			
	}