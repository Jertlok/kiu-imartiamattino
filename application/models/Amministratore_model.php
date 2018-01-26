<?php
/**
 * Created by PhpStorm.
 * User: Jertlok
 * Date: 20/01/2018
 * Time: 11:01
 */

class Amministratore_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * This creates a new record of 'Impianto' and its relative 'Sensori'
     */
    public function set_impianto() {
        $impianto = array(
            'nome_impianto' => $this->input->post('impianto'),
            'username_proprietario' => $this->input->post('proprietario'),
        );

        // starting transaction: inserting impianto
        $this->db->trans_start();
        $this->db->insert('Impianto', array(
            'Nome' => $impianto['nome_impianto'],
            'ProprietarioID' => $this->input->post('proprietario'),
            'AmministratoreImpiantiID' => (int)$this->session->user_id
        ));

        $id_impianto = $this->db->insert_id();

        // for each sensor make an insert

        foreach($this->input->post('sensore') as $sensore) {
            $this->db->set('Tipo', $sensore['tipo_sensore']);
            $this->db->set('Marca', $sensore['marca_sensore']);
            $this->db->set('ImpiantoID', $id_impianto);
            $this->db->insert('Sensore');
        }

        // transaction complete
        $this->db->trans_complete();

        if ($this->db->trans_status() === false)
        {
            echo 'error!';
        }
    }


    /**
     * Retrieve all the 'Impianto'(s)
     * @return mixed array containing all the 'Impianto'(s)
     */

    //select Impianto.Nome as 'Nome impianto', Proprietario.Nome as 'Assegnato a', AmministratoreImpianti.Nome 'Inserito da'
    // from Impianto JOIN Proprietario ON Impianto.ProprietarioID = Proprietario.ID JOIN AmministratoreImpianti ON Impianto.AmministratoreImpiantiID
    public function get_impianti() {
        $this->db->select('Impianto.ID, Impianto.Nome as nome_imp, Proprietario.Nome as nome_prop, AmministratoreImpianti.Nome as nome_amm');
        $this->db->from('Impianto');
        $this->db->join('Proprietario', 'Impianto.ProprietarioID = Proprietario.ID');
        $this->db->join('AmministratoreImpianti', 'Impianto.AmministratoreImpiantiID = AmministratoreImpianti.ID');
        $query = $this->db->get();

        return $query->result_array();
    }

    // --- HELPER SECTION
    /**
     * Get id by username
     * @param $username
     * @return int user id
     */
    public function get_proprietario_id($username) {
        $query = $this->db->get_where('Account', array('Username' => $username));

        // locally store the user
        $user = $query->row_array();

        if($user['Ruolo'] === 'propr') {
            $user_id = $user['ProprietarioID'];
        }

        return $user_id;
    }

    public function remove_impianto($id) {
        $status = false;
        $this->db->where('ID', $id);
        $this->db->delete('Impianto');

        if($this->db->affected_rows() > 0)
            $status = true;

        return $status;
    }


    public function remove_sensore($id) {
        $status = false;
        $this->db->where('ID', $id);
        $this->db->delete('Sensore');

        if($this->db->affected_rows() > 0)
            $status = true;

        return $status;
    }

    /**
     * @return bool query status
     */
    public function update_sensore() {
        $status = false;

        $this->db->set('Tipo', $this->input->post('Tipo'));
        $this->db->set('Marca', $this->input->post('Marca'));
        $this->db->where('ID', $this->input->post('id_sensore'));
        if($this->db->update('Sensore') === true)
            $status = true;

        return $status;
    }


    public function update_nome_impianto() {
        $status = false;
        $this->db->set('Nome', $this->input->post('impianto'));
        $this->db->where('ID', $this->input->post('id_impianto'));
        if($this->db->update('Impianto')=== true)
            $status = true;

        return $status;
    }


    public function get_sensore($id) {
        $this->db->select('ID, Tipo, Marca');
        $this->db->from('Sensore');
        $this->db->where('ID', $id);
        $query = $this->db->get()->row_array();

        return $query;
    }

    public function get_impianto($id) {
        $this->db->select('Nome, ID');
        $this->db->from('Impianto');
        $this->db->where('ID', $id);
        $query['impianto'] = $this->db->get()->row_array();

        // collecting all the sensors
        $this->db->select('ID, Tipo, Marca');
        $this->db->from('Sensore');
        $this->db->where('ImpiantoID', $id);
        $query['sensori'] = $this->db->get()->result_array();

        return $query;
    }

    public function add_sensors() {
        $id_impianto = $this->input->post('id_impianto');
        foreach($this->input->post('sensore') as $sensore) {
            $this->db->set('Tipo', $sensore['Tipo']);
            $this->db->set('Marca', $sensore['Marca']);
            $this->db->set('ImpiantoID', $id_impianto);
            $this->db->insert('Sensore');
        }
    }

    public function get_proprietari() {
        $this->db->select('Proprietario.ID as id_propr, Proprietario.Nome as nome, Account.Username as username');
        $this->db->from('Proprietario');
        $this->db->join('Account', 'Proprietario.ID = Account.ProprietarioID');
        $query = $this->db->get()->result_array();

        return $query;
    }

    public function get_eccezioni()
    {
        $this->db->select('*');
        $this->db->from('Rilevazione');
        $this->db->where('Messaggio', '####################');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function get_summary() {
        $this->db->where('AmministratoreImpiantiID', $this->session->user_id);
        $query['n_impianti']= $this->db->count_all_results('Impianto');

        $n_impianti = 'SELECT COUNT(*) as "n_sensori" FROM Sensore JOIN Impianto ON Sensore.ImpiantoID = Impianto.ID AND Impianto.AmministratoreImpiantiID = ?';
        $query['sensori'] = $this->db->query($n_impianti, array($this->session->user_id))->row_array();

        return $query;
    }

    public function salva_rilevazioni($stringa){

        define('IMPIANTO' , 45);
        $this->db->set('SensoreID', $stringa['idsens']);
        $this->db->set('Data', $stringa['data']);
        $this->db->set('Valore', $stringa['valore']);
        $this->db->set('Messaggio', $stringa['messaggio']);
        $this->db->set('ImpiantoID', IMPIANTO);
        $this->db->insert('Rilevazione');
    }
}