
<?php

  include 'dist/ajax/is_logged.php';//Archivo verifica que el usario que intenta acceder a la URL esta logueado
  
  require_once "dist/config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
  require_once "dist/config/conexion.php"; //Contiene funcion que conecta a la base de datos
  require_once "config/conexion2.php";
$user     = new CodeaDB();
$title = "Clientes | Cotizador";
$clientes = "active"; 
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include "head.php";
  ?>

</head>

<body class="fix-header card-no-border">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <?php
    include "navbar.php";
    ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
          <div class="col-md-10 col-10 align-self-center">
            <h3 class="text-themecolor mb-0 mt-0">Clientes</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
            </ol>
          </div>
          <div class="col-md-2 col-2 d-md-flex justify-content-md-end h-100">
            <button class="btn float-right  btn-success" data-bs-toggle="modal" data-bs-target="#addModalClient"><i
                class="mdi mdi-plus-circle"></i>
              <span class='hidden-sm-down'>Nuevo cliente</span></button>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
      <?php
        
        include "modal/registro_clientes.php";
        include "modal/editar_cliente.php";
        include "modal/agregar_contacto.php";
        include "modal/actualizar_contacto.php";
        ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Buscar clientes</h4>
                <div class="row">
                  <div class="col-sm-6 nopadding">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                          <input id="q" type="text" value="" name="q"
                            data-bts-button-down-class="btn btn-secondary "
                            data-bts-button-up-class="btn btn-secondary " class="form-control"
                            placeholder="Buscar por nombre" onkeyup='load(1);'>
                          <span class="input-group-btn input-group-append">
                            <button class="btn btn-secondary  bootstrap-touchspin-up" type="button"
                              onclick="load(1);"><i class='fa fa-search'></i> Buscar</button>

                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <span id="loader"></span>
                  </div>
                </div>
                <div class="row">
                  <div id="resultados" class='col-sm-12 '></div><!-- Carga los datos ajax -->
                  <div class='outer_div' class='col-sm-12 ' style="width:100%"> </div><!-- Carga los datos ajax -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
     <!--  <script type="text/javascript" >

$.fn.modal.Constructor.prototype.enforceFocus = function() {};	
      </script> -->
      <?php
      include "footer.php";
      ?>
       
      <script type="text/javascript" src="dist/js/clientes.js"></script>
   
    <!-- 	<script type="text/javascript" src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script> -->
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
      <script type = "text/javascript">   


  // ... Código existente ...


  
$("#mod_depto").change(function(){
$.ajax({
    data:  "id="+$("#mod_depto").val(),
    url:   'get_municipios.php',
    type:  'post',
    dataType: 'json',
    beforeSend: function () {  },
    success:  function (response) {
        var html = "";
        html+= '<option value="">Seleccione</option>';
        $.each(response, function( index, value ) {
            html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
        });
        $("#mod_muni").html(html);
        
    },
    error:function(){
         alert("error")
    }
});
});

$.validator.setDefaults({
  submitHandler: function(form) {
    form.submit(); // Envía el formulario si todas las validaciones son exitosas
  }
});

$(document).ready(function() {
  // Función para validar la máscara de DUI en El Salvador
  $.validator.addMethod('DUI', function(value, element) {
    return this.optional(element) || /^\d{8}-?\d$/.test(value);
  }, 'Por favor, ingresa un número de DUI válido.');

  // Función para validar la máscara de número en El Salvador
  $.validator.addMethod('phoneSV', function(value, element) {
    return this.optional(element) || /^\+?503 \d{4}-?\d{4}$/.test(value);
  }, 'Por favor, ingresa un número de teléfono válido.');

  // Máscara de DUI en El Salvador
  $("#mod_dui_cliente").mask("99999999-9");
  // Máscara de teléfono en El Salvador
  $("#mod_tel").mask("+503 9999-9999");

  // Agregar asterisco a todos los labels de los campos requeridos
  $('label.required').append('&nbsp;<strong>*</strong>&nbsp;');


  // ... Código existente ...

  // Aplicar Select2 en el campo select
  $("#mod_giro").select2();

  // Validación manual para campos select con Select2
  $("#mod_giro").on("change", function() {
    $(this).valid();
  });
});


$("#editar_cliente").validate({
    rules: {
      mod_dui_cliente: {
        required: true,
        DUI: true
      },
      mod_tel: {
        required: true,
        phoneSV: true
      }
    },
    messages: {
      mod_dui_cliente: {
        required: 'Por favor, ingresa un número de DUI',
        DUI: "DUI inválido"
      },
      mod_tel: {
        required: 'Por favor, ingresa un número de teléfono',
        phoneSV: "Número de teléfono inválido"
      }
    },
    errorElement: "span",
    errorPlacement: function(error, element) {
      // Agregar la clase 'invalid-feedback' al elemento de error
      error.addClass("invalid-feedback");
      error.insertAfter(element);
    },
    highlight: function(element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });

		
		


      


</script>

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
</body>

</html>