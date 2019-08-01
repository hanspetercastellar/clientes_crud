<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ClienteModel extends CI_Model{

    public function getDepartamentos()
    {
        $this->db->order_by('id_departamento', 'DESC');
        $query = $this->db->get('departamentos');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


    }

    public function getMunicipios()
    {

         $id_departamento = $this->input->post('id');

        $this->db->where('departamento_id', $id_departamento);
        $query = $this->db->get('municipios');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }

    }
    public function getAllmunicipios()
    {

        $query = $this->db->get('municipios');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }


    }

    public function regCliente()
    {
        $field = array(
            'cliente_nombre'=>$this->input->post('nombre'),
            'cliente_apellido'=>$this->input->post('apellido'),
            'tipo_doc'=>$this->input->post('t_doc'),
            'cliente_numero_doc'=>$this->input->post('n_doc'),
            'cliente_telefono'=>$this->input->post('telefono'),
            'municipio_id'=>intval($this->getIdMunicipio($this->input->post('ciudad'))),
            'cliente_direccion'=>$this->input->post('direccion'),
            'cliente_email'=>$this->input->post('email'),
            'created_at'=>date('Y-m-d')
        );
        $insert= $this->db->insert('clientes', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return This;
        }
    }

    public function getIdMunicipio($input)
    {
        $this->db->select('id_municipio');
        $this->db->where('municipio', $input);
        $query = $this->db->get('municipios');
        if($query->num_rows() > 0){
            return $query->row()->id_municipio;
        }else{
            return false;
        }
    }

    public function getClientes()
    {
        $this->db->select("id_cliente as id,cliente_nombre,cliente_apellido,tipo_doc,cliente_numero_doc,cliente_telefono,municipios.municipio,cliente_direccion,cliente_email,created_at");
        $this->db->from('clientes');
        $this->db->join('municipios', 'clientes.municipio_id = municipios.id_municipio');
        $this->db->where('deleted_at',null);
        $query = $this->db->get();
        return $query->result();

        $this->db->order_by('id_cliente', 'DESC');
        $query = $this->db->get('clientes');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }


    }

    public function destroy()
    {
        $id = $this->input->post('id');

        $update = array(
            'deleted_at'=>date('y-m-d')
        );
        $this->db->where('id_cliente',$id);
        $this->db->update('clientes',$update);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function showCliente()
    {
        $id = $this->input->post('id');
        $this->db->select("id_cliente as id,departamentos.departamento as departamento,cliente_nombre,cliente_apellido,tipo_doc,cliente_numero_doc,cliente_telefono,municipios.municipio as ciudad,cliente_direccion,cliente_email,created_at");
        $this->db->from('clientes');
        $this->db->join('municipios', 'clientes.municipio_id = municipios.id_municipio','INNER');
        $this->db->join('departamentos', 'departamentos.id_departamento = municipios.departamento_id','INNER');
        $this->db->where('deleted_at',null);
        $this->db->where('id_cliente',$id);
        $query = $this->db->get();
        return $query->result();

        $this->db->order_by('id_cliente', 'DESC');
        $query = $this->db->get('clientes');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }

    }

    public function update()
    {
        $field = array(
            'cliente_nombre'=>$this->input->post('nombre'),
            'cliente_apellido'=>$this->input->post('apellido'),
            'tipo_doc'=>$this->input->post('t_doc'),
            'cliente_numero_doc'=>$this->input->post('n_doc'),
            'cliente_telefono'=>$this->input->post('telefono'),
            'municipio_id'=>intval($this->getIdMunicipio($this->input->post('ciudad'))),
            'cliente_direccion'=>$this->input->post('direccion'),
            'cliente_email'=>$this->input->post('email'),
            'updated_at'=>date('Y-m-d')
        );
          $this->db->where('id_cliente',$this->input->post('edit'));
         $this->db->update('clientes', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return This;
        }
    }


}