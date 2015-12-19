<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property mixed sitemodel
 */
class Inscription extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->view_folder = strtolower(__CLASS__) . '/';

    }




    public function index()
    {

        if ($this->sitemodel->is_logged()) {
            redirect('user');
            exit;
        }

        //$this->form_validation->set_rules('civilite','civilite', 'trim');
        //$this->form_validation->set_rules('lastname','lastname', 'trim|required|min_length[3]|xss_clean');
        //$this->form_validation->set_rules('firstname','firstname', 'trim|required|min_length[3]|xss_clean');
        //$this->form_validation->set_rules('email','email', 'trim|required|valid_email');
        $this->form_validation->set_rules('jours', 'jours', 'trim|required');
        $this->form_validation->set_rules('ville', 'ville', 'trim|required');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|integer');
        $this->form_validation->set_rules('heure', 'heure', 'trim|required|integer');


        if ($this->form_validation->run() == TRUE) {
            $this->load->model('site_model');
            $data = array(
                'civilite' => $this->input->post('civilite'),
                'lastname' => $this->input->post('lastname'),
                'firstname' => $this->input->post('firstname'),
                'email' => $this->input->post('jours'),
                'ville' => $this->input->post('ville'),
                'phone' => $this->input->post('phone'),
                'heure' => $this->input->post('heure'),

            );
            $this->site_model->add($data);
            $this->load->view('succes');
        }


        $this->load->view('template/content');

    }


}

?>
