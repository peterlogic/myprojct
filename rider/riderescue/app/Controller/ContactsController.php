<?php
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');
class ContactsController extends AppController {
public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('admin_delete','index'));
					}

	public function index() {
	        
		if ($this->request->is('post')) {
			// if ($this->Recaptcha->verify()) {
		
				if($this->Contact->save($this->request->data)){
					echo "Your Information Has Been Saved. Thank You";
					exit;
				} else {
					echo "Your information could not be saved.plz try again.";
					exit;
				}
			// } else {
				//display the raw API error
				//$this->Session->setFlash($this->Recaptcha->error);
				// echo $this->Recaptcha->error;
				// exit;
			// }
		}	
	}



	

public function admin_index() {
	$this->loadModel('Contact');
	$this->paginate = array(
		'order' => array('Contact.id'=>'desc'),
			'limit'=>10		
		);
	$this->set('info', $this->paginate('Contact'));
}

public function admin_delete($id=null) {
$this->loadModel('Contact');
	if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->Contact->delete()) {
            $this->Session->setFlash(__('Contact deleted'));
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__('Contact was not deleted'));
        $this->redirect(array(
            'action' => 'index'
        ));
	
}

public function admin_edit($id=null) {
	$this->loadModel('Contact');
	$this->Contact->id = $id;    
		if (!$this->Contact->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->Contact->exists()) 
		{
			$userData = $this->Contact->find('first',array('conditions'=>array('Contact.id'=>$id)));
			$this->set("userinfo", $userData);
			$this->set('action_type','edit');
		 } 
	/*  $this->loadModel('Contactreply');
	$message = $this->Contactreply->find('all',array('conditions'=>array('Contactreply.contact_id'=>$id)));
	$this->set("reply",$message);  */
}

public function admin_deleteall() {
			if (!$this->request->is('Ajax')) {
            throw new MethodNotAllowedException();
        }
		$this->loadModel('Contact');
		foreach ($this->request['data']['Contact'] as $k) {
		    $this->Contact->id = (int) $k;
			$userData = $this->Contact->find('first',array('conditions'=>array('Contact.id'=>(int) $k)));
			    if ($this->Contact->exists()) {
				$this->Contact->deleteAll(array('Contact.id'=>$k), $cascade = true);
                //$this->Customer->deleteAll();				
            }  
		   
        }        
        $this->Session->setFlash(__('Selected contact were removed.'));
        $this->autoRender=false;

}





}
