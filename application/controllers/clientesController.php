<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class clientesController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('ClienteModel','model');
    }

    public function index () {
        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar');
        $this->load->view('clientes/index');
        $this->load->view('layouts/footer');
    }

    public function getDepartamentos()
    {
        $departamentos = $this->model->getDepartamentos();
        echo json_encode($departamentos);
    }
    public function getAllmunicipios()
    {
        echo json_encode($this->model->getAllmunicipios());
    }


    public function getMunicipios()
    {

          echo json_encode($this->model->getMunicipios());
    }
    public function regCliente()
    {
        if($this->input->post('edit')==0){

            $result = $this->model->regCliente();

            echo json_encode($result);

        }else if($this->input->post('edit')>0)
        {

            $result = $this->model->update();

            if($result)
            {
                echo "updated";
            }else{
                echo "fail";
            }


        }




    }
    public function getClientes()
    {
        $clientes = $this->model->getClientes();


       $data = array();
        foreach ($clientes as $cliente )
        {

            $id = $cliente->id;
            $data[]=array(
                "nombre"=>$cliente->cliente_nombre,
                "apellido"=>$cliente->cliente_apellido,
                "documento"=>$cliente->cliente_numero_doc,
                "fecha"=>$cliente->created_at,
                "opciones"=>"
                <a href='javascript:destroy(".$id.")' class='btn btn-sm btn-danger' >X</a>
                <a href='javascript:show(".$id.")' class='btn btn-sm btn-primary' >Ver</a>
                  <a href='javascript:edit(".$id.")' class='btn btn-sm btn-success' >Editar</a>
                "
            );
        }

        $data = array("data"=>$data);

            echo json_encode($data);

    }

    public function destroy()
    {
        echo $this->model->destroy();
    }

    public function show()
    {
        $clientes = $this->model->showCliente();

        echo json_encode($clientes);
    }
}