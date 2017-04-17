<?php
include("../../db/db.php");

class Cliente{

	public function CrearCliente($Nombre,$Rut,$Dv){
        $this->Nombre=$Nombre;
        $this->Rut=$Rut;
        $this->Dv=$Dv;
        $Insert = mysql_query("INSERT INTO PersonaEmpresa(rut,dv,nombre) VALUES ('$this->Rut','$this->Dv','$this->Nombre')");
        if($Insert){
            echo 1;
        }else{
            echo 0;
        }

	}
    
    public function TipoBusqueda($data){
        $this->data=$data;
        if($this->data==1){
            $QueryNombre = mysql_query("SELECT rut,nombre FROM PersonaEmpresa ORDER BY nombre ASC ");
            echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="Dato">';
            while($row=mysql_fetch_array($QueryNombre)){
                $Rut = $row[0];
                $Nombre = $row[1];
                echo "<option value='$Rut'>".utf8_encode($Nombre)."</option>";
            }
            echo '</select>';
        }
        elseif($this->data==2){
            $QueryNombre = mysql_query("SELECT rut,nombre FROM PersonaEmpresa ORDER BY rut ASC");
            echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="Dato">';
            while($row=mysql_fetch_array($QueryNombre)){
                $Rut = $row[0];
                $Nombre = $row[1];
                echo "<option value='$Rut'>".$Rut."</option>";
            }
            echo '</select>';

        }
	}

    public function VerCliente($Rut){
        $this->Rut=$Rut;
        $Query = mysql_query("SELECT rut,dv,nombre,giro,direccion,correo,contacto,comentario FROM PersonaEmpresa WHERE rut = $this->Rut");
        while($row = mysql_fetch_array($Query)){
            $Rut = $row[0];
            $Nombre = $row[2];
            $Dv = $row[1];
            $Run = $Rut."-".$Dv;
            $Giro = $row[3];
            $Direccion= $row[4];
            $Correo = $row[5];
            $Contacto = $row[6];
            $Comentario = $row[7];

            echo "<b>Datos de Facturación</b><div class='list-divider'></div>";
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo '<div class="form-group">';
            echo '<label>Nombre</label>';
            echo "<input type='text'   disabled class='form-control' value='$Nombre' >";
            echo '</div>';
            echo '</div>'; 
            echo '<div class="col-sm-2">';
            echo '<div class="form-group">';
            echo '<label>Rut</label>';
            echo "<input type='text'   disabled  value='$Run' class='form-control' >";
            echo '</div>';
            echo '</div>'; 
            echo '<div class="col-sm-2">';
            echo '<div class="form-group">';
            echo '<label>Giro</label>';
            echo "<input type='text'  disabled  value='$Giro' class='form-control' >";
            echo '</div>';
            echo '</div>'; 
            echo '<div class="col-sm-2">';
            echo '<div class="form-group">';
            echo '<label>Contacto</label>';
            echo "<input type='text' disabled   value='$Contacto' class='form-control' >";
            echo '</div>';
            echo '</div>';  
            echo '<div class="col-sm-2">';
            echo '<div class="form-group">';
            echo '<label>Correo</label>';
            echo "<input type='text' disabled   value='$Correo' class='form-control' >";
            echo '</div>';
            echo '</div>';          
            echo '</div>'; 
            echo '<div class="row">';
            echo '<div class="col-sm-6">';
            echo '<div class="form-group">';
            echo '<label>Direccion Comercial</label>';
            echo "<input type='text'    disabled class='form-control' value='$Direccion' >";
            echo '</div>';
            echo '</div>'; 
            echo '<div class="col-sm-6">';
            echo '<div class="form-group">';
            echo '<label>Comentario</label>';
            echo "<input type='text'   disabled  value='$Comentario' class='form-control' >";
            echo '</div>';
            echo '</div>';   
            echo '</div>'; 

        }
      	
    }

    public function VerServicio(){
        echo '<div class="row">';
		echo '<div class="col-md-12">';
		echo '<form class="form-horizontal">';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Descripción</label>';
		echo '<div class="col-md-6" lateral>';
		echo '<input id="Descripcion" type="text" class="form-control input-md "/>';
		echo '</div>';
		echo '</div>';
		echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Seleccione Tipo</label>';
		echo '<div class="col-md-6 ">';
        $QueryServicios=mysql_query("SELECT id,descripcion FROM Mantenedor_Tipo_Facturacion");
       	echo '<select   class="select1" id="SeleccioneTipo">';
        echo "<option value='0'>Seleccione</option>";
        while($row=mysql_fetch_array($QueryServicios))
        {
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";
		echo '</div>';
		echo '</div>';
        echo '<div class="form-group">';
		echo '<label class="col-md-4 control-label" for="name">Seleccione Servicio</label>';
		echo '<div class="col-md-6 ">';
        echo "<div id='TipoServicio'>";
       	echo '<select   class="select1" id="Seleccione">';
        echo "<option value=''>Seleccione</option>";
        echo "</div>";
        echo "</select>";
		echo '</div>';
		echo '</div>';
		echo '</form>';
		echo '</div>';
		echo '</div>';

        

    }
    public function AgregaServicio($Rut,$IdServicio,$Descripcion,$IdTipo){
        $this->Rut = $Rut;
        $this->IdServicio=$IdServicio;
        $this->Descripcion=$Descripcion;
        $this->IdTipo=$IdTipo;

        $Dv = '';
        $QueryDv = mysql_query("SELECT dv FROM PersonaEmpresa WHERE rut = $this->Rut");
        while($row=mysql_fetch_array($QueryDv)){
            $Dv  =$row[0];
        }

        $QueryCodigo = mysql_query("SELECT codigo FROM Mantenedor_Tipo_Facturacion WHERE id = $this->IdTipo");
        while($row=mysql_fetch_array($QueryCodigo)){
            $CodigoNombre  =$row[0];
        }

        $Contar = mysql_num_rows(mysql_query("SELECT rut FROM Servicios WHERE rut=$this->Rut AND id_codigo=$this->IdTipo"));
        
        $Contar = $Contar+1;
        if($Contar<10){
            $ContarFinal = "0".$Contar;
        }
        else{
            $ContarFinal = $Contar;
        }
        
        $Codigo = $this->Rut."-".$Dv.$CodigoNombre.$ContarFinal;
        $Insert = mysql_query("INSERT INTO Servicios(rut,id_servicio,descripcion,codigo,id_codigo) VALUES ('$this->Rut','$this->IdServicio','$this->Descripcion','$Codigo','$this->IdTipo')");
        if($Insert){
            echo 1;
        }else{
            echo 0;
        }

    }

    public function SeleccioneServicioTipo($IdTipo){
        $this->IdTipo = $IdTipo;
        $QueryServicios=mysql_query("SELECT id,servicio FROM Mantenedor_Servicios WHERE FIND_IN_SET('$this->IdTipo',id_servicios)");
       	echo '<select   class="select1" id="SeleccioneServicio">';
        while($row=mysql_fetch_array($QueryServicios))
        {
        	echo "<option value='$row[0]'>"; echo utf8_encode($row[1]); echo "</option>";
        }
        echo "</select>";

    }

    
    public function MostrarServicios($Rut){
        $this->Rut=$Rut;
        $Existe = mysql_query("SELECT rut FROM Servicios WHERE rut = $this->Rut");
        if(mysql_num_rows($Existe)>0){
            $QueryServicios = mysql_query("SELECT rut,id_servicio,descripcion,codigo,id FROM Servicios WHERE rut=$this->Rut");
            echo "<b>Servicios Contratados</b>";
            echo "<div class='list-divider'></div>";
            echo '<table id="tabla1" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            echo '<thead>';
            echo '<tr><tr>';
            echo '<th class="text-md">Rut</th>';
            echo '<th class="text-md">Código</th>';
            echo '<th class="text-md">Descripción</th>';
            echo '<th class="text-md">Comentario</th>';
            echo '<th class="text-md"><center>Detalle del Servicio</center></th>';
            echo '</thead><tbody>';
            while($row = mysql_fetch_array($QueryServicios)){
                $Descripcion = $row[2];
                $Codigo = $row[3];
                $IdServicio = $row[1];
                $Id = $row[4];
                $QueryNombreServicio = mysql_query("SELECT servicio FROM Mantenedor_Servicios WHERE id=$IdServicio");
                $NombreServicios = '';
                while($row = mysql_fetch_array($QueryNombreServicio)){
                    $NombreServicios = $row[0];
                }
                echo "<tr id='$Id'>";
                echo "<td class='text-md bg$Id'>$this->Rut</td>";
                echo "<td class='text-md bg$Id'>$Codigo</td>";
                echo "<td class='text-md bg$Id'>".utf8_encode($NombreServicios)."</td>";
                echo "<td class='text-md bg$Id'>".utf8_encode($Descripcion)."</td>";
                echo "<td class='text-md bg$Id'><center><i class='fa fa-search VerServicio'></i></center></td>";
                echo "</tr>";

            }
            echo '</tbody></table>';
        }
        else
        {
            echo "<b>Servicios Contratados</b>";
            echo "<div class='list-divider'></div>";
            echo "Cliente no tiene Servicios Agregados , Agregue Servicio <i class='fa fa-plus-square'  ></i>";
        }
        
    }
    public function VerDatosTecnicos($Rut,$Id){
        $this->Rut=$Rut;
        $this->Id = $Id;
        $QueryDatos=mysql_query("SELECT ip,ap,estacion,senal,senal_actual,mac FROM Datos_Tecnicos WHERE rut=$this->Rut AND id_servicio = $this->Id");
        if(mysql_num_rows($QueryDatos)>0){
            while($row=mysql_fetch_array($QueryDatos))
            {
                $Ip = $row[0];
                $Ap = $row[1];
                $Estacion  =$row[2];
                $Senal =$row[3];
                $SenalActual  =$row[4];
                $Mac =$row[5];
                echo "<br>";
                echo "<b>Datos Técnicos</b>";
                echo "<div class='list-divider'></div>";
                
                
                echo '<div class="row">';
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Direccion IP</label>';
                echo "<input type='text'   disabled class='form-control' value='$Ip' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>AP</label>';
                echo "<input type='text'    disabled value='$Ap' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Estacion</label>';
                echo "<input type='text' disabled value='$Estacion' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Mac Address</label>';
                echo "<input type='text'  disabled  value='$Mac' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Señal de Instalación</label>';
                echo "<input type='text'  disabled  value='$Senal' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Señal Actual</label>';
                echo "<input type='text'  disabled value='$SenalActual' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '</div>'; 
                echo '<div class="row">';
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Direccion IP</label>';
                echo "<input type='text'   disabled class='form-control' value='$Ip' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>AP</label>';
                echo "<input type='text'    disabled value='$Ap' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Estacion</label>';
                echo "<input type='text' disabled value='$Estacion' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Mac Address</label>';
                echo "<input type='text'  disabled  value='$Mac' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Señal de Instalación</label>';
                echo "<input type='text'  disabled  value='$Senal' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '<div class="col-sm-2">';
                echo '<div class="form-group">';
                echo '<label>Señal Actual</label>';
                echo "<input type='text'  disabled value='$SenalActual' class='form-control' >";
                echo '</div>';
                echo '</div>'; 
                echo '</div>';
            }
        }
        else{
            
            echo "<br>";
            echo "<b>Datos Técnicos</b>";
            echo "<div class='list-divider'></div>";
            echo "Servicio no cuenta con Datos Técnicos Ingresados <i class='fa fa-alert></i>";
            
        }
        

    }
}
?>
