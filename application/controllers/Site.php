<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		$this->load->database();

        $language = $this->input->get('lang');

        if(in_array($language, array('english', 'arabic'))){
           $this->session->set_userdata('lang', $language);
           $this->lang->load("main",$language);
        }else{
            $this->lang->load("main", $this->session->userdata('lang'));
        }

        if($this->session->userdata('lang') == ''){
            $this->session->set_userdata('lang', 'english');
        }

	}

    public function __display($output = null, $title = "Index", $view = "index")
	{
	  if($this->session->userdata('lang') == 'arabic'){
          $output->lang = 'english';
          $output->lang_text = $this->lang->line("ENGLISH");
          $output->lang_css = 'pull-left';
	  }elseif($this->session->userdata('lang') == 'english'){
          $output->lang = 'arabic';
          $output->lang_text = $this->lang->line("ARABIC");
          $output->lang_css = 'pull-right';
	  }
	  $output->ion_auth = $this->ion_auth;
      $output->page_title = $title;
      $output->page_class = str_replace(' ','_',strtolower($title));
      $output->curr_lang = $this->session->userdata('lang');

      $this->load->view('site/include/header.php',(array)$output);
      $this->load->view('site/'.$view.'.php',(array)$output);
      $this->load->view('site/include/footer.php',(array)$output);

	}

	public function index()
	{
		$data = new stdClass;
        $data->note = $this->Site_model->getNoteByAlias('index');

		$this->__display($data, $this->lang->line('HOME'));
	}

    public function coc_search(){

        $data = new stdClass;
        $data->action = 'coc';
        $data->note = $this->Site_model->getNoteByAlias($data->action);

        $this->form_validation->set_rules('keyword', "keyword", 'required');

        //$this->load->library('recaptcha');
        //$data->widget = $this->recaptcha->getWidget();
        //$data->script = $this->recaptcha->getScriptTag();


        if ($this->form_validation->run() == true)
	    {
	        
	        $results = $this->Site_model->coc_search($this->input->post('keyword', TRUE));

            $data->certs = $results;
/*
            $recaptcha = $this->input->post('g-recaptcha-response');
            if (!empty($recaptcha)) {
                $response = $this->recaptcha->verifyResponse($recaptcha);
                if (isset($response['success']) and $response['success'] === true) {

                    $results = $this->Site_model->coc_search($this->input->post('keyword', TRUE));

                    $data->certs = $results;
                }else{
                    $data->message = "Captcha Wrong!!";
                }
            }else{
                $data->message = "Captcha Wrong!!";
            }
*/
        }else{
            $data->message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->__display($data, $this->lang->line('COC_TITLE'), 'search');

    }

    public function cop_main(){

        $data = new stdClass;
        $action = 'cop';
        $data->note = $this->Site_model->getNoteByAlias($action);

        $this->__display($data, $this->lang->line('COP_TITLE'), 'cop');

    }

    public function cop_approved(){

        $data = new stdClass;
        $action = 'cop2';
        $data->note = $this->Site_model->getNoteByAlias($action);

        $this->__display($data, $this->lang->line('COP_TITLE'), 'cop_approved');

    }

    public function cop_search(){

        $data = new stdClass;
        $data->action = 'cop';
        $data->note = $this->Site_model->getNoteByAlias('cop1');

        $this->form_validation->set_rules('keyword', "keyword", 'required');

        //$this->load->library('recaptcha');
        //$data->widget = $this->recaptcha->getWidget();
        //$data->script = $this->recaptcha->getScriptTag();

        if ($this->form_validation->run() == true)
		{
		    $results = $this->Site_model->cop_search($this->input->post('keyword', TRUE));

            $data->certs = $results;
/*
		    $recaptcha = $this->input->post('g-recaptcha-response');
		    if (!empty($recaptcha)) {
                $response = $this->recaptcha->verifyResponse($recaptcha);
                if (isset($response['success']) and $response['success'] === true) {

                    $results = $this->Site_model->cop_search($this->input->post('keyword', TRUE));

                    $data->certs = $results;
                }else{
                    $data->message = "Captcha Wrong!!";
                }
            }else{
                $data->message = "Captcha Wrong!!";
            }
*/
        }else{
            $data->message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->__display($data, $this->lang->line('COP_TITLE'), 'search');

    }

    public function endo_search(){

        $data = new stdClass;
        $data->action = 'endo';
        $data->note = $this->Site_model->getNoteByAlias($data->action);

        $this->form_validation->set_rules('keyword', "keyword", 'required');

        //$this->load->library('recaptcha');
        //$data->widget = $this->recaptcha->getWidget();
        //$data->script = $this->recaptcha->getScriptTag();

        if ($this->form_validation->run() == true)
		{
		    $results = $this->Site_model->endo_search($this->input->post('keyword', TRUE));

            $data->certs = $results;
/*
		    $recaptcha = $this->input->post('g-recaptcha-response');
		    if (!empty($recaptcha)) {
                $response = $this->recaptcha->verifyResponse($recaptcha);
                if (isset($response['success']) and $response['success'] === true) {

                    $results = $this->Site_model->endo_search($this->input->post('keyword', TRUE));

                    $data->certs = $results;
                }else{
                    $data->message = "Captcha Wrong!!";
                }
            }else{
                $data->message = "Captcha Wrong!!";
            }
*/
        }else{
            $data->message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }
        $this->__display($data, $this->lang->line('ENDO_TITLE'), 'search');

    }

    public function mc_search(){

        $data = new stdClass;
        $data->action = 'mc';
        $data->note = $this->Site_model->getNoteByAlias($data->action);

        $this->form_validation->set_rules('keyword', "keyword", 'required');

        //$this->load->library('recaptcha');
        //$data->widget = $this->recaptcha->getWidget();
        //$data->script = $this->recaptcha->getScriptTag();

        if ($this->form_validation->run() == true)
		{
		    $results = $this->Site_model->mc_search($this->input->post('keyword', TRUE));

            $data->certs = $results;
/*
            $recaptcha = $this->input->post('g-recaptcha-response');
            if (!empty($recaptcha)) {
                $response = $this->recaptcha->verifyResponse($recaptcha);
                if (isset($response['success']) and $response['success'] === true) {

                    $results = $this->Site_model->mc_search($this->input->post('keyword', TRUE));

                    $data->certs = $results;
                }else{
                    $data->message = "Captcha Wrong!!";
                }
            }else{
                $data->message = "Captcha Wrong!!";
            }
*/
        }else{
            $data->message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        }

        $this->__display($data, $this->lang->line('MC_TITLE'), 'search');

    }

    public function view(){

        $action = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $action_call = $action.'_get';
        $cert = $this->Site_model->$action_call($id);

        $data = new stdClass;
        $data->model = $cert;
        $data->note = $this->Site_model->getNoteByAlias($action);
        $data->action = $action;

        $this->__display($data, $this->lang->line('VIEW_CERT_TITLE'), 'view');

    }

}
