<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();

        if(!$this->ion_auth->logged_in() && $this->uri->segment(2) != 'login'){
            redirect('admin/login', 'refresh');
        }

	}

	public function __display($output = null, $title = "Dashboard", $view = "index")
	{
	  $output->ion_auth = $this->ion_auth;
      $output->page_title = $title;
      $output->page_class = str_replace(' ','_',strtolower($title));

	  if($view == "login"){
          $this->load->view('admin/'.$view.'.php',(array)$output);
	  }else{
	      $this->load->view('admin/include/header', (array)$output);
          $this->load->view('admin/include/topbar', (array)$output);
          $this->load->view('admin/include/lsidebar', (array)$output);
          $this->load->view('admin/'.$view.'.php',(array)$output);
          $this->load->view('admin/include/footer', (array)$output);
          $this->load->view('admin/include/tail', (array)$output);
	  }
	}

    public function index()
	{
	    if($this->ion_auth->logged_in()){

    	    $data = new stdClass;

            $data->css_files = array();
            $data->js_files = array();
            $data->message = $this->session->flashdata('message');

    		$this->__display($data);

        }else{ $this->ion_auth->logout(); redirect('admin/login'); }
	}

    public function coc()
	{
        if($this->ion_auth->logged_in()
        && ($this->ion_auth->is_admin()
        || $this->ion_auth->in_group(array('coc_add', 'coc_edit', 'coc_delete')))){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('coc');
    			$crud->set_subject('COC');
                //$crud->set_relation('medical_cert_id','medical_certificates','certificate_no');

                // who is creating this certificate
                $creator = $this->ion_auth->user()->row();
                $created_by = trim($creator->first_name).' ('.$creator->username.')';

                // fill audit fields on insert; never editable in the form
                $crud->callback_before_insert(function($post_array) use ($created_by){
                    $post_array['created_by'] = $created_by;
                    $post_array['created_at'] = date('Y-m-d H:i:s');
                    return $post_array;
                });
                // hide from the add/edit forms but keep them in the insert
                $crud->field_type('created_by','invisible');
                $crud->field_type('created_at','invisible');

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                }

                if(!$this->ion_auth->in_group('coc_add') && !$this->ion_auth->is_admin()) {
                    $crud->unset_add();
                    $crud->unset_back_to_list();
                }

                if(!$this->ion_auth->in_group('coc_edit') && !$this->ion_auth->is_admin()) {
                    $crud->unset_edit();
                }

                if(!$this->ion_auth->in_group('coc_delete') && !$this->ion_auth->is_admin()) {
                    $crud->unset_delete();
                }

                $crud->display_as('certificate_no','Certificate No.');
                $crud->display_as('full_name','Seafarer\'s Name');
                $crud->display_as('date_of_birth','Date of Birth');
                $crud->display_as('nationality','Nationality');
                $crud->display_as('gender','Gender');
                $crud->display_as('date_of_issue','Date of issue');
                $crud->display_as('date_of_expiry','Date of Expiry');
                $crud->display_as('issue_renewal','The date of issue the renewal');
                $crud->display_as('expiry_renewal','The expiry date of the renewal');
                $crud->display_as('regulation_no','STCW Regulation No.');
                $crud->display_as('capacity','Capacity');
                $crud->display_as('cert_function','Function');
                $crud->display_as('level_of_resp','Level of Responsibility');
                $crud->display_as('limitations','Limitations');
                $crud->display_as('status','Status of Certificate');
                $crud->display_as('medical_cert_id','Medical Certificate No.');
                $crud->display_as('created_by','Created By');
                $crud->display_as('created_at','Created On');
                $crud->required_fields('certificate_no','full_name', 'date_of_birth', 'date_of_issue', 'date_of_expiry', 'regulation_no', 'capacity');
$crud->unique_fields(array('certificate_no'));


                $crud->columns('certificate_no','full_name', 'date_of_issue', 'date_of_expiry', 'regulation_no', 'capacity', 'status', 'created_by', 'created_at');

                $crud->field_type('cert_function','multiselect',
                array('Navigation' => 'Navigation',
                'Cargo Handling and stowage' => 'Cargo Handling and stowage',
                'Controlling the operation of the ship and care for persons on board' => 'Controlling the operation of the ship and care for persons on board ',
                'Marine Engineering' => 'Marine Engineering',
                'Electrical, electronic and control engineering' => 'Electrical, electronic and control engineering',
                'Maintenance and repair' => 'Maintenance and repair',
                'Radiocommunications' => 'Radiocommunications',
                'N/A' => 'N/A'));

                $crud->field_type('level_of_resp','dropdown',
                array('Management' => 'Management',
                'Operational' => 'Operational',
                'Support' => 'Support',
                'N/A' => 'N/A' ));

                $crud->field_type('status','dropdown',
                array('Valid' => 'Valid',
                'Suspended' => 'Suspended',
                'Cancelled' => 'Cancelled',
                'Reported Lost' => 'Reported Lost',
                'Destoyed' => 'Destoyed',
                'N/A' => 'N/A' ));

                $crud->field_type('capacity','dropdown',
                array('Master' => 'Master',
                'Chief Mate' => 'Chief Mate',
                'Officer in charge of a navigational watch' => 'Officer in charge of a navigational watch',
                'Chief Engineer Officer' => 'Chief Engineer Officer',
                'Second Engineer Officer' => 'Second Engineer Officer',
                'Officer in charge of an engineering watch' => 'Officer in charge of an engineering watch',
                'Electro Technical Officer' => 'Electro Technical Officer',
                'GMDSS General Operator (GOC)' => 'GMDSS General Operator (GOC)',
                'GMDSS Restricted Operator (ROC)' => 'GMDSS Restricted Operator (ROC)',
                'Coastal Master' => 'Coastal Master',
                'Coastal Officer in charge of a navigational watch' => 'Coastal Officer in charge of a navigational watch' ));

                $crud->field_type('gender','dropdown',
                array('Male' => 'Male',
                'Female' => 'Female' ));

    			$output = $crud->render();

    			$this->__display($output, 'COC Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function cop()
	{
        if($this->ion_auth->logged_in()
        && ($this->ion_auth->is_admin()
        || $this->ion_auth->in_group(array('cop_add', 'cop_edit', 'cop_delete')))){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('cop');
    			$crud->set_subject('COP');
                //$crud->set_relation('medical_cert_id','medical_certificates','certificate_no');

                // who is creating this certificate
                $creator = $this->ion_auth->user()->row();
                $created_by = trim($creator->first_name).' ('.$creator->username.')';

                // fill audit fields on insert; never editable in the form
                $crud->callback_before_insert(function($post_array) use ($created_by){
                    $post_array['created_by'] = $created_by;
                    $post_array['created_at'] = date('Y-m-d H:i:s');
                    return $post_array;
                });
                // hide from the add/edit forms but keep them in the insert
                $crud->field_type('created_by','invisible');
                $crud->field_type('created_at','invisible');

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                }

                if(!$this->ion_auth->in_group('cop_add') && !$this->ion_auth->is_admin()) {
                    $crud->unset_add();
                    $crud->unset_back_to_list();
                }

                if(!$this->ion_auth->in_group('cop_edit') && !$this->ion_auth->is_admin()) {
                    $crud->unset_edit();
                }

                if(!$this->ion_auth->in_group('cop_delete') && !$this->ion_auth->is_admin()) {
                    $crud->unset_delete();
                }

                $crud->display_as('certificate_no','Certificate No.');
                $crud->display_as('certificate_type','Certificate Type');
                $crud->display_as('full_name','Seafarer\'s Name');
                $crud->display_as('date_of_birth','Date of Birth');
                $crud->display_as('nationality','Nationality');
                $crud->display_as('gender','Gender');
                $crud->display_as('date_of_issue','Date of issue');
                $crud->display_as('date_of_expiry','Date of Expiry');
                $crud->display_as('regulation_no','STCW Regulation No.');
                $crud->display_as('capacity','Capacity');
                $crud->display_as('cert_function','Function');
                $crud->display_as('level_of_resp','Level of Responsibility');
                $crud->display_as('limitations','Limitations');
                $crud->display_as('status','Status of Certificate');
                $crud->display_as('medical_cert_id','Medical Certificate No.');
                $crud->display_as('created_by','Created By');
                $crud->display_as('created_at','Created On');

                $crud->required_fields('certificate_no','full_name', 'date_of_birth', 'date_of_issue', 'date_of_expiry', 'regulation_no', 'capacity');
$crud->unique_fields(array('certificate_no'));

                $crud->columns('certificate_no','full_name', 'date_of_issue', 'date_of_expiry', 'regulation_no', 'capacity', 'status', 'created_by', 'created_at');

                $crud->field_type('cert_function','multiselect',
                array('Navigation' => 'Navigation',
                'Cargo Handling and stowage' => 'Cargo Handling and stowage',
                'Controlling the operation of the ship and care for persons on board' => 'Controlling the operation of the ship and care for persons on board ',
                'Marine Engineering' => 'Marine Engineering',
                'Electrical, electronic and control engineering' => 'Electrical, electronic and control engineering',
                'Maintenance and repair' => 'Maintenance and repair',
                'Radiocommunications' => 'Radiocommunications',
                'na' => 'N/A'));

                $crud->field_type('level_of_resp','dropdown',
                array('Management' => 'Management',
                'Operational' => 'Operational',
                'Support' => 'Support',
                'N/A' => 'N/A' ));

                $crud->field_type('status','dropdown',
                array('Valid' => 'Valid',
                'Suspended' => 'Suspended',
                'Cancelled' => 'Cancelled',
                'Reported Lost' => 'Reported Lost',
                'Destoyed' => 'Destoyed',
                'N/A' => 'N/A' ));

               /* $crud->field_type('capacity','dropdown',
                array('Master' => 'Master',
                'Chief Mate' => 'Chief Mate',
                'Officer in charge of a navigational watch' => 'Officer in charge of a navigational watch',
                'Chief Engineer Officer' => 'Chief Engineer Officer',
                'Second Engineer Officer' => 'Second Engineer Officer',
                'Officer in charge of an engineering watch' => 'Officer in charge of an engineering watch',
                'Electro Technical Officer' => 'Electro Technical Officer',
                'GMDSS General Operator (GOC)' => 'GMDSS General Operator (GOC)',
                'GMDSS Restricted Operator (ROC)' => 'GMDSS Restricted Operator (ROC)',
                'Coastal Master' => 'Coastal Master',
                'Coastal Officer in charge of a navigational watch' => 'Coastal Officer in charge of a navigational watch' )); */

                $crud->field_type('gender','dropdown',
                array('Male' => 'Male',
                'Female' => 'Female' ));

    			$output = $crud->render();

    			$this->__display($output, 'COP Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function endorsement()
	{
        if($this->ion_auth->logged_in()
        && ($this->ion_auth->is_admin()
        || $this->ion_auth->in_group(array('endo_add', 'endo_edit', 'endo_delete')))){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('endorsement');
    			$crud->set_subject('Endorsement Certificate');
                //$crud->set_relation('medical_cert_id','medical_certificates','certificate_no');

                // who is creating this certificate
                $creator = $this->ion_auth->user()->row();
                $created_by = trim($creator->first_name).' ('.$creator->username.')';

                // fill audit fields on insert; never editable in the form
                $crud->callback_before_insert(function($post_array) use ($created_by){
                    $post_array['created_by'] = $created_by;
                    $post_array['created_at'] = date('Y-m-d H:i:s');
                    return $post_array;
                });
                // hide from the add/edit forms but keep them in the insert
                $crud->field_type('created_by','invisible');
                $crud->field_type('created_at','invisible');

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                }

                if(!$this->ion_auth->in_group('endo_add') && !$this->ion_auth->is_admin()) {
                    $crud->unset_add();
                    $crud->unset_back_to_list();
                }

                if(!$this->ion_auth->in_group('endo_edit') && !$this->ion_auth->is_admin()) {
                    $crud->unset_edit();
                }

                if(!$this->ion_auth->in_group('endo_delete') && !$this->ion_auth->is_admin()) {
                    $crud->unset_delete();
                }

                $crud->display_as('endorsement_no','Endorsement No.');
                $crud->display_as('certificate_no','Certificate No.');
                $crud->display_as('issuing_party','Certificate Issuing Party');
                $crud->display_as('full_name','Seafarer\'s Name');
                $crud->display_as('date_of_birth','Date of Birth');
                $crud->display_as('nationality','Nationality');
                $crud->display_as('gender','Gender');
                $crud->display_as('date_of_issue','Date of issue');
                $crud->display_as('date_of_expiry','Date of Expiry');
                $crud->display_as('last_revalidation','Last Revalidation Date');
                $crud->display_as('regulation_no','STCW Regulation No.');
                $crud->display_as('capacity','Capacity');
                $crud->display_as('cert_function','Function');
                $crud->display_as('level_of_resp','Level of Responsibility');
                $crud->display_as('limitations','Limitations');
                $crud->display_as('status','Status of Certificate');
                $crud->display_as('medical_cert_id','Medical Certificate No.');
                $crud->display_as('created_by','Created By');
                $crud->display_as('created_at','Created On');

                $crud->required_fields('endorsement_no', 'certificate_no', 'issuing_party','full_name', 'date_of_birth', 'date_of_issue', 'date_of_expiry', 'capacity');
$crud->unique_fields(array('certificate_no', 'endorsement_no'));

                $crud->columns('certificate_no','full_name', 'date_of_issue', 'date_of_expiry', 'regulation_no', 'capacity', 'status', 'created_by', 'created_at');

                $crud->field_type('cert_function','multiselect',
                array('Navigation' => 'Navigation',
                'Cargo Handling and stowage' => 'Cargo Handling and stowage',
                'Controlling the operation of the ship and care for persons on board' => 'Controlling the operation of the ship and care for persons on board ',
                'Marine Engineering' => 'Marine Engineering',
                'Electrical, electronic and control engineering' => 'Electrical, electronic and control engineering',
                'Maintenance and repair' => 'Maintenance and repair',
                'Radiocommunications' => 'Radiocommunications',
                'na' => 'N/A'));

                $crud->field_type('level_of_resp','dropdown',
                array('Management' => 'Management',
                'Operational' => 'Operational',
                'Support' => 'Support',
                'N/A' => 'N/A' ));

                $crud->field_type('status','dropdown',
                array('Valid' => 'Valid',
                'Suspended' => 'Suspended',
                'Cancelled' => 'Cancelled',
                'Reported Lost' => 'Reported Lost',
                'Destoyed' => 'Destoyed',
                'N/A' => 'N/A' ));

             /*   $crud->field_type('capacity','dropdown',
                array('Master' => 'Master',
                'Chief Mate' => 'Chief Mate',
                'Navigational Watch Officer' => 'Navigational Watch Officer',
                'Chief Engineer' => 'Chief Engineer',
                'Second Engineer' => 'Second Engineer',
                'Engineering Watch Officer' => 'Engineering Watch Officer',
                'Electro Technical Officer' => 'Electro Technical Officer',
                'GOC - GMDSS' => 'GOC - GMDSS',
                'Coastal Navigational Master' => 'Coastal Navigational Master',
                'Coastal Navigational Officer' => 'Coastal Navigational Officer' )); */

                $crud->field_type('gender','dropdown',
                array('Male' => 'Male',
                'Female' => 'Female' ));

    			$output = $crud->render();

    			$this->__display($output, 'Endorsement Certificates Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function medical_certificate()
	{
        if($this->ion_auth->logged_in()
        && ($this->ion_auth->is_admin()
        || $this->ion_auth->in_group(array('mc_add', 'mc_edit', 'mc_delete')))){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('medical_certificates');
    			$crud->set_subject('Medical Certificate');

                // who is creating this certificate
                $creator = $this->ion_auth->user()->row();
                $created_by = trim($creator->first_name).' ('.$creator->username.')';

                // fill audit fields on insert; never editable in the form
                $crud->callback_before_insert(function($post_array) use ($created_by){
                    $post_array['created_by'] = $created_by;
                    $post_array['created_at'] = date('Y-m-d H:i:s');
                    return $post_array;
                });
                // hide from the add/edit forms but keep them in the insert
                $crud->field_type('created_by','invisible');
                $crud->field_type('created_at','invisible');

                if($this->ion_auth->user()->row()->can_manage == 'tartus'){
                    $crud->where('city', 'tartus');
                }else if($this->ion_auth->user()->row()->can_manage == 'lattakia'){
                    $crud->where('city', 'lattakia');
                }else if($this->ion_auth->user()->row()->can_manage == 'none'){
                    $crud->where('city', 'none');
                }

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                }

                if(!$this->ion_auth->in_group('mc_add') && !$this->ion_auth->is_admin()) {
                    $crud->unset_add();
                    $crud->unset_back_to_list();
                }

                if(!$this->ion_auth->in_group('mc_edit') && !$this->ion_auth->is_admin()) {
                    $crud->unset_edit();
                }

                if(!$this->ion_auth->in_group('mc_delete') && !$this->ion_auth->is_admin()) {
                    $crud->unset_delete();
                }

                $crud->display_as('certificate_no','Certificate No.');
                $crud->display_as('full_name','Seafarer\'s Name');
                $crud->display_as('date_of_birth','Date of Birth');
                $crud->display_as('nationality','Nationality');
                $crud->display_as('gender','Gender');
                $crud->display_as('date_of_issue','Date of issue');
                $crud->display_as('date_of_expiry','Date of Expiry');
                $crud->display_as('limitations','Limitations');
                $crud->display_as('city','City');
                $crud->display_as('created_by','Created By');
                $crud->display_as('created_at','Created On');

                if($this->ion_auth->user()->row()->can_manage == 'tartus'){
                    $crud->field_type('city','dropdown',
                    array('Tartus' => 'Tartus'));
                }else if($this->ion_auth->user()->row()->can_manage == 'lattakia'){
                    $crud->field_type('city','dropdown',
                    array('Lattakia' => 'Lattakia'));
                }else if($this->ion_auth->user()->row()->can_manage == 'none'){
                    $crud->field_type('city','dropdown',
                                    array());
                }else if($this->ion_auth->user()->row()->can_manage == 'both'){
                  $crud->field_type('city','dropdown',
                  array('Lattakia' => 'Lattakia',
                  'Tartus' => 'Tartus'));
                }


                $crud->field_type('gender','dropdown',
                array('Male' => 'Male',
                'Female' => 'Female' ));

                $crud->required_fields('certificate_no', 'full_name', 'date_of_birth', 'date_of_issue', 'date_of_expiry', 'city');
$crud->unique_fields(array('certificate_no'));

                $crud->columns('certificate_no','full_name', 'date_of_issue', 'date_of_expiry', 'created_by', 'created_at');

    			$output = $crud->render();

    			$this->__display($output, 'Medical Certificate Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function notes()
	{

        if($this->ion_auth->logged_in()
        && $this->ion_auth->is_admin()){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('note');
    			$crud->set_subject('Note');

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                    //$crud->unset_add();
                }

                $crud->required_fields('title','title_en','content','content_en');


                $crud->columns('alias','title','title_en');
                $crud->edit_fields('title','title_en','content','content_en');
                $crud->field_type('content','text');
                $crud->field_type('content_en','text');

    			$output = $crud->render();

    			$this->__display($output, 'Notes Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function users()
	{

        if($this->ion_auth->logged_in()
        && $this->ion_auth->is_admin()){

    	  	try{

                $crud = new grocery_CRUD();

    			$crud->set_table('users');
    			$crud->set_subject('User');
                $crud->where('is_admin', '0');
                $crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');

                if($this->ion_auth->user()->row()->is_admin != '1'){
                    $crud->unset_read();
                }

                $crud->display_as('first_name','Name');
                $crud->display_as('username','Username');
                $crud->display_as('password','Password');
                $crud->display_as('groups','Groups');
                $crud->display_as('email','Email');
                $crud->display_as('created_on','Created On');
                $crud->display_as('last_login','Last Login');
                $crud->required_fields('first_name','email','username','password', 'admin_role');


                $crud->columns('first_name','username','groups','created_on', 'last_login');
                $crud->fields('first_name','email','username','password', 'admin_role', 'can_manage','groups_coc', 'groups_cop', 'groups_endo', 'groups_mc');
                $crud->field_type('password','password');
                $crud->field_type('can_manage','dropdown',
                array('lattakia' => 'Lattakia', 'tartus' => 'Tartus', 'both' => 'Both', 'none' => 'None'));
                $crud->field_type('groups_coc','multiselect',
                array('3' => 'Add COC', '4' => 'Edit COC', '5' => 'Delete COC'));
                $crud->field_type('groups_cop','multiselect',
                array('6' => 'Add COP', '7' => 'Edit COP', '8' => 'Delete COP'));
                $crud->field_type('groups_endo','multiselect',
                array('9' => 'Add Endorsement', '10' => 'Edit Endorsement', '11' => 'Delete Endorsement'));
                $crud->field_type('groups_mc','multiselect',
                array('12' => 'Add Medical Cert', '13' => 'Edit Medical Cert', '14' => 'Delete Medical Cert'));

                $crud->field_type('admin_role','dropdown',
                array('1' => 'YES', '0' => 'NO'));

                $crud->callback_column('created_on',array($this,'view_date_column_callback'));
                $crud->callback_column('last_login',array($this,'view_date_column_callback'));
                $crud->callback_edit_field('password',array($this,'password_edit_field_callback'));
                $crud->callback_edit_field('groups_coc',array($this,'coc_edit_field_callback'));
                $crud->callback_edit_field('groups_cop',array($this,'cop_edit_field_callback'));
                $crud->callback_edit_field('groups_endo',array($this,'endo_edit_field_callback'));
                $crud->callback_edit_field('groups_mc',array($this,'mc_edit_field_callback'));
                $crud->callback_edit_field('admin_role',array($this,'admin_role_edit_field_callback'));
                $crud->callback_insert(array($this,'insert_user_callback'));
                $crud->callback_update(array($this,'update_user_callback'));
                $crud->callback_delete(array($this,'delete_user_callback'));

    			$output = $crud->render();

    			$this->__display($output, 'Users Management', 'admin');

            }catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}
        }else{
            $this->session->set_flashdata('message', 'You are not loggind in or You do not the right permission');
		    redirect("admin/index");
        }
	}

    public function insert_user_callback($post_array){

      if($post_array['admin_role'] == 1){
        $admin_roles = array('1');
      }else{
        $admin_roles = array();
      }
      return $this->ion_auth->register($post_array['username'], $post_array['password'], $post_array['email'], array('first_name' => $post_array['first_name'], 'is_admin' => '0', 'can_manage' => $post_array['can_manage']), array_merge($post_array['groups_coc'], $post_array['groups_cop'], $post_array['groups_endo'], $post_array['groups_mc'], $admin_roles));
    }

    public function update_user_callback($post_array, $primary_key){

        $data = array('first_name' => $post_array['first_name'],
                      'username' => $post_array['username'],
                      'email' => $post_array['email'],
                      'can_manage' => $post_array['can_manage']
                      );
        if(trim($post_array['password']) != 'security')
            $data['password'] = trim($post_array['password']);

        $this->ion_auth->update($primary_key, $data);

        $user_groups = $this->ion_auth->get_users_groups($primary_key)->result();

        foreach ($user_groups as $user_group)
		{
				$this->ion_auth->remove_from_group($user_group->id, $primary_key);
		}

        if (!empty($post_array['groups_coc']))
		{
			foreach ($post_array['groups_coc'] as $group)
			{
				$this->ion_auth->add_to_group($group, $primary_key);
			}
		}

        if (!empty($post_array['groups_cop']))
		{
			foreach ($post_array['groups_cop'] as $group)
			{
				$this->ion_auth->add_to_group($group, $primary_key);
			}
		}

        if (!empty($post_array['groups_endo']))
		{
			foreach ($post_array['groups_endo'] as $group)
			{
				$this->ion_auth->add_to_group($group, $primary_key);
			}
		}

        if (!empty($post_array['groups_mc']))
		{
			foreach ($post_array['groups_mc'] as $group)
			{
				$this->ion_auth->add_to_group($group, $primary_key);
			}
		}

        if (!empty($post_array['admin_role']))
		{
		    $this->ion_auth->add_to_group($post_array['admin_role'], $primary_key);
		}

    }

    function delete_user_callback($primary_key){

        return $this->ion_auth->delete_user($primary_key);

    }

    function password_edit_field_callback($value, $primary_key)
    {
        return '<input class="form-control" type="password" value="security" name="password" style="">';
    }

    function admin_role_edit_field_callback($value, $primary_key)
    {
        $groups = $this->ion_auth->get_users_groups($primary_key)->result();
        $value = 0;
        foreach($groups as $group){
            if($group->id == 1){
                 $value = 1;
            }
        }

        $select_title = 'Admin Role';

		$input = "<select id='field-admin_role' name='admin_role' class='chosen-select' data-placeholder='".$select_title."'>";
		$options = array('' => '', '1' => 'YES', '0' => 'NO');

		foreach($options as $option_value => $option_label)
		{
			$selected = !empty($value) && $value == $option_value ? "selected='selected'" : '';
			$input .= "<option value='$option_value' $selected >$option_label</option>";
		}

		$input .= "</select>";

        return $input;

    }

    function coc_edit_field_callback($value, $primary_key)
    {
        $groups = $this->ion_auth->get_users_groups($primary_key)->result();
        $groups_string = '';
        $add_comma = 0;
        foreach($groups as $group){
             if(!$add_comma){
               $groups_string .= $group->id;
               $add_comma = 1;
             }else{
                $groups_string .= ','.$group->id;
             }

        }

        $options_array = array('3' => 'Add COC', '4' => 'Edit COC', '5' => 'Delete COC');
		$selected_values 	= !empty($groups_string) ? explode(',',$groups_string) : array();

		$select_title = 'Groups COC';
		$input = "<select id='field-groups_coc' name='groups_coc[]' multiple='multiple' size='8' class='chosen-multiple-select' data-placeholder='Groups COC' style='width:510px;' >";

		foreach($options_array as $option_value => $option_label)
		{
			$selected = !empty($groups) && in_array($option_value,$selected_values) ? "selected='selected'" : '';
			$input .= "<option value='$option_value' $selected >$option_label</option>";
		}

		$input .= "</select>";

		return $input;
    }

    function cop_edit_field_callback($value, $primary_key)
    {
        $groups = $this->ion_auth->get_users_groups($primary_key)->result();
        $groups_string = '';
        $add_comma = 0;
        foreach($groups as $group){
             if(!$add_comma){
               $groups_string .= $group->id;
               $add_comma = 1;
             }else{
                $groups_string .= ','.$group->id;
             }

        }

        $options_array = array('6' => 'Add COP', '7' => 'Edit COP', '8' => 'Delete COP');
		$selected_values 	= !empty($groups_string) ? explode(',',$groups_string) : array();

		$select_title = 'Groups COP';
		$input = "<select id='field-groups_cop' name='groups_cop[]' multiple='multiple' size='8' class='chosen-multiple-select' data-placeholder='Groups COP' style='width:510px;' >";

		foreach($options_array as $option_value => $option_label)
		{
			$selected = !empty($groups) && in_array($option_value,$selected_values) ? "selected='selected'" : '';
			$input .= "<option value='$option_value' $selected >$option_label</option>";
		}

		$input .= "</select>";

		return $input;
    }

    function endo_edit_field_callback($value, $primary_key)
    {
        $groups = $this->ion_auth->get_users_groups($primary_key)->result();
        $groups_string = '';
        $add_comma = 0;
        foreach($groups as $group){
             if(!$add_comma){
               $groups_string .= $group->id;
               $add_comma = 1;
             }else{
                $groups_string .= ','.$group->id;
             }

        }

        $options_array = array('9' => 'Add Endorsement', '10' => 'Edit Endorsement', '11' => 'Delete Endorsement');
		$selected_values 	= !empty($groups_string) ? explode(',',$groups_string) : array();

		$select_title = 'Groups Endo';
		$input = "<select id='field-groups_endo' name='groups_endo[]' multiple='multiple' size='8' class='chosen-multiple-select' data-placeholder='Groups Endo' style='width:510px;' >";

		foreach($options_array as $option_value => $option_label)
		{
			$selected = !empty($groups) && in_array($option_value,$selected_values) ? "selected='selected'" : '';
			$input .= "<option value='$option_value' $selected >$option_label</option>";
		}

		$input .= "</select>";

		return $input;
    }

    function mc_edit_field_callback($value, $primary_key)
    {
        $groups = $this->ion_auth->get_users_groups($primary_key)->result();
        $groups_string = '';
        $add_comma = 0;
        foreach($groups as $group){
             if(!$add_comma){
               $groups_string .= $group->id;
               $add_comma = 1;
             }else{
                $groups_string .= ','.$group->id;
             }

        }

        $options_array = array('12' => 'Add Medical Cert', '13' => 'Edit Medical Cert', '14' => 'Delete Medical Cert');
		$selected_values 	= !empty($groups_string) ? explode(',',$groups_string) : array();

		$select_title = 'Groups MC';
		$input = "<select id='field-groups_mc' name='groups_mc[]' multiple='multiple' size='8' class='chosen-multiple-select' data-placeholder='Groups MC' style='width:510px;' >";

		foreach($options_array as $option_value => $option_label)
		{
			$selected = !empty($groups) && in_array($option_value,$selected_values) ? "selected='selected'" : '';
			$input .= "<option value='$option_value' $selected >$option_label</option>";
		}

		$input .= "</select>";

		return $input;
    }

    public function view_date_column_callback($value, $row) {
      return date("Y-m-d H:i:s", $value);
    }

    public function login(){
		//validate form input
		$this->form_validation->set_rules('username', "Username", 'required');
		$this->form_validation->set_rules('password', "Password", 'required');

        $data = new stdClass;

        $data->css_files = array();
        $data->js_files = array();

		if ($this->form_validation->run() == true)
		{

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), FALSE))
			{

				$this->session->set_flashdata('message', $this->ion_auth->messages());

                redirect('admin/index', 'refresh');

			}
			else
			{

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('admin/login', 'refresh');
			}
		}
		else
		{

			$data->message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data->username = array('name' => 'username',
				'id'    => 'username',
				'type'  => 'text',
                'class' => 'form-control',
                'placeholder' => 'User ID',
				'value' => $this->form_validation->set_value('username'),
			);
		    $data->password = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password'
			);

			$this->__display($data, '', 'login');
		}
    }

    public function logout()
	{
	  	try{
            $this->ion_auth->logout();
            redirect('admin/login', 'refresh');
        }catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

}