<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GraficaModel extends CI_Model
{

    public function getCantidadXdia($year,$mes,$dia)
    {

       $this->db->select('count(*) as cantidad');
             $this->db->from('clientes');
        $this->db->where('YEAR(created_at)',strval($year));
        $this->db->where('MONTH(created_at)',strval($mes));
        $this->db->where('DAY(created_at)',strval($dia));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row()->cantidad;
        }else{
            return false;
        }

    }
    public function getCantidadXdiaEliminados($year,$mes,$dia)
    {
        $this->db->select('count(*) as cantidad');
        $this->db->from('clientes');
        $this->db->where('YEAR(created_at)',strval($year));
        $this->db->where('MONTH(created_at)',strval($mes));
        $this->db->where('DAY(created_at)',strval($dia));
        $this->db->where('deleted_at <>',null);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row()->cantidad;
        }else{
            return false;
        }

    }
    public function totalXmes($year,$mes)
    {
        $this->db->select('count(*) as cantidad');
        $this->db->from('clientes');
        $this->db->where('YEAR(created_at)',strval($year));
        $this->db->where('MONTH(created_at)',strval($mes));
        $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->row()->cantidad;
        }else{
            return false;
        }

    }
}