<?php

class Main_model extends CI_Model
{

  public function select_record($table, $where = '')
  {

    $this->db->select()->from($table);
    if ($where) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function save_record($table, $data)
  {
    $this->db->insert($table, $data);
    if ($query = $this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function delete_record($table, $where)
  {
    $this->db->delete($table, $where);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function single_record($table, $where = '')
  {
    $this->db->select()->from($table);
    if ($where) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->row();
  }

  public function update_record($table, $data, $where)
  {
    $this->db->update($where);
    $this->db->update($table, $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  // fetching records by single column
  public function fetch_bysinglecol($col, $tbl, $id)
  {
    $where = array(

      $col => $id

    );


    $this->db->select()->from($tbl)->where($where);

    $query = $this->db->get();

    return $result = $query->result();
  }

  //get user details
  public function getUserDetails($user_id)
  {
    $this->db->select("e.nama_petugas,e.no_telepon,e.gambar_petugas,g.GROUP_NAME as jabatan");
    $this->db->from('petugas as e, usr_user as u', 'usr_group as g');
    $this->db->join('usr_group as g', 'g.GROUP_ID = u.GROUP_ID');
    $this->db->where('u.USER_ID = e.USER_ID');
    $this->db->where('u.GROUP_ID   = g.GROUP_ID ');
    $this->db->where('u.USER_ID', $user_id);
    $query = $this->db->get();
    return $query->row();
  }

  public function create_record($data, $tbl)
  {


    $this->db->set($data);

    $this->db->insert($tbl);
  }
}
