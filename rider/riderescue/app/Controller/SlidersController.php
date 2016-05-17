<?php
 App::uses('File', 'Utility');
class SlidersController extends AppController
{
	public function admin_index()
	{
		
	}
	
	public function admin_view()
	{
		
		$this->loadModel('Slider');
		$this->set('sliderdata',$this->paginate('Slider'));
		
		
	}
	
	public function admin_edit($id=null)
	{
		$data1 = $this->Slider->find('first',array('conditions'=>array('Slider.id'=>$id)));
		$this->set('data',$data1);


	   //pr($this->request->data);die;
	 if($this->request->is('post') || $this->request->is('put')) {
		
	               $this->Slider->id = $id;
				   	$one = $this->data['Slider']['image']; 
					$this->request->data['Slider']['image'] = $one['name'];
				  if ($one['name'] != '') {
                $this->request->data['Slider']['image'] = $one['name'];
				@$imageNAME = $data1['Slider']['image'];
				$file =WWW_ROOT . 'sliders/'.$imageNAME;
				//$file->delete();
            } 
			else {
				if($this->data['Slider']['old_image']!=''){
					$this->request->data['Slider']['image'] = @$this->data['Slider']['old_image'];
				} 
				else{
					$this->request->data['Slider']['image'] = @$data1['Slider']['image'];
				}
                
            }	
			

			if ($this->Slider->save($this->request->data)) {
				 $time=time();
				   if ($one['error'] == 0) {
                    $pth = WWW_ROOT . 'sliders/'.$one['name'].$time;
                    move_uploaded_file($one['tmp_name'], $pth);
                    $this->Slider->saveField("image",$one['name'].$time);        
					}
			$this->Session->setFlash(__('Your  Slider  has been updated.'));
            return $this->redirect(array('action' => 'admin_view'));
        }
        $this->Session->setFlash(__('Unable to update your Slider.'));
    } 
	
	 
		
	}
	
	
	
	
	
	
	
	
	public function admin_add()
	{
		//pr($_FILES);die;
		//pr($this->request->data);exit;
		 $one = $this->data['Slider']['image']; 
		 $this->request->data['Slider']['image'] = $one['name'];
	 if ($this->request->is('post')) {
            $this->Slider->create();
            if ($this->Slider->save($this->request->data)) {
				$id    = $this->Slider->getLastInsertId();
				 if ($one['name'] != '') {
					       $date=time();
							$imageName = $one['name'].$date;
                            $path = WWW_ROOT . 'sliders/';
                            move_uploaded_file($one['tmp_name'], $path . $imageName);                            
                            $this->Slider->id = $id;
                            $this->Slider->saveField("image", $imageName);                    
                    }
				  $this->Session->setFlash(__('Your Slider has been added.'));
                return $this->redirect(array('action' => 'view'));
            }
            $this->Session->setFlash(__('Unable to add your slider.'));
        }
  }
	
	public function admin_delete($id=null)
	{
		$d=$this->Slider->find('first',array('conditions'=>array('Slider.id'=>$id)));
		$path = WWW_ROOT .'sliders/'.$d['Slider']['image'];
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Slider->id = $id;
			if (!$this->Slider->exists()) {
			throw new NotFoundException(__('Invalid Slider'));
		}
		$d=$this->Slider->find('first',array('conditions'=>array('Slider.id'=>$id)));
		$path = WWW_ROOT .'sliders/'.$d['Slider']['image'];	
		
		if ($this->Slider->delete($id,true)) {
			$this->Session->setFlash(__('Slider deleted'));
			$this->redirect(array('action' => 'view'));
		}
		if($path)
		{
		unlink($path);	
		}
		$this->Session->setFlash(__('Slider was not deleted'));
		$this->redirect(array('action' => 'view'));
		}	
       
	   
	   public function admin_deleteall($id = null){
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        foreach ($this->request['data']['Slider'] as $k) {
            $this->Slider->id = (int) $k;
            if ($this->Slider->exists()) {
                $this->Slider->delete($k,true);
            }
            
        }
        
        $this->Session->setFlash(__('Selected Sliders were removed.'));
      //  $this->redirect($this->data['currentloc']);
	  $this->redirect(array('controller'=>'Sliders', 'action' => 'view'
            ));
    }
	   
	   
	       public function admin_block($id = null)
    {
        $this->Slider->id = $id;
        if ($this->Slider->exists()) {
            $x = $this->Slider->save(array(
                'Slider' => array(
                    'status' => '0'
                )
            ));
            $this->Session->setFlash("Slider Deactivated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to block Slider.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    }
	   
	    public function admin_activate($id = null)
    {
        $this->Slider->id = $id;
        if ($this->Slider->exists()) {
            $x = $this->Slider->save(array(
                'Slider' => array(
                    'status' => '1'
                )
            ));
            $this->Session->setFlash("Slider activated successfully.");
            $this->redirect(array(
                'action' => 'view'
            ));
        } else {
            $this->Session->setFlash("Unable to activate Slider.");
            $this->redirect(array(
                'action' => 'view'
            ));
        }
        
    }
	   
	   
	   
	   
	   
	   
	   }

?>