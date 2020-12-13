<?php
class M_user extends CI_Model
{
    function getdata($tabel)
    {
        return $this->db->get($tabel)->result();
    }
    function getjoin($tabel, $tabel1, $join)
    {
        return $this->db->from($tabel)->join($tabel1, $join)->get()->result();
    }
    function getjoinfilter($tabel, $tabel1, $join, $where)
    {
        return $this->db->from($tabel)->join($tabel1, $join)->where($where)->get()->result();
    }
    function getwhere($tabel, $where)
    {
        return $this->db->get_where($tabel, $where)->result();
    }
    function insertdata($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }
    function updatedata($tabel, $where, $data)
    {
        $this->db->update($tabel, $data, $where);
    }
    function delete($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }
    function multiinsert($tabel, $data)
    {
        return $this->db->insert_batch($data);
    }
    function getarray($tabel)
    {
        return $this->db->get($tabel)->result_array();
    }
    function search($tabel, $column, $keyword)
    {
        return $this->db->like($column, $keyword)->get($tabel)->result();
    }
    function total_record($tabel)
    {
        $this->db->from($tabel);
        return $this->db->count_all_results();
    }
    function total_row($tabel, $where)
    {
        $this->db->from($tabel)->where($where);
        return $this->db->count_all_results();
    }
    //    tampilkan dengan limit
    function user_limit($limit, $start = 0)
    {
        $this->db->order_by('nama', 'ASC');
        $this->db->limit($limit, $start);
        return $this->db->get('dummy')->result_array();
    }
    function bagi($limit, $start = 0, $where)
    {
        $this->db->limit($limit, $start);
        return $this->db->from('detail_penjualan')->join('barang', 'detail_penjualan.kode_barang=barang.kode_barang')->where($where)->get()->result_array();
    }
}
