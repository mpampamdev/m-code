<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Location: ./application/modules/backend/models/Profile_model.php*/
/* Please DO NOT modify this information */

class Profile_model extends MY_Model{

  private $table        = "profile";
  private $primary_key  = "id";
  private $column_order = ["nama","email","telepon","alamat","foto","tanggal","tanggal_waktu"];
  private $order        = ["id"=>"DESC"];
  private $select       = "id,nama,email,telepon,alamat,foto,tanggal,tanggal_waktu";

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
			if($this->input->post('nama')){
				$this->db->where('nama', $this->input->post('nama'));
			}
			if($this->input->post('email')){
				$this->db->where('email', $this->input->post('email'));
			}
			if($this->input->post('telepon')){
				$this->db->where('telepon', $this->input->post('telepon'));
			}
			if($this->input->post('alamat')){
				$this->db->where('alamat', $this->input->post('alamat'));
			}
			if($this->input->post('foto')){
				$this->db->where('foto', $this->input->post('foto'));
			}
			if($this->input->post('tanggal')){
				$this->db->where('tanggal', $this->input->post('tanggal'));
			}
			if($this->input->post('tanggal_waktu')){
				$this->db->where('tanggal_waktu', $this->input->post('tanggal_waktu'));
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
