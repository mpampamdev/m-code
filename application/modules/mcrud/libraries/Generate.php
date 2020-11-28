<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Generate
{

  private $ci;
  private $table;

  function __construct()
  {
    $this->ci=& get_instance();
    $this->table = $this->ci->input->post("table");
  }

  function primary_key()
  {
    $fields = $this->ci->db->field_data($this->table);
    foreach ($fields as $field) {
      if ($field->primary_key == 1) {
        $arr =  $field->name;
      }
    }
    return $arr;
  }

  function all_field()
  {
    $fields = $this->ci->db->field_data($this->table);
    foreach ($fields as $field) {
        $arr[] =  $field->name;
    }
    return $arr;
  }

  function field_not_primary()
  {
    $fields = $this->ci->db->field_data($this->table);
    foreach ($fields as $field) {
      if ($field->primary_key != 1) {
        $arr[] =  $field->name;
      }
    }
    return $arr;
  }

  function content_rules()
  {
    $str = '';
    $field = $this->field_not_primary();
    for ($i=0; $i < count($field) ; $i++) {
      if (!empty($_POST['rules'])) {
        if (!empty($_POST['rules'][$field[$i]])) {
          $rule = "|".implode("|", $_POST['rules'][$field[$i]]);
        }else {
          $rule = "";
        }
      }else {
        $rule = "";
      }

      $str.= "\n\t\t\$this->form_validation->set_rules('".$field[$i]."', '".field_title($field[$i])."', 'trim|xss_clean".$rule."');";
    }

    $str .= "\n\t\t\$this->form_validation->set_error_delimiters('<i class=\"text-danger\" style=\"font-size:11px\">', '</i>');";
    return $str;
  }

  function content_json()
  {
    $str = '';
    if (!empty($_POST["show_table"])) {
      $field = $_POST["show_table"];
      foreach ($field as $key => $value) {
        $str.= "\n\t\t\t\t\t\$row[] = \$get->".$key.";";
      }
      return $str;
    }
    return false;
  }

  function params($params)
  {
    $str = '';
    if (!empty($_POST["type_form"])) {
      $form_type = $_POST["type_form"];
      foreach ($form_type as $key => $value) {
        if ($params=="add") {
          $str.="\n\t\t\t\t\t\t\t\t\t'".$key."' => set_value('".$key."'),";
        }elseif ($params == "detail_view") {
          $str.="\n\t\t\t\t\t<tr>";
          $str.="\n\t\t\t\t\t\t<td>".field_title($key)."</td>";
          $str.="\n\t\t\t\t\t\t<td><?=$".$key."?></td>";
          $str.="\n\t\t\t\t\t</tr>\n";
        }elseif($params=="detail"){
          if ($value == "date") {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => date('d-m-Y',strtotime(\$row->".$key.")),";
          }elseif($value == "time"){
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => date('H:i',strtotime(\$row->".$key.")),";
          }elseif ($value == "datetime-local") {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => dateTimeFormat(\$row->".$key."),";
          }else {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => \$row->".$key.",";
          }
        }else {
          if ($value == "date") {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => set_value('".$key."',date('Y-m-d',strtotime(\$row->".$key."))),";
          }elseif($value == "time"){
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => set_value('".$key."',date('H:i',strtotime(\$row->".$key."))),";
          }elseif ($value == "datetime-local") {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => set_value('".$key."',dateTimeFormat(\$row->".$key.")),";
          }else {
            $str.="\n\t\t\t\t\t\t\t\t\t\t'".$key."' => set_value('".$key."',\$row->".$key."),";
          }

        }
      }
      return $str;
    }
    return false;
  }

  function input_post()
  {
    $str = '';
    $post = $_POST['type_form'];
    foreach ($post as $key => $value) {
      if ($value == "date") {
        $str .= "\n\t\t\t\t\$save_data['".$key."'] = date('Y-m-d',strtotime(\$this->input->post('".$key."',true)));";
      }elseif($value == "time"){
        $str .= "\n\t\t\t\t\$save_data['".$key."'] = date('H:i',strtotime(\$this->input->post('".$key."',true)));";
      }elseif ($value == "datetime-local") {
        $str .= "\n\t\t\t\t\$save_data['".$key."'] = date('Y-m-d H:i',strtotime(\$this->input->post('".$key."',true)));";
      }elseif($value == "imageupload") {
          $str .= "\n\t\t\t\t\$save_data['".$key."'] = \$this->imageCopy(\$this->input->post('".$key."',true),\$_POST['file-dir-".$key."']);";
      }else {
        $str .= "\n\t\t\t\t\$save_data['".$key."'] = \$this->input->post('".$key."',true);";
      }
    }
    return $str;
  }

  function content_model_get_field($params="")
  {
    $str = '';
    if (!empty($_POST["show_table"])) {
      $show_in_table = $_POST["show_table"];
      $field = array_keys($show_in_table);
        if ($params == "select") {
          $imp = implode(",",$field);
          $str.= $this->primary_key().",".$imp;
        }elseif($params == "order") {
          $str .= json_encode($field);
        }elseif($params == "filter") {
          foreach ($show_in_table as $key => $value) {
            $str .= "\n\t\t\tif(\$this->input->post('".$key."')){";
            $str .=  "\n\t\t\t\t\$this->db->like('".$key."', \$this->input->post('".$key."'));";
            $str .=  "\n\t\t\t}";
          }
        }

      return $str;
    }
    return false;
  }

  function content_index($params)
  {
    $str = '';
    if (!empty($_POST["show_table"])) {
      $show_in_table = $_POST["show_table"];
      $field = count($show_in_table);
      if ($params == "thead") {
        foreach ($show_in_table as $key => $value) {
          $str.= "\n\t\t\t\t\t\t\t\t<th>".field_title($key)."</th>";
        }
      }elseif ($params == "column_defs") {
        for ($i=0; $i < $field ; $i++) {
          $str .="\n\t\t\t\t\t{
              'orderable': true,
              'targets': ".$i."
          },";
        }

          $str .="\n\t\t\t\t\t{
              'className': 'text-center',
              'orderable': false,
              'targets': ".$i++."
          }";
      }
      return $str;
    }
    return false;
  }


  function  content_filter($params)
  {
    $str = '';
    if (!empty($_POST["show_table"])) {
      $show_in_table = $_POST["show_table"];
      $field = count($show_in_table);
      if ($params == "form_filter") {
        foreach ($show_in_table as $key => $value) {
          $str.="\n\t\t<div class=\"form-group col-sm-6\">";
          $str.="\n\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" id=\"".$key."\" placeholder=\"".field_title($key)."\" />";
          $str.="\n\t\t</div>";
        }
      }elseif ($params == "data_filter") {
        foreach ($show_in_table as $key => $value) {
          $str.="\n\t\t\t\t\t\tdata.".$key." = $(\"#".$key."\").val();";
        }
      }elseif ($params == "filter_delete") {
        foreach ($show_in_table as $key => $value) {
          $str.="\n\t\$(\"#".$key."\").val(\"\");";
        }
      }
      return $str;
    }
    return false;
  }

  function content_form()
  {
    $str = '';
    if (!empty($_POST["type_form"])) {
      $form_type = $_POST["type_form"];
      foreach ($form_type as $key => $value) {
        $str.="\n\t\t\t\t\t<div class=\"form-group\">";
        $str.="\n\t\t\t\t\t<label>".field_title($key)."</label>";
        if ($value == "text") {
          $str.="\n\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm\" name=\"".$key."\" id=\"".$key."\" value=\"<?=$".$key."?>\" />";
        }elseif ($value == "date") {
          $str.="\n\t\t\t\t\t\t<input type=\"date\" class=\"form-control form-control-sm\" name=\"".$key."\" id=\"".$key."\" value=\"<?=$".$key."?>\" />";
        }elseif ($value == "time") {
          $str.="\n\t\t\t\t\t\t<input type=\"time\" class=\"form-control form-control-sm\" name=\"".$key."\" id=\"".$key."\" value=\"<?=$".$key."?>\" />";
        }elseif ($value == "datetime-local") {
            $str.="\n\t\t\t\t\t\t<input type=\"datetime-local\" class=\"form-control form-control-sm\" name=\"".$key."\" id=\"".$key."\" value=\"<?=$".$key."?>\" />";
        }elseif($value == "textarea") {
          $str.="\n\t\t\t\t\t\t<textarea class=\"form-control\" rows=\"3\" name=\"".$key."\" id=\"".$key."\"><?=$".$key."?></textarea>";
        }elseif($value == "imageupload") {
          $str.="\n\t\t\t\t\t\t<input type=\"file\" name=\"img\" class=\"file-upload-default\" data-id=\"".$key."\"/>";
          $str.="\n\t\t\t\t\t\t\t<div class=\"input-group col-xs-12\">";
          $str.="\n\t\t\t\t\t\t\t\t<input type=\"hidden\" class=\"file-dir\" name=\"file-dir-".$key."\" data-id=\"".$key."\"/>";
          $str.="\n\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control form-control-sm file-upload-info file-name\" data-id=\"".$key."\" readonly name=\"".$key."\" value=\"<?=$".$key."?>\" />";
          $str.="\n\t\t\t\t\t\t\t\t\t<span class=\"input-group-append\">";
          $str.="\n\t\t\t\t\t\t\t\t\t\t<button class=\"btn-remove-image btn btn-danger btn-sm\" type=\"button\" data-id=\"".$key."\" style=\"display:<?=$".$key."!=''?'block':'none'?>;\"><i class=\"ti-trash\"></i></button>";
          $str.="\n\t\t\t\t\t\t\t\t\t\t<button class=\"file-upload-browse btn btn-primary btn-sm\" data-id=\"".$key."\" type=\"button\">Select File</button>";
          $str.="\n\t\t\t\t\t\t\t\t\t</span>";
          $str.="\n\t\t\t\t\t\t\t</div>";
          $str.="\n\t\t\t\t\t\t<div id=\"".$key."\"></div>";
        }elseif ($value == "text-editor") {
          $str.="\n\t\t\t\t\t\t<textarea class=\"form-control text-editor\" rows=\"3\" name=\"".$key."\" id=\"".$key."\"><?=$".$key."?></textarea>";
        }

        $str.="\n\t\t\t\t\t</div>\n";
      }
      return $str;
    }
    return false;
  }

}
