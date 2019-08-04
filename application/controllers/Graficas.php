<?php

defined('BASEPATH') OR exit('No direct script access allowed');

    class Graficas extends CI_Controller{

        function __construct()
        {
            parent::__construct();
            $this->load->model('GraficaModel','model');
        }

        public function index () {
            $this->load->view('layouts/header');
            $this->load->view('layouts/navbar');
            $this->load->view('clientes/graficas');
            $this->load->view('layouts/footer');
        }

        public function getEstadistica1()
        {
            $year =date('Y');
            $mes = $this->input->post('mes');
            $dias_mes = cal_days_in_month(CAL_GREGORIAN,$mes, $year);
            $series1 = array();
            $total = $this->model->totalXmes($year,$mes);
            //en este ciclo recorre cada dia del mes en cuestion para calcular los clientes registrados por mes y po dias
            for($i = 1; $i <= $dias_mes; $i++)
            {

                   $dias[]=$i;
                   $cantidades = $this->model->getCantidadXdia($year,$mes,$i);
                   $cantidadEliminados = $this->model->getCantidadXdiaEliminados($year,$mes,$i);
                   $data[]=intval($cantidades);
                   $data2[]=intval($cantidadEliminados);
            }
            $series1[]=array('name'=>'Clientes registrados','data'=>$data);
            $series1[]=array('name'=>'Clientes eliminados','data'=>$data2);
            $array=array($dias,$series1,$total);

            echo json_encode($array);
        }
    }