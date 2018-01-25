<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 19/01/2018
 * Time: 14:16
 */

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        /* logic for dispatching to login page or corrispective session (PHP session)
        page -> AmministratoreImpianti / Proprietario / Venditore */

        if($this->session->has_userdata('logged_in')) {
            // dispatch the user to its role
            if(isset($this->session->role)) {
                switch ($this->session->userdata('role')) {
                    case 'amm':
                        redirect('amministratore');
                        break;
                    case 'vend':
                        redirect('venditore');
                        break;
                    case 'propr':
                        redirect('proprietario');
                        break;
                }
            }
        }

        else
            redirect('/login'); // redirecting to login controller
    }
}