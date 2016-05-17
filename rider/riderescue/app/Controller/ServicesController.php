<?php
 App::uses('File', 'Utility');
class ServicesController extends AppController
{
	public function admin_index()
	{
		
	}
	
	public function admin_view()
	{
		
		$this->loadModel('Service');
		$this->set('servicedata',$this->paginate('Service'));
		
		
	}
	
	public function admin_edit($id=null)
	{
		$data1 = $this->Service->find('first',array('conditions'=>array('Service.id'=>$id)));
		$this->set('data',$data1);


	   //pr($this->request->data);die;
	 if($this->request->is('post') || $this->request->is('put')) {
		
	               $this->Service->id = $id;
				   	$one = $this->data['Service']['image']; 
					$this->request->data['Service']['image'] = $one['name'];
				  if ($one['name'] != '') {
                $this->request->data['Service']['image'] = $one['name'];
				@$imageNAME = $data1['Service']['image'];
				$file =WWW_ROOT . 'services/'.$imageNAME;
				//$file->delete();
            } 
			else {
				if($this->data['Service']['old_image']!=''){
					$this->request->data['Service']['image'] = @$this->data['Service']['old_image'];
				} 
				else{
					$this->request->data['Service']['image'] = @$data1['Service']['image'];
				}
                
            }	
			

			if ($this->Service->save($this->request->data)) {
				 $time=time();
				   if ($one['error'] == 0) {
                    $pth = WWW_ROOT . 'services/'.$one['name'].$time;
                    move_uploaded_file($one['tmp_name'], $pth);
                    $this->Service->saveField("image",$one['name'].$time);        
					}
			$this->Session->setFlash(__('Your  Service  has been updated.'));
            return $this->redirect(array('action' => 'admin_view'));
        }
        $this->Session->setFlash(__('Unable to update your Service.'));
    } 
	
	 
		
	}
	
	
	
	
	
	
	
	
	public function admin_add()
	{
		//pr($_FILES);die;
		//pr($this->request->data);exit;
		 $one = $this->data['Service']['image']; 
		 $this->request->data['Service']['image'] = $one['name'];
	 if ($this->request->is('post')) {
            $this->Service->create();
            if ($this->Service->save($this->request->data)) {
				$id    = $this->Service->getLastInsertId();
				 if ($one['name'] != '') {
					       $date=time();
							$imageName = $one['name'].$date;
                            $path = WWW_ROOT . 'services/';
                            move_uploaded_file($one['tmp_name'], $path . $imageName);                            
                            $this->Service->id = $id;
                            $this->Service->saveField("image", $imageName);                    
                    }
				  $this->Session->setFlash(__('Your Service has been added.'));
                return $this->redirect(array('action' => 'view'));
            }
            $this->Session->setFlash(__('Unable to add your Service.'));
        }
  }
	
	public function admin_delete($id=null)
	{
		$d=$this->Service->find('first',array('conditions'=>array('Service.id'=>$id)));
		$path = WWW_ROOT .'services/'.$d['Service']['image'];
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Service->id = $id;
			if (!$this->Service->exists()) {
			throw new NotFoundException(__('Invalid Service'));
		}
		$d=$this->Service->find('first',array('conditions'=>array('Service.id'=>$id)));
		$path = WWW_ROOT .'services/'.$d['Service']['image'];	
		
		if ($this->Service->delete($id,true)) {
			$this->Session->setFlash(__('Service deleted'));
			$this->redirect(array('action' => 'view'));
		}
		if($path)
		{
		unlink($path);	
		}
		$this->Session->setFlash(__('Service was not deleted'));
		$this->redirect(array('action' => 'view'));
		}	
       
	   
	   public function admin_deleteall($id = null){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        foreach ($this->request['data']['Service'] as $k) {
            $this->Service->id = (int) $k;
            if ($this->Service->exists()) {
                $this->Service->delete($k,true);
            }
            
        }
        
        $this->Session->setFlash(__('Selected Service were removed.'));
      //  $this->redirect($this->data['currentloc']);
	  $this->redirect(array('controller'=>'Services', 'action' => 'view'
            ));
    }
	   
	   
	   
	       public function admin_block($id = null)
    {
        $this->Service->id = $id;
        if ($this->Service->exists()) {
            $x = $this->Service->save(array(
                'Service' => array(
                    'status' => '0'
                )
            ));
            $this->Session->setFlash("Service Deactivated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to Deactivate Service.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    }
	   
	    public function admin_activate($id = null)
    {
        $this->Service->id = $id;
        if ($this->Service->exists()) {
            $x = $this->Service->save(array(
                'Service' => array(
                    'status' => '1'
                )
            ));
            $this->Session->setFlash("Service activated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to activate Service.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    }
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	
}

?>