<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 19/01/2018
 * Time: 13:06
 */

class Login_model extends CI_Model
{

    function __construct() {
        $this->load->database();
    }

    // ToDo: create function for user retrieving, this function will return the relative user to Login controller

    /**
     * Note: the application will use bcrypt as of PHP 5.5+ default implementation
     * This function will check whether the password for the username is correct and then return an array
     * containing the identification id of the user
     *
     * @param $username
     * @param $password
     * @return bool isAuthorised
     */
    public function resolve_user_login($username, $password)
    {
        // retrieving the user
        $query = $this->db->get_where('Account', array('Username' => $username));

        // locally store the user
        $user = $query->row_array();

        return password_verify($password, $user['Password']);
    }

    /**
     * @param $username
     * @return mixed user role and id
     */
    public function get_user_data($username)
    {
        // retrieving the user
        $query = $this->db->get_where('Account', array('Username' => $username));

        // locally store the user
        $user = $query->row_array();

        $data = array();

        switch ($user['Ruolo']) {
            case 'amm':
                $data = array(
                    'user_id' => $user['AmministratoreImpiantiID'],
                    'role' => 'amm'
                );
                break;
            case 'vend':
                $data = array(
                    'user_id' => $user['VenditoreID'],
                    'role' => 'vend'
                );
                break;
            case 'propr':
                $data = array(
                    'user_id' => $user['ProprietarioID'],
                    'role' => 'propr'
                );
                break;
        }

        return $data;
    }
}