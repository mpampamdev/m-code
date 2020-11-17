<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 08/11/2020 00:31*/
/* Location: ./application/modules/backend/models/Filemanager_model.php*/
/* Please DO NOT modify this information */

class Filemanager_model extends MY_Model{

  private $table        = "filemanager";
  private $primary_key  = "id";
  private $column_order = [];
  private $order        = ["id"=>"DESC"];
  private $select       = "id,file_name,ket,created";

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

      //filter
			if($this->input->post('file_name')){
				$this->db->like('file_name', $this->input->post('file_name'));
			}

      if($this->input->post('ket')){
				$this->db->like('ket', $this->input->post('ket'));
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
