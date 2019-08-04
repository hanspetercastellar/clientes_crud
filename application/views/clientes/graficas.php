<div class="container-fluid">
    <div class="row mt-sm-3">
        <div class="col-sm-12 col-xl-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">Clientes registrados</div>
                        <div class="col-6">
                            <form class="form-row">
                                <select type="text" placeholder="Seleccione un mes"  id="mes" name="mes" class="form-control custom-select-sm form-control-sm">
                                    <option value="0" disabled selected>Seleccione un mes</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   <div class="container-fluid" id="container">

                   </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    var date = new Date();
    var mesActual= date.getMonth();
    window.onload = ()=>{
        cargarMeses()
        setTimeout(()=>{
            cargarGrafica1($("#mes option:selected").val())
        },1000)

        document.getElementById('mes').onchange = ()=>{

            cargarGrafica1(document.getElementById('mes').value)
        }

    }
    //cargamos los meses en el select
     function cargarMeses()
     {
         let meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
         document.getElementById('mes').innerHTML="";
         meses.forEach((val,index,arr)=>{
             let option = `<option  value="${index+1}">${val}</option>`;
             if(index+1==mesActual+1)
             {
                 option = `<option selected  value="${index+1}">${val}</option>`;
             }

             $("#mes").append(option)
         })
     }

     function cargarGrafica1(mes)
     {

         $.post(`<?php echo base_url('Graficas/getEstadistica1')?>`,{'mes':mes},(res)=>{
             let json = JSON.parse(res);

             grafica1(json)

         })

     }

     function grafica1(datos)
     {

         Highcharts.chart('container', {
             chart: {
                 type: 'line'
             },
             title: {
                 text: 'Clientes registrados por mes'
             },
             subtitle: {
                 text: 'Total clientes registrados en este mes '+datos[2]
             },
             xAxis: {
                 categories: datos[0]
             },
             yAxis: {
                 title: {
                     text: 'Cantidad de clientes registrados'
                 }
             },
             plotOptions: {
                 line: {
                     dataLabels: {
                         enabled: true
                     },
                     enableMouseTracking: false
                 }
             },
             series: datos[1]
         });
     }
</script>