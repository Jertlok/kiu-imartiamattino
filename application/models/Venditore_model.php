<?php
/**
 * Created by PhpStorm.
 * User: angel
 * Date: 19/01/2018
 * Time: 15:31
 */

class Venditore_model extends CI_Model
{

    //costruttore
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function aggiungi_proprietario ()
    {
        $status = false;

        /*
        $proprietario = array(
            'cognome' => $this->input->post('cognome'),
            'nome' => $this->input->post('nome'),
        );
        */

        $this->db->set('Cognome', $this->input->post('cognome'));
        $this->db->set('Nome', $this->input->post('nome'));
        $this->db->set('VenditoreID', (int) $this->session->user_id);
        $this->db->insert('Proprietario');

        $id_proprietario = $this->db->insert_id();

        $query = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'id' => $id_proprietario
        );

        $this->db->set('Username', $query['username']);
        $this->db->set('Password', password_hash($query['password'],PASSWORD_DEFAULT));
        $this->db->set('Ruolo', 'propr');
        $this->db->set('ProprietarioID', $query['id']);
        $this->db->insert('Account');

        /*
        $this->db->insert('Proprietario', array (
            'Nome' => $proprietario['nome'],
            'Cognome' => $proprietario['cognome'],
            'VenditoreID' => (int) $this->session->user_id
        ));
        */

        if ($this->db->set('Proprietario')=== true )
            $status = true;

        return $status;

    }

    public function rimuovi_proprietario ($id)
    {
        //$status = false;
        $this->db->where('ID', $id);
        $this->db->delete('Proprietario');

        return '1';
    }

    public function get_proprietari()
    {
        $this->db->select('Proprietario.Nome, Proprietario.Cognome, Proprietario.ID');
        $this->db->from('Proprietario');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_summary() {
        $this->db->where('VenditoreID', $this->session->user_id);
        $query['n_proprietari']= $this->db->count_all_results('Proprietario');
        return $query;
    }

}