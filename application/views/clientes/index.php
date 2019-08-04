<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-12 col-md-12 col-xl-5  ">
            <div class="card">
                <h5 class="card-header">Formulario para registrar clientes</h5>
                <div class="card-body">
                    <div class="container-fluid">
                        <form id="form_clientes">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="nombre" >Nombre</label>
                                    <input type="text" maxlength="30" name="nombre" id="nombre" class="form-control form-control-sm  ">
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="apellido">Apellidos</label>
                                    <input type="text" maxlength="40" name="apellido" id="apellido" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="t_doc" >Tipo documento</label>
                                    <input type="text" name="t_doc" list="tipo_docs" id="t_doc" class="form-control form-control-sm">
                                    <datalist id="tipo_docs">
                                        <option value="CEDULA DE CIUDADANIA"></option>
                                        <option value="TARJETA DE IDENTIDAD"></option>
                                        <option value="NIT"></option>
                                    </datalist>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="n_doc">Numero documento</label>
                                    <input type="number" maxlength="11" name="n_doc" id="n_doc" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-5 col-xl-5">
                                    <label for="telefono" >Telefono</label>
                                    <input type="number" maxlength="11" name="telefono" id="telefono" class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-sm-12 col-md-7 col-xl-7">
                                    <label for="direccion">Dirección recidencial</label>
                                    <input type="text" name="direccion" id=direccion class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="departamento" >Departamento</label>
                                    <input type="text" list="departamentos" name="departamento" id="departamento" class="form-control form-control-sm">
                                    <datalist id="departamentos">

                                    </datalist>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-xl-6">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" list="ciudades" name="ciudad" id="ciudad" class="form-control form-control-sm">
                                    <datalist id="ciudades">

                                    </datalist>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-8 col-xl-8">
                                    <label for="email">Correo electronico</label>
                                    <input type="email" maxlength="30" name="email" id="email"  class="form-control form-control-sm">
                                </div>
                                <div class="form-group col-sm-12 col-md-4 col-xl-4">
                                    <button class="btn btn-success mt-4 d-none" id="editar">Editar</button>
                                   <button class="btn btn-primary mt-4" id="registrar">Registrar</button>
                                    <button class="btn btn-secondary mt-4 d-none" type="reset" id="restaurar">Restaurar</button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12  col-md-12 col-xl-7 mt-md-3 mt-sm-3  mt-xl-0 ">
            <div class="card">
                <h5 class="card-header">Gestion de clientes</h5>
                <div class="card-body">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-12">
                              <table class="table table-sm table-striped table-responsive-sm table-responsive-md" id="tabla">
                                  <thead>
                                     <tr>
                                         <th data-priority="1">Nombre</th>
                                         <th>Apellidos</th>
                                         <th>Documento</th>
                                         <th>Fecha creacion</th>
                                         <th data-priority="2">Opciones</th>
                                     </tr>
                                  </thead>
                                   <tbody>
                                   </tbody>
                                  <tfoot>
                                      <tr>
                                          <th >Nombre</th>
                                          <th>Apellidos</th>
                                          <th>Documento</th>
                                          <th>Fecha creacion</th>
                                          <th>Opciones</th>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>

                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="baseUri" value="<?php base_url('Clientes/getDepartamentos') ?>" >
<script>
    window.onload = ()=>{
        cargarDepartamentos()
        getAllmunicipios()
        eventos()
        cargarTabla()
        let form =  serializeArray(document.getElementById('form_clientes'));
        console.log(form)
1
    }
    //esta funcion se encarga de almacenar todos los eventos que deseo capturar en el formuario de registro
    function eventos()
    {
        //evitamos el envio del formulario para hacerlo por ajax
         document.getElementById('editar').onclick = (e)=>{
             e.preventDefault();
             validarFormulario(sessionStorage.getItem('id_cliente'))
         }
         //Este trozo de codigo es para editar el cliente
        document.getElementById('registrar').onclick = (e)=>{
            e.preventDefault();
            validarFormulario()
        }
          //a continuacion capturamos el evento onchange para cada elemento del formulario
        //luego verificamos el formato de cada input para no admitir datos errados
          document.getElementById('nombre').onchange = ()=>{
              let regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
              let nombre = document.getElementById('nombre').value;
               if(!regex.test(nombre))
               {
                   document.getElementById(`nombre`).classList.add('is-invalid');
                   alert("Disculpe, en este campo no se admiten numeros")
                   document.getElementById('registrar').classList.add('d-none')
               }else{
                   document.getElementById(`nombre`).classList.remove('is-invalid');
                   document.getElementById(`nombre`).classList.add('is-valid');
                   document.getElementById(`registrar`).classList.remove('d-none');
               }
         }
        document.getElementById('apellido').onchange = ()=>{
            let regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
            let apellido = document.getElementById('apellido').value;
            if(!regex.test(apellido))
            {
                document.getElementById(`apellido`).classList.add('is-invalid');
                alert("Disculpe, en este campo no se admiten numeros")
                document.getElementById('registrar').classList.add('d-none')
            }else{
                document.getElementById(`apellido`).classList.remove('is-invalid');
                document.getElementById(`apellido`).classList.add('is-valid');
                document.getElementById(`registrar`).classList.remove('d-none');
            }
        }
        document.getElementById('n_doc').onchange = ()=>{

                document.getElementById(`n_doc`).classList.add('is-valid');

        }
        document.getElementById('telefono').onchange = ()=>{

            document.getElementById(`telefono`).classList.add('is-valid');

        }
        document.getElementById('direccion').onchange = ()=>{

            document.getElementById(`direccion`).classList.add('is-valid');

        }
        document.getElementById('departamento').onchange = ()=>{

            var val = document.getElementById("departamento").value;
            //seleccionamos el id del departamento para luego mostrar los municipios relacionados
            var id_departamento = $("#departamentos").find(`option[value='${val}']`).data('value');

             if(id_departamento==undefined)
             {
                 document.getElementById(`departamento`).classList.add('is-invalid');
                 document.getElementById(`departamento`).focus()
                 document.getElementById('registrar').classList.add('d-none')
                 alert("este departamento no existe")
             }else if (id_departamento!=undefined) {
                 document.getElementById('registrar').classList.remove('d-none')
                 document.getElementById(`departamento`).classList.remove('is-invalid');
                 document.getElementById(`departamento`).classList.add('is-valid');
                 document.getElementById(`ciudad`).focus();
                 document.getElementById(`ciudad`).value = "";
                 var url = '<?php echo base_url('Clientes/getMunicipios')?>';

                 $.post(`${url}`,{"id":id_departamento},(res)=>{
                     let municipios = JSON.parse(res);
                     document.getElementById('ciudades').innerHTML="";
                     municipios.forEach((val,index,arr)=>{

                         let option = `<option data-value="${val.id_municipio}" label="${val.id_municipio}" value="${val.municipio}">`;

                         $('#ciudades').append(option)

                     })
                 })

             }



        }
        document.getElementById('ciudad').onchange = ()=>{

            document.getElementById(`ciudad`).classList.add('is-valid');

        }
        //capturamos este evento del boton restaurar para habilitar el boton de registro que se oculto en la funcion show
        document.getElementById('restaurar').onclick=(e)=>{
            document.getElementById('registrar').removeAttribute('disabled');
           document.getElementById('registrar').classList.remove('d-none');
            document.getElementById('editar').classList.add('d-none');
            document.getElementById('restaurar').classList.add('d-none');
            document.getElementById('nombre').removeAttribute('disabled');
            document.getElementById('apellido').removeAttribute('disabled');
            document.getElementById('t_doc').removeAttribute('disabled');
            document.getElementById('n_doc').removeAttribute('disabled');
            document.getElementById('telefono').removeAttribute('disabled');
            document.getElementById('direccion').removeAttribute('disabled');
            document.getElementById('departamento').removeAttribute('disabled');
            document.getElementById('ciudad').removeAttribute('disabled');
            document.getElementById('email').removeAttribute('disabled');

        }


    }
     //esta funcion se encarga de validar el formulario
    function validarFormulario( edit = 0)
    {

        let form = document.getElementById("form_clientes");
        var datos = new Array();
        let form_element = serializeArray(form);
        let cont = 0;
        console.log(form_element.length)
        //iteramos los elementos del formulario para verificar
        for(let i = 0; i <= form_element.length-1; i++ )
        {
            if (form_element[i].value == "" )
            {
                alert(`Disculpe, el campo ${form_element[i].name} es obligatorio`);
                document.getElementById(`${form_element[i].name}`).focus();
                document.getElementById(`${form_element[i].name}`).classList.add('is-invalid');


                break;

            }
            else{

                if (form_element[i].name=="email")
                {
                    if(!isValidEmail(form_element[i].value)) {
                        document.getElementById(`${form_element[i].name}`).focus();
                        document.getElementById(`${form_element[i].name}`).classList.add('is-invalid');
                        alert(`Disculpe, escoja un formato valido de email`);
                        break;
                    }else{
                        document.getElementById(`${form_element[i].name}`).classList.remove('is-invalid');
                        document.getElementById(`${form_element[i].name}`).classList.add('is-valid');
                    }
                }


                document.getElementById(`${form_element[i].name}`).classList.remove('is-invalid');
                document.getElementById(`${form_element[i].name}`).classList.add('is-valid');
            }
             //si todos los campos estan validados correctamente procedemos a el envio de los datos al backend
            if(i == form_element.length-1)
            {
                const data = new FormData(document.getElementById('form_clientes'));
                data.append('edit',edit);
                fetch('<?php echo base_url('Clientes/regCliente') ?>', {
                    method: 'POST',
                    body: data
                })
                    .then(function(response) {
                        if(response.ok) {
                            return response.text()
                        } else {
                            throw "Error";
                        }

                    })
                    .then(function(texto) {

                       if (texto)
                       {
                           cargarTabla()
                           alert("Cliente registrado satisfactoriamente")
                           $("#form_clientes")[0].reset()

                       }else if(texto=="updated")
                       {
                           alert("El registro ha sido actualizado")
                           cargarTabla()
                       }else if(texto=='fail')
                       {
                           alert("Ha ocurrido un problema con la actualizacion")
                           cargarTabla()
                       }
                    })
                    .catch(function(err) {
                        console.log(err);
                    });
            }
        }

    }

    //esta funcion recibe como parametro un elemento de tipo pormulario
    //convierte los elementos hijos del formulario en elementos de un array
    function serializeArray(form) {
        var field, l, s = [];
        if (typeof form == 'object' && form.nodeName == "FORM") {
            var len = form.elements.length;
            for (var i=0; i<len; i++) {
                field = form.elements[i];
                //valido y filtro solo los elementos del formulario que me interesan, descartando los que no.
                if (field.name && !field.disabled && field.type != 'file' && field.type != 'reset' && field.type != 'submit' && field.type != 'button' && field.classList != 'hide' ) {
                    if (field.type == 'select-multiple') {
                        l = form.elements[i].options.length;
                        for (j=0; j<l; j++) {
                            if(field.options[j].selected)
                                s[s.length] = { name: field.name, value: field.options[j].value };
                        }
                    } else if ((field.type != 'checkbox' && field.type != 'radio') || field.checked) {
                        s[s.length] = { name: field.name, value: field.value };
                    }
                }
            }
        }
        return s;
    }
    function isValidEmail(mail) {
        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
    }

    function cargarDepartamentos()
    {
        $('#departamentos').html("")
         fetch("<?php echo base_url('Clientes/getDepartamentos') ?>")
            .then(response => response.json())
            .then(data => {
                data.forEach((val,index,array)=>{
                     let option = `<option data-value="${val.id_departamento}" label="${val.id_departamento}" value="${val.departamento}">`;

                    $('#departamentos').append(option)

                })

            })
            .catch(error => console.error(error))
    }

    function  getAllmunicipios()
    {
        $('#ciudades').html("")
        fetch("<?php echo base_url('Clientes/getAllmunicipios') ?>")
            .then(response => response.json())
            .then(data => {
                data.forEach((val,index,array)=>{
                    let option = `<option data-value="${val.id_municipio}" label="${val.id_municipio}" value="${val.municipio}">`;

                    $('#ciudades').append(option)

                })

            })
            .catch(error => console.error(error))
    }

    //implementando datatables para una mejor gestion de los datos en las vistas
    function cargarTabla()
    {
        $("#tabla").DataTable({
            destroy: true,
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal( {
                        header: function ( row ) {
                            var data = row.data();
                            return 'Detalles';
                        }
                    } ),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                        tableClass: 'table'
                    } )
                }
            },
            columnDefs: [
                { responsivePriority: 1, targets: 1 },
                { responsivePriority: 2, targets: -2 }
            ],
            ajax: "<?php echo base_url('Clientes/getClientes')?>",
            columns: [
                { "data": "nombre" },
                { "data": "apellido" },
                { "data": "documento" },
                { "data": "fecha" },
                { "data": "opciones" },
            ],

        })
    }
    //a continuacion recivo como parametro el id del cliente para eliminarlo
    function destroy(id)
    {
      let conf = confirm('Desea eliminar este item?');

      if(conf)
      {
          $.post('<?php echo base_url('Clientes/destroy') ?>',{"id":id},(res)=>{
              console.log(res)
              if(res)
              {
                  cargarTabla()
                  alert("Cliente eliminado satisfactoriamente")
              }
          })
      }

    }
   // funcion para mostrar el detalle del cliente en el formulario
    function show(id)
    {
        $.post('<?php echo base_url('Clientes/show') ?>',{"id":id},(res)=>{
           let json = JSON.parse(res)
            if(res){
                json.forEach((val,index,arr)=>{
                    //ocultamos el boton de registrar
                    document.getElementById('editar').classList.add('d-none');
                    document.getElementById('restaurar').classList.remove('d-none');
                    document.getElementById('registrar').classList.add('d-none');
                    document.getElementById('nombre').value = val.cliente_nombre;
                    document.getElementById('apellido').value = val.cliente_apellido;
                    document.getElementById('t_doc').value = val.tipo_doc;
                    document.getElementById('n_doc').value = val.cliente_numero_doc;
                    document.getElementById('telefono').value = val.cliente_telefono;
                    document.getElementById('direccion').value = val.cliente_direccion;
                    document.getElementById('departamento').value = val.departamento;
                    document.getElementById('ciudad').value = val.ciudad;
                    document.getElementById('email').value = val.cliente_email;
                    document.getElementById('nombre').setAttribute('disabled','disabled');
                    document.getElementById('apellido').setAttribute('disabled','disabled');
                    document.getElementById('t_doc').setAttribute('disabled','disabled');
                    document.getElementById('n_doc').setAttribute('disabled','disabled');
                    document.getElementById('telefono').setAttribute('disabled','disabled');
                    document.getElementById('direccion').setAttribute('disabled','disabled');
                    document.getElementById('departamento').setAttribute('disabled','disabled');
                    document.getElementById('ciudad').setAttribute('disabled','disabled');
                    document.getElementById('email').setAttribute('disabled','disabled');


                })

            }


        })

    }
    function edit(id)
    {
        $.post('<?php echo base_url('Clientes/show') ?>',{"id":id},(res)=>{
            let json = JSON.parse(res)
            if(res){
                json.forEach((val,index,arr)=>{
                    //ocultamos el boton de registrar
                    document.getElementById('registrar').setAttribute('disabled','disabled');
                    document.getElementById('editar').classList.remove('d-none');
                    document.getElementById('restaurar').classList.remove('d-none');
                    document.getElementById('registrar').classList.add('d-none');
                    document.getElementById('nombre').value = val.cliente_nombre;
                    document.getElementById('apellido').value = val.cliente_apellido;
                    document.getElementById('t_doc').value = val.tipo_doc;
                    document.getElementById('n_doc').value = val.cliente_numero_doc;
                    document.getElementById('telefono').value = val.cliente_telefono;
                    document.getElementById('direccion').value = val.cliente_direccion;
                    document.getElementById('departamento').value = val.departamento;
                    document.getElementById('ciudad').value = val.ciudad;
                    document.getElementById('email').value = val.cliente_email;
                    document.getElementById('nombre').removeAttribute('disabled');
                    document.getElementById('apellido').removeAttribute('disabled');
                    document.getElementById('t_doc').removeAttribute('disabled');
                    document.getElementById('n_doc').removeAttribute('disabled');
                    document.getElementById('telefono').removeAttribute('disabled');
                    document.getElementById('direccion').removeAttribute('disabled');
                    document.getElementById('departamento').removeAttribute('disabled');
                    document.getElementById('ciudad').removeAttribute('disabled');
                    document.getElementById('email').removeAttribute('disabled');

                   //creamos una variable de session para almacenar el id del cliente en cuestion
                    sessionStorage.setItem('id_cliente',id);
                })

            }


        })
    }
</script>