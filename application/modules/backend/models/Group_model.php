<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* dev : mpampam*/
/* fb : https://facebook.com/mpampam*/
/* fanspage : https://web.facebook.com/programmerjalanan*/
/* web : www.mpampam.com*/
/* Generate By M-CRUD Generator 10/11/2020 14:51*/
/* Please DO NOT modify this information */
class Group_model extends MY_Model{



  private $table        = "auth_group";
  private $primary_key  = "id";
  private $column_order = array();
  private $order        = array('auth_group.id'=>"DESC");
  private $select       = " auth_group.id,
                            auth_group.group,
                            auth_group.definition";

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
      $this->db->from("auth_group");
      $this->db->where("auth_group.id !=", 1);



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
      $this->db->from("auth_group");
      $this->db->where("auth_group.id !=", 1);
      return $this->db->count_all_results();
    }


    function list_control_access($group_id = '')
    {
      $str = '';
      $checked = "";
      $group_perms_groupping = [];

      $group_perms = $this->get_permission_to_group($group_id);

      foreach ($this->get_data("auth_permission")->result() as $perms) {
        $group_name = 'null';
        $perm_tmp_arr = explode('_', $perms->permission);

        if (isset($perm_tmp_arr[0]) AND !empty($perm_tmp_arr[0])) {
            $group_name =  strtolower($perm_tmp_arr[0]);
        }
        $group_perms_groupping[$group_name][] = $perms;
      }

      foreach ($group_perms_groupping as $group_name => $childs) {

        $str .='<div class="card text-white">
                  <div class="card-header bg-primary group-name">
                  <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                      '.ucwords($group_name).'
                    </div>
                  <div class="card-body">
                    <ul>';
          foreach ($childs as $perms) {

            $checked = array_search($perms->id, $group_perms) ? "checked" : "";

            $str.='<li>
                      <div class="form-check form-check-primary form-check-no-margin">
                        <label class="form-check-label text-primary">
                          <input type="checkbox" class="form-check-input '.$group_name.'" name="id[]" value="'.$perms->id.'" '.$checked.'>
                          '.ucwords(str_replace("_"," ",$perms->permission)).'
                          <i class="input-helper"></i>
                          <a href="'.url('group/deletepermission/'.$perms->id).'" id="delete_permission" class="float-right"><i class="fa fa-trash text-danger"></i></a>
                        </label>
                      </div>
                    </li>';
          }


            $str.='</ul>
              </div>
            </div>';

      }

    return $str;

    }

    function get_permission_to_group($group_id = '')
    {
      $result_perm_group[] = 0;

    		$query = $this->get_data('auth_permission_to_group', ['group_id' => $group_id]);

    		foreach ($query->result() as $row) {
    			$result_perm_group[] = $row->permission_id;
    		}

    		return $result_perm_group;
    }

}
