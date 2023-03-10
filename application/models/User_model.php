<?php

class User_model extends MY_Model  //extend MY_model from CI_model in core
{
    var $table = 'users';

    public function __construct() 
    {
    	parent::__construct();
    }

    public function getProfile($id='') //get all data from user table
    {

    $session_data=$this->session->userdata('userDetails');
                            
        $this->db->from($this->table);
      if ($id != '')
        $this->db->where('id', $id);
        $this->db->where('status',1);
        $this->db->order_by('id', "desc");
        $query = $this->db->get();
        return $query->result_array();

    }

    public function insertUser($value)  //add new user
    {
    	$this->db->insert($this->table, $value);
    }
 
    public function changePasswordDet($password, $userId) //change password
    {
    	$data = array('password' => $password);
    	$this->db->where('id', $userId);
    	$this->db->update($this->table, $data);
    }

  
    public function delete($id) //delete table(update status to '0')
    {
    	$this->db->where('id',$id);
    	$this->db->update($this->table,array('status' => 0));
        return true;
    }

    function key_exists($key) //chech whether email already exist in user table 
    {
        $this->db->where('email',$key);
        $query = $this->db->get($this->table);
    
      if ($query->num_rows() == 0)
      {
        return true;
      }
      else
      {
        return false;
      }
    }

} ?>
