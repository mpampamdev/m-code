<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */
class Permission_model extends MY_Model{



  private $table        = "auth_permission";
  private $primary_key  = "id";
  private $column_order = array("auth_permission.id","auth_permission.permission");
  private $order        = array('auth_permission.id'=>"DESC");
  private $select       = " auth_permission.id,
                            auth_permission.permission,
                            auth_permission.definition";

public function __construct()
	{
		$config = array(
      'table' 	      => $this->table,
			'primary_key' 	=> $this->primary_key,
		 	'select' 	      => $this->select,
      'column_order' 	=> $this->column_order,
      'order' 	      => $this->order,
		 );

		parent::__construct($config);
	}


  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);
      if ($this->input->post("permission")) {
        $this->db->like("auth_permission.permission", $this->input->post("permission"));
      }

      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);
      return $this->db->count_all_results();
    }


}
