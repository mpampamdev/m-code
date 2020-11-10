<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model{
  private $table = 'table';
  private $primary_key = 'id';
  private $column_order = array();
  private $order        = array();
  private $select       = "";

  public function __construct($config = array())
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    foreach ($config as $key => $val) {
      if(isset($this->$key))
                $this->$key = $val;
    }
  }

  function get_data($table, $where =array())
  {
    if (is_array($where) AND count($where)) {
          $this->db->where($where);
        }
    return $this->db->get($table);
  }

    public function remove($id = NULL)
    {
        $this->db->where($this->primary_key, $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    function remove_table_where($table,$where)
    {
      $this->db->where($where);
      $this->db->delete($table);
      return $this->db->affected_rows();
    }

    public function change($id = NULL, $data = array())
    {
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows();
    }

    public function find($id = NULL, $select_field = [])
    {
        if (is_array($select_field) AND count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where("".$this->table.'.'.$this->primary_key,$id);
        $query = $this->db->get($this->table);

        if($query->num_rows()>0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function find_all()
    {
        $this->db->order_by($this->primary_key, 'DESC');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function insert($data = array())
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_all_data($table = '')
    {
        $query = $this->db->get($table);

        return $query->result();
    }


    public function get_single($where)
    {
        $query = $this->db->get_where($this->table, $where);

        return $query->row();
    }

    public function scurity($input)
    {
        return mysqli_real_escape_string($this->db->conn_id, $input);
    }

    public function generate_url($field, $text = null, $except = null)
    {
        $url = url_title($text);
        if ($except) {
            $this->db->where($this->primary_key." != ".$except);
        }
        $this->db->order_by($this->primary_key, 'DESC');
        $data = $this->db->get_where($this->table, [$field => $url])->row();

        if ($data) {
            return $url.($data->id+=1);
        }

        return $url;
    }


  function get_query($query)
    {
      return $this->db->query($query);
    }

    function get_where($table,$where)
    {
      return $this->db->get_where($table,$where)
                      ->row();
    }

    function get_insert($table,$data)
    {
      return $this->db->insert($table,$data);
    }


    function get_update($table,$data,$where)
    {
      return $this->db->where($where)
                      ->update($table,$data);
    }

    function get_delete($table,$where)
    {
      $this->db->where($where);
      return $this->db->delete($table);
    }


} //end class model
