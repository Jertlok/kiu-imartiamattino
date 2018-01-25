<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 19/01/2018
 * Time: 13:04
 */

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session'); // library for php session
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->helper('url'); // url helper for the view
    }


    /**
     * This function (which gets called by default) load the login view (where the user inserts his credential)
     */
    public function index($status = 1) {
        $data['status'] = $status;
        $this->load->view('login/login', $data);
    }

    /**
     * This function is used to allow the user to login, also this grants session data to be stored:
     * - username:string
     * - user_id:int
     * - role:enum('amm', 'propr', 'vend')
     * - logged_in:bool
     */
    public function signin() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === false) {
            $this->load->view('/login/login');
        }

        else {
            /* Now we need to check if username/password combination is correct
            and then get the role so we can send the user to the relative page */

            // set variables from the form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($this->login_model->resolve_user_login($username, $password)) { // password correctly validated
                // get user data, basically its role and id
                $user_data = $this->login_model->get_user_data($username);

                // setting user session
                $session_data = array(
                    'username' => $username,
                    'user_id' => $user_data['user_id'],
                    'role' => $user_data['role'],
                    'logged_in' => true
                );

                $this->session->set_userdata($session_data);

                // possibile code reuse: sending the user to the main controller which will then redirect him to his relative page
                redirect('main');
            }

            else {
                redirect('login/index/-1');
            }


        }
    }


    /**
     * Function that unsets the user session resulting in user logout
     */
    public function logout() {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            // unset each session key
            foreach($_SESSION as $key => $value)
                unset($_SESSION[$key]);

            redirect('main'); // redirecting the user to the main controller

        }
    }
}