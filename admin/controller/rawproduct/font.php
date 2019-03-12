<?php 
class ControllerRawproductFont extends Controller { 
	private $error = array();
 
	public function index() {
		$this->language->load('rawproduct/font');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('rawproduct/font');
		 
		$this->getList();
	}

	public function insert() {
		$this->language->load('rawproduct/font');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('rawproduct/font');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
	
			
			$this->model_rawproduct_font->addFont($this->request->post,$_FILES);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('rawproduct/font', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('rawproduct/font');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('rawproduct/font');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_rawproduct_font->editFont($this->request->get['font_id'], $this->request->post,$_FILES);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->redirect($this->url->link('rawproduct/font', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('rawproduct/font');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('rawproduct/font');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $font_id) {
				$this->model_rawproduct_font->deletefont($font_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('rawproduct/font', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->getList();
	}
	
	
	
	protected function getList() {
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
						
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('rawproduct/font', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['insert'] = $this->url->link('rawproduct/font/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('rawproduct/font/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		//$this->data['repair'] = $this->url->link('rawproduct/font/repair', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->data['categories'] = array();
		
		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
				
		$category_total = $this->model_rawproduct_font->getTotalFonts();
		
		$results = $this->model_rawproduct_font->getFonts($data);

		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('rawproduct/font/update', 'token=' . $this->session->data['token'] . '&font_id=' . $result['font_id'] . $url, 'SSL')
			);

			$this->data['fonts'][] = array(
				'font_id' => $result['font_id'],
				'name'        => $result['name'],
				'image'        => $result['image'],
				'is_default'        => ($result['is_default']==1)?'Yes':'No',
				'sort_order'  => $result['sort_order'],
				'selected'    => isset($this->request->post['selected']) && in_array($result['font_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_image'] = $this->language->get('column_image');
		$this->data['column_default'] = $this->language->get('column_default');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 		$this->data['button_repair'] = $this->language->get('button_repair');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$pagination = new Pagination();
		$pagination->total = $category_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('rawproduct/font', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();
		
		$this->template = 'rawproduct/font_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');
				
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_column'] = $this->language->get('entry_column');		
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
	
 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('rawproduct/font', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['font_id'])) {
			$this->data['action'] = $this->url->link('rawproduct/font/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('rawproduct/font/update', 'token=' . $this->session->data['token'] . '&font_id=' . $this->request->get['font_id'], 'SSL');
		}
		
		$this->data['cancel'] = $this->url->link('rawproduct/font', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['font_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$font_info = $this->model_rawproduct_font->getFont($this->request->get['font_id']);
			$font_value = $this->model_rawproduct_font->getFontValue($this->request->get['font_id']);
    	}
		
		$this->data['token'] = $this->session->data['token'];
		
		$this->data['font_value'] = (!empty($font_value))?$font_value:array();
	

				
		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($font_info)) {
			$this->data['sort_order'] = $font_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}
		
		
		
		if (isset($this->request->post['directionshow'])) {
			$this->data['directionshow'] = $this->request->post['directionshow'];
		} elseif (!empty($font_info)) {
			$this->data['directionshow'] = $font_info['directionshow'];
		} else {
			$this->data['directionshow'] = 1;
		}
		
		if (isset($this->request->post['is_default'])) {
			$this->data['is_default'] = $this->request->post['is_default'];
		} elseif (!empty($font_info)) {
			$this->data['is_default'] = $font_info['is_default'];
		} else {
			$this->data['is_default'] = 0;
		}
		
		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($font_info)) {
			$this->data['status'] = $font_info['status'];
		} else {
			$this->data['status'] = 1;
		}
				

						
		$this->template = 'rawproduct/font_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'rawproduct/font')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
//echo $_FILES['fontTTF1']['name'];die;
	  if (!$_FILES['fontTTF1']['name']) {
			$this->error['warning'] = 'Please upload the font TTF 1';
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
					
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'rawproduct/font')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
			
}
?>