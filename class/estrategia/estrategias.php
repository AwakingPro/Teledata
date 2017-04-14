<?php
include("../../db/db.php");
class Estrategia
{    
 
    public function MostrarTablas($IdCedente,$IdTipoEstrategia,$IdEstrategia)
    {
        $this->IdCedente=$IdCedente;
        $this->IdTipoEstrategia=$IdTipoEstrategia;
        $this->IdEstrategia=$IdEstrategia;
        
        $QueryTablaCedente = mysql_query("SELECT id,nombre FROM SIS_Tablas WHERE FIND_IN_SET($this->IdCedente,Id_Cedente) AND  tipo=$this->IdTipoEstrategia");


        if($IdTipoEstrategia==1)
        {
            $VerificaEstrategia = mysql_query("SELECT id_estrategia FROM SIS_Querys_Estrategias WHERE id_estrategia = $IdEstrategia AND tipo = 0");
            if(mysql_num_rows($VerificaEstrategia)==0)
            {
                echo 0;
            }
            else
            {
                echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="SeleccioneTabla">';
                echo '<option value="-1">Seleccione Tabla</option>';
                while($row=mysql_fetch_array($QueryTablaCedente))
                {
                    
                    $Id = $row[0];
                    $Nombre = $row[1];
                    echo "<option value='$Id'>".$Nombre."</option>";
                }
                echo '</select>';
            }
        }
        else
        {
            echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="SeleccioneTabla">';
            echo '<option value="-1">Seleccione Tabla</option>';
            while($row=mysql_fetch_array($QueryTablaCedente))
            {
                
                $Id = $row[0];
                $Nombre = $row[1];
                echo "<option value='$Id'>".$Nombre."</option>";
            }
            echo '</select>';
        }
        

       
    }

    public function MostrarColumnas($IdTabla)
    {
        session_start();
        $Id_Cedente = $_SESSION['cedente'];
        session_start();
        $this->IdTabla=$IdTabla;

        $QueryTablaId = mysql_query("SELECT id,columna FROM SIS_Columnas_Estrategias WHERE id_tabla=$this->IdTabla and FIND_IN_SET($Id_Cedente,Id_Cedente)");
        echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="SeleccioneColumna">';
        echo '<option value="-1">Seleccione Columna</option>';
        while($row=mysql_fetch_array($QueryTablaId))
        {
            $Id = $row[0];
            $Nombre = $row[1];
            echo "<option value='$Id'>".$Nombre."</option>";
        }
        echo '</select>';
        echo "<input type='hidden' value='$Id' id='Id'>";
    }

    public function MostrarLogica($IdColumna)
    {
        $this->IdColumna=$IdColumna;
        $QueryLogica = mysql_query("SELECT logica,tipo_dato FROM SIS_Columnas_Estrategias WHERE id=$this->IdColumna");
        while($row=mysql_fetch_array($QueryLogica))
        {
            $Logica = $row[0];
        }
        echo '<select   class="selectpicker" data-live-search="true" data-width="100%" id="SeleccioneLogica">';
        echo '<option value="-1">Seleccione Lógica</option>';
        if($Logica==1)
        {
            echo "<option value='='>Igual</option>";
            echo "<option value='!='>Distinto</option>";
        }
        else
        {
            echo "<option value='<'>Menor</option>";
            echo "<option value='>'>Mayor</option>";
            echo "<option value='='>Igual</option>";
            echo "<option value='<='>Menor o Igual</option>";
            echo "<option value='>='>Mayor o Igual</option>";
            echo "<option value='!='>Distinto</option>";
        }
        echo '</select>';
    }

    public function MostrarValor($IdLogica,$Id)
    {
        $this->Id=$Id;
        $TipoDato='';
        $QueryTipo = mysql_query("SELECT tipo_dato,columna,id_tabla,orden,Cedente FROM SIS_Columnas_Estrategias WHERE id=$this->Id");
        while($row=mysql_fetch_array($QueryTipo))
        {
            $TipoDato= $row[0];
            $Columna= $row[1];
            $Id_Tabla= $row[2];
            $Orden= $row[3];
            $SiCendente= $row[4];
        }
        $Tabla = '';
        $QueryTabla = mysql_query("SELECT nombre FROM SIS_Tablas WHERE id = $Id_Tabla");
        while($row = mysql_fetch_array($QueryTabla)){
            $Tabla = $row[0];
        }
        
        if($TipoDato==0)
        {
            echo 0;
        }
        elseif($TipoDato==1)
        {
            echo 1;   
        }
        elseif($TipoDato==3)
        {
            if($Orden == 0){
                $OrdenQuery = "ORDER BY ".$Columna." ASC";
            }else{
                $OrdenQuery = "ORDER BY ".$Columna." DESC";
            }
            echo '<select   class="selectpicker" data-live-search="true" multiple data-width="100%" id="SeleccioneValor">';
            $QueryValores = mysql_query("SELECT $Columna FROM $Tabla GROUP BY $Columna $OrdenQuery");
            while($row=mysql_fetch_array($QueryValores))
            {
                $Valor = $row[0];
                if($Valor == ''){
                }else{
                    echo "<option value='$Valor'>".$Valor."</option>";
                }
            }
            echo '</select>';
        }
        elseif($TipoDato==4)
        {

            echo '<select   class="selectpicker" data-live-search="true" multiple data-width="100%" id="SeleccioneValor">';
            echo "<option value='1'>Tiene ".$Columna."</option>"; 
            echo '</select>';
        }

        elseif($TipoDato==5)
        {
            echo '<select   class="selectpicker" data-live-search="true" multiple data-width="100%" id="SeleccioneValor">';
            $QueryRelacion = mysql_query("SELECT Id_TipoContacto,Nombre FROM Tipo_Contacto WHERE Id_TipoContacto IN (1,2,3,4,5)");
            while($row = mysql_fetch_array($QueryRelacion)){
                $IdColumna = $row[0];
                $NombreColumna = $row[1];
                echo "<option value='$IdColumna'>".$NombreColumna."</option>"; 
            }
            echo '</select>';
        }
        
        else
        {
            echo '<input type="text" class="form-control " id="SeleccioneValor">';
            echo "<br>";
        }
    
    }

    public function CrearQuery($Valor,$Logica,$NombreCola,$IdColumna,$IdCedente,$IdEstrategia,$IdSubQuery,$IdTabla)
    {
        $this->Valor=$Valor;
        $findme   = ',';
        $pos = strpos($this->Valor, $findme);
        $Coma = 0;
        if($pos==true){
            $Coma = 1;
            $this->Valor = explode(",", $this->Valor);
            $this->Valor = implode('" , "',$this->Valor);
        }
        else
        {
            $this->Valor = $this->Valor;
        }

        

        $this->Logica=$Logica;
        $this->NombreCola=$NombreCola;
        $this->IdColumna=$IdColumna;
        $this->IdCedente=$IdCedente;
        $this->IdEstrategia=$IdEstrategia;
        $this->IdSubQuery=$IdSubQuery;
        $this->IdTabla=$IdTabla;
        $Query = '';
        $IfCedente = '';
        $QueryDatos = mysql_query("SELECT columna,id_tabla,tipo,id,Cedente,tipo_dato FROM SIS_Columnas_Estrategias WHERE id=$this->IdColumna");
        while($row=mysql_fetch_array($QueryDatos))
        {
            $Columna = $row[0];
            $Tipo = $row[2];
            $IfCedente = $row[4];
            $TipoDato = $row[5];
        }

        $QueryDatosTabla = mysql_query("SELECT nombre,tipo FROM SIS_Tablas WHERE id=$this->IdTabla");
         while($row=mysql_fetch_array($QueryDatosTabla))
        {
            $Tabla = $row[0];
            $Dinamica = $row[1];
        }

        if($Tipo ==1){
            $this->Valor = '"'.$this->Valor.'"';
        }
        else
        {
            $this->Valor = $this->Valor;
        }
        $QueryPositivaKA = "SELECT Rut FROM Persona WHERE ";
        $QueryPositivaKB = " AND FIND_IN_SET($this->IdCedente,Id_Cedente)";
        if($IfCedente==0){
            if($Coma==1){
                $QueryResumen = "(SELECT Rut FROM $Tabla WHERE $Columna IN ($this->Valor))";
            }else{
                $QueryResumen = "(SELECT Rut FROM $Tabla WHERE $Columna $this->Logica $this->Valor)";
            }
        }else{
            if($Coma==1){
                 $QueryResumen = "(SELECT Rut FROM $Tabla WHERE $Columna IN ($this->Valor) AND Id_Cedente = $this->IdCedente)";
            }else{
                $QueryResumen = "(SELECT Rut FROM $Tabla WHERE $Columna $this->Logica $this->Valor AND Id_Cedente = $this->IdCedente)";
            }
            $QueryResumen = "(SELECT Rut FROM $Tabla WHERE $Columna $this->Logica $this->Valor AND Id_Cedente = $this->IdCedente)";
        }
        if($TipoDato == 4){
            $QueryResumen = "(SELECT Rut FROM $Tabla)";
        }
        
       
        if($this->IdSubQuery==0)
        {
            $QueryPositiva = $QueryPositivaKA." Rut IN ".$QueryResumen.$QueryPositivaKB;
            $QueryNegativa = $QueryPositivaKA." Not Rut IN ".$QueryResumen.$QueryPositivaKB;
            $NumeroEspaciosTotal = 0;
        }
        else
        {
            $NumeroEspaciosTotal = 5;
            $QueryEspacios = mysql_query("SELECT espacios FROM SIS_Querys_Estrategias WHERE id=$IdSubQuery LIMIT 1");
            while($row=mysql_fetch_array($QueryEspacios))
            {
                $Espacios = $row[0];
            }
            $NumeroEspaciosTotal = $NumeroEspaciosTotal+$Espacios;
            
                
            
            $Array = array();
            $i=$this->IdSubQuery;
            while($i!=0)
            {
                $QueryIteracion = mysql_query("SELECT id,id_subquery FROM SIS_Querys_Estrategias WHERE id=$i");
                while($row = mysql_fetch_array($QueryIteracion))
                {
                    $IdQuery = $row[0];
                    $IdSubQueryIteracion = $row[1];
                    if($IdSubQueryIteracion==0)
                    {
                        array_push($Array,$IdQuery);
                    }
                    else
                    {
                        array_push($Array,$IdQuery);

                    } 
                }  
                $i=$IdSubQueryIteracion; 
            }

            $CantidadArray = count($Array);
            $k = 0;
            while($k <= $CantidadArray)
            {
                $QueryFinal = mysql_query("SELECT query_resumen,condicion,id_subquery FROM SIS_Querys_Estrategias WHERE id = $Array[$k]");
                $CondicionFinal = '';
                while($row=mysql_fetch_array($QueryFinal))
                {
                    $Query = $row[0]; 
                    $Condicion = $row[1];
                    $SubQuery = $row[2];
                    if($SubQuery==0)
                    {
                        $Comodin = '';
                    }
                    else
                    {
                        $Comodin = 'AND ';
                    }
                    $QueryResult  = $Comodin.$Condicion.$Query.$QueryResult;
                }
                
                
                $k++;
            }
            $QueryPositiva = $QueryPositivaKA.$QueryResult.$Comodin." AND Rut IN".$QueryResumen.$QueryPositivaKB;
            $QueryNegativa = $QueryPositivaKA.$QueryResult.$Comodin." AND NOT Rut IN".$QueryResumen.$QueryPositivaKB;


            

        }    

       
        $QueryExecPositiva = mysql_query($QueryPositiva);
        $CantidadRegistrosPositivos = mysql_num_rows($QueryExecPositiva);

        $QueryExecNegativa = mysql_query($QueryNegativa);
        $CantidadRegistrosNegativos = mysql_num_rows($QueryExecNegativa);

        $QueryDeudaPositiva = "SELECT SUM( d.Monto_Mora) FROM Persona p, Deuda d WHERE p.Rut IN ($QueryPositiva) AND p.Rut = d.Rut";
        $QueryDeudaExecPositiva = mysql_query($QueryDeudaPositiva);
        $MontoMoraPositiva = '';
        while($row = mysql_fetch_array($QueryDeudaExecPositiva))
        {
            $MontoMoraPositiva = $row[0];
        }
        
        $QueryDeudaNegativa = "SELECT SUM( d.Monto_Mora) FROM Persona p, Deuda d WHERE p.Rut IN ($QueryNegativa) AND p.Rut = d.Rut";
        $QueryDeudaExecNegativa = mysql_query($QueryDeudaNegativa);
        $MontoMoraNegativa = '';
        while($row = mysql_fetch_array($QueryDeudaExecNegativa))
        {
            $MontoMoraNegativa = $row[0];
        }

        mysql_query("UPDATE SIS_Querys_Estrategias SET carpeta='1' WHERE id=$this->IdSubQuery");
		


        //$QueryEscapePositiva = addslashes($QueryPositiva);
        $InsertarQueryPostiva = mysql_query("INSERT INTO SIS_Querys_Estrategias (query,monto,cola,cantidad,id_estrategia,query_resumen,condicion,id_subquery,Id_Cedente,columna,espacios,dinamica) VALUES ('$QueryPositiva','$MontoMoraPositiva','$NombreCola','$CantidadRegistrosPositivos','$this->IdEstrategia','$QueryResumen','Rut IN','$this->IdSubQuery','$this->IdCedente','$Columna','$NumeroEspaciosTotal','$Dinamica')");
        $InsertarQueryNegativa = mysql_query("INSERT INTO SIS_Querys_Estrategias (query,monto,cola,cantidad,id_estrategia,query_resumen,condicion,id_subquery,Id_Cedente,columna,espacios,dinamica) VALUES ('$QueryNegativa','$MontoMoraNegativa','Resto','$CantidadRegistrosNegativos','$this->IdEstrategia','$QueryResumen','NOT Rut IN','$this->IdSubQuery','$this->IdCedente','$Columna','$NumeroEspaciosTotal','$Dinamica')");


        ////Query Negativa
        //$QueryNegativa = "SELECT Rut FROM Persona WHERE NOT Rut IN (SELECT Rut FROM $Tabla WHERE $Columna $this->Logica $this->Valor) AND FIND_IN_SET($this->IdCedente,Id_Cedente)";
        //$QueryExecNegativa = mysql_query($QueryNegativa);
        //$CantidadRegistrosNegativos = mysql_num_rows($QueryExecNegativa);
        //$QueryDeudaNegativa = "SELECT SUM( d.Monto_Mora ) FROM Persona p, Deuda d WHERE NOT p.Rut IN (SELECT Rut FROM $Tabla WHERE $Columna $this->Logica $this->Valor) AND FIND_IN_SET( $this->IdCedente, p.Id_Cedente ) AND p.Rut = d.Rut";
        //$QueryDeudaExecNegativa = mysql_query($QueryDeudaNegativa);
        //$MontoMoraNegativa = '';
        //while($row = mysql_fetch_array($QueryDeudaExecNegativa))
        //{
        //    $MontoMoraNegativa = $row[0];
        //}

        //$QueryEscapeNegativa= addslashes($QueryNegativa);
        //$InsertarQueryNegativa = mysql_query("INSERT INTO SIS_Querys_Estrategias (query,monto,cola,cantidad,id_estrategia,query_resumen,condicion,id_subquery) VALUES ('$QueryEscapeNegativa','$MontoMoraNegativa','No Seleccionado','$CantidadRegistrosNegativos','$this->IdEstrategia','$QueryResumen','0','$this->IdSubQuery')");

    

        
        
    $Estrategia = new Estrategia();
    $Estrategia->MostrarEstrategias($this->IdEstrategia);
        
       

        

    }

    public function MostrarEstrategias($IdEstrategia)
    {
        
        $array_central=array();
        $this->IdEstrategia=$IdEstrategia;
        $sql = mysql_query("SELECT id,id_subquery FROM SIS_Querys_Estrategias WHERE id_estrategia = $this->IdEstrategia ");
        while($row = mysql_fetch_array($sql))
        {
        $id = $row[0];
        $id_subquery = $row[1];
        if($id_subquery==0)
        {
            array_push($array_central, $id);
            $sql2 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
            while($row = mysql_fetch_array($sql2))
            {
            $id = $row[0];
            array_push($array_central, $id);
            $sql3 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
            while($row = mysql_fetch_array($sql3))
            {
                $id = $row[0];
                array_push($array_central, $id);
                $sql4 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                while($row = mysql_fetch_array($sql4))
                {
                $id = $row[0];
                array_push($array_central, $id);
                $sql5 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                while($row = mysql_fetch_array($sql5))
                {
                    $id = $row[0];
                    array_push($array_central, $id);
                    $sql6 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                    while($row= mysql_fetch_array($sql6))
                    {
                    $id = $row[0];
                    array_push($array_central, $id);
                    $sql7 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                    while($row= mysql_fetch_array($sql7))
                    {
                        $id = $row[0];
                        array_push($array_central, $id);
                        $sql8 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                        while($row= mysql_fetch_array($sql8))
                        {
                        $id = $row[0];
                        array_push($array_central, $id);
                        $sql9 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                        while($row= mysql_fetch_array($sql9))
                        {
                            $id = $row[0];
                            array_push($array_central, $id);
                            $sql10 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                            while($row= mysql_fetch_array($sql10))
                            {
                            $id = $row[0];
                            array_push($array_central, $id);
                            $sql11= mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                            while($row= mysql_fetch_array($sqL11))
                            {
                                $id = $row[0];
                                array_push($array_central, $id);
                                $sql12 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                while($row= mysql_fetch_array($sql12))
                                {
                                $id = $row[0];
                                array_push($array_central, $id);
                                $sql13 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                while($row= mysql_fetch_array($sql13))
                                {
                                    $id = $row[0];
                                    array_push($array_central, $id);
                                    $sql14 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                    while($row= mysql_fetch_array($sql14))
                                    {
                                    $id = $row[0];
                                    array_push($array_central, $id);
                                    $sql15 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                    while($row= mysql_fetch_array($sql15))
                                    {
                                        $id = $row[0];
                                        array_push($array_central, $id);
                                        $sql16 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                        while($row= mysql_fetch_array($sql16))
                                        {
                                        $id = $row[0];
                                        array_push($array_central, $id);
                                        $sql17 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                        while($row= mysql_fetch_array($sql17))
                                        {
                                            $id = $row[0];
                                            array_push($array_central, $id);
                                            $sql18 = mysql_query("SELECT id FROM SIS_Querys_Estrategias WHERE id_subquery=$id");
                                            while($row= mysql_fetch_array($sql18))
                                            {
                                            $id = $row[0];
                                            array_push($array_central, $id);
                                            }
                                        }
                                        }
                                    }
                                    }
                                }
                                }
                            }
                            }
                        }
                        }
                    }
                    }
                }
                }
            }
            }  
        } 
        else 
        {
        }
        }  





        $QueryEstrategia = mysql_query("SELECT cola,id,espacios,cantidad,monto FROM SIS_Querys_Estrategias WHERE id_estrategia = $this->IdEstrategia ORDER BY id_subquery ASC");
        if(mysql_num_rows($QueryEstrategia)==0)
        {
            echo 0;
        }
        else
        {
            echo '<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">';
            echo '<thead>';
            echo '<tr>';
            echo "<th>Grupo</th>";
            echo '<th class="min-desktop"><center>Registros</center></th>';
            echo '<th class="min-desktop"><center>Monto</center></th>';
            echo '<th class="min-desktop"><center>Prioridad</center></th>';
            echo '<th class="min-desktop"><center>Comentario</center></th>';
            echo '<th class="min-desktop"><center>Segmentar</center></th>';
            echo '<th class="min-desktop"><center>Terminal</center></th>';

            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            $contar = count($array_central);
            $j=0;
            while($j<$contar)
            {
                $arre = $array_central[$j];
                $sq = mysql_query("SELECT cola,id,espacios,cantidad,monto,dinamica,carpeta,prioridad,comentario,terminal FROM SIS_Querys_Estrategias WHERE id=$arre");
                while($row=mysql_fetch_array($sq))
                {
            
                    $Id = $row[1];
                    $Cola = $row[0];
                    $Espacios = $row[2];
                    $Cantidad = $row[3];
                    $Monto = $row[4];
                    $Carpeta = $row[6];
                    $Prioridad = $row[7];
                    $Comentario = $row[8];
                    $Terminal = $row[9];
                    if($Terminal==0)
                    {
                        $Check = '';
                    }
                    else
                    {
                        $Check = 'checked';
                    }
                    if($Carpeta==1)
                    {
                        $Carpeta = "<i class='fa fa-folder-open'></i>";
                        $Dividir  = "";
                    }
                    else
                    {
                        $Carpeta = '';
                        $Dividir  = "<i class='fa fa-code-fork fa-lg btn SubEstrategia' ></i>";

                    }
                    if($Monto=='')
                    {
                        $Monto='0';
                    }
                    else
                    {
                        $Monto = number_format($Monto, 0, "", ".");
                    }
                    $Dinamica = $row[5];
                    $EspaciosHtmlTotal='';
                    $EspaciosHtml='&nbsp;';
                    $i=1;
                    $Sucess = 'text-primary';
                    while($i<$Espacios)
                    {
                        $EspaciosHtmlTotal=$EspaciosHtmlTotal.$EspaciosHtml;
                        $i++;
                    }
                    echo "<tr id=$Id>";
                    if($Dinamica==0)
                    {
                        echo "<td>".$EspaciosHtmlTotal.$Carpeta."<input type='text' id='K$Id' class='text-transparent-left Cola ' value='$Cola'></td>";
                        echo "<td><center><input type='text' readonly class='text-transparent-min' value='$Cantidad'></center></td>";
                        echo "<td><center><input type='text' readonly class='text-transparent-max' value='$ $Monto'></center></td>";
                        echo "<td><center><span ><input type='text'  class='text-transparent-min Prioridad' id='P$Id' value='$Prioridad'></center></td>";
                        echo "<td><center><span ><input type='text'  class='text-transparent-max Comentario' id='C$Id' value='$Comentario'></center></td>";
                        echo "<td><center>$Dividir</center></td>";
                        echo "<td><center><input type='checkbox'  $Check class='Terminal' id='T$Id'></center></td>";
                    }
                    else
                    {
                        echo "<td><span class='$Sucess'>".$EspaciosHtmlTotal.$Carpeta."<input type='text' id='K$Id' class='text-transparent-left Cola' value='$Cola'></span></td>";
                        echo "<td><center><span class='$Sucess'><input type='text' class='text-transparent-min' value='$Cantidad'></span></center></td>";
                        echo "<td><center><span class='$Sucess'><input type='text' class='text-transparent-max' value='$ $Monto'></span></center></td>";
                        echo "<td><center><span class='$Sucess'><input type='text'  class='text-transparent-min Prioridad' id='P$Id' value='$Prioridad'></span></center></td>";
                        echo "<td><center><span class='$Sucess'><input type='text'  class='text-transparent-max Comentario' id='C$Id' value='$Comentario'></span></center></td>";
                        echo "<td><center><span class='$Sucess'>$Dividir</span></center></td>";
                        echo "<td><center><span class='$Sucess'><input type='checkbox'  $Check class='Terminal' id='T$Id'></span></center></td>";
                    }
                    
                    
                    echo '</tr>';  
                }
                $j++;
            }
            
            echo '</tbody>';
            echo '</table>';
       }

    }

    public function ActualizarPrioridad($Id,$ValorPrioridad)
    {
        $this->Id=$Id;
        $this->ValorPrioridad=$ValorPrioridad;
        mysql_query("UPDATE SIS_Querys_Estrategias SET prioridad='$this->ValorPrioridad' WHERE id=$Id");

    }
    public function ActualizarComentario($Id,$ValorComentario)
    {
        $this->Id=$Id;
        $this->ValorComentario=$ValorComentario;
        mysql_query("UPDATE SIS_Querys_Estrategias SET comentario='$this->ValorComentario' WHERE id=$Id");

    }

    public function ActualizarCola($Id,$ValorCola)
    {
        $this->Id=$Id;
        $this->ValorCola=$ValorCola;
        mysql_query("UPDATE SIS_Querys_Estrategias SET cola='$this->ValorCola' WHERE id=$Id");

    }

    public function Deshacer($IdEstrategia)
    {
        $this->IdEstrategia=$IdEstrategia;
        $QueryDeshacer = mysql_query("SELECT id_subquery FROM SIS_Querys_Estrategias WHERE id_estrategia = $this->IdEstrategia ORDER BY id_subquery DESC LIMIT 1");
        while($row = mysql_fetch_array($QueryDeshacer))
        {
            $IdSubqueryDesahacer = $row[0];
            //mysql_query("DELETE FROM SIS_Querys_Estrategias WHERE id_subquery = $IdSubqueryDesahacer");
            mysql_query("UPDATE SIS_Querys_Estrategias SET carpeta='0' WHERE id = $IdSubqueryDesahacer");

        }
    }

    public function Terminal($IdTerminal,$Check)
    {
        $this->IdTerminal=$IdTerminal;
        $this->Check=$Check;
        mysql_query("UPDATE SIS_Querys_Estrategias SET terminal='$this->Check' WHERE id=$IdTerminal");

    }

    public function MoverGrupo($IdSubQuery)
    {
        $this->IdSubQuery=$IdSubQuery;
        $QueryRegistros = mysql_query("SELECT cola,monto,cantidad FROM SIS_Querys_Estrategias WHERE id = $this->IdSubQuery LIMIT 1");
        while($row = mysql_fetch_array($QueryRegistros))
        {
            echo $Cola= "Grupo : ".$row[0]." | ";
            echo $Monto= "Registros : ".number_format($row[2],0, "", ".")." | ";
            echo $Monto= "Monto : $ ".number_format($row[1], 0, "", ".")."";


        }
    }

    public function Total($IdCedente)
    {
        $this->IdCedente=$IdCedente;
        $QueryRegistrosTotal = mysql_query("SELECT fecha,Cant_Ruts,Deuda_Total FROM Historico_Carga WHERE Id_Cedente = $this->IdCedente ORDER BY fecha DESC LIMIT 1");
        if(mysql_num_rows($QueryRegistrosTotal)<1)
        {
            echo "Sin Información";
        }
        else
        {
            while($row = mysql_fetch_array($QueryRegistrosTotal))
            {
                echo $Cola= "Fecha Asignacion : ".$row[0]." | ";
                echo $Monto= "Registros : ".number_format($row[1],0, "", ".")." | ";
                echo $Monto= "Monto : $ ".number_format($row[2], 0, "", ".")." ";
            }
        }    
    }

    public function crearEstrategia($nombre_estrategia,$tipo_estrategia,$comentario,$fecha,$hora,$usuario,$cedente,$idUsuario)
	{
		$this->nombre_estrategia=$nombre_estrategia;
		$this->tipo_estrategia=$tipo_estrategia;
		$this->comentario=$comentario;
		$this->fecha=$fecha;
		$this->hora=$hora;
		$this->usuario=$usuario;
		$this->cedente=$cedente;
		$this->idUsuario=$idUsuario;

		$query=mysql_query("INSERT INTO SIS_Estrategias(nombre,comentario,fecha,hora,usuario,tipo,Id_Cedente,Id_Usuario) VALUES('$this->nombre_estrategia','$this->comentario','$this->fecha','$this->hora','$this->usuario','$this->tipo_estrategia',$this->cedente,$this->idUsuario)");
		$query1=mysql_query("SELECT id FROM SIS_Estrategias WHERE nombre='$this->nombre_estrategia' LIMIT 1");
        while($row = mysql_fetch_array($query1))
        {
            $IdEstrategia = $row[0];
        }

        session_start();
		$_SESSION['IdEstrategia'] = $IdEstrategia;
		session_start();


	}

    public function RecalculaQuery(){
        $SelectQuery = mysql_query("SELECT id,query,Id_Cedente FROM SIS_Querys_Estrategias");
        $Fecha = date('Y-m-d');
        while($row = mysql_fetch_array($SelectQuery)){

            $Id = $row[0];
            $Query  =$row[1];
            $Id_Cedente  =$row[2];
            $ColaFinal = "QR_".$Id_Cedente."_".$Id;

            $ExecQuery = mysql_query("SELECT SUM( d.Monto_Mora) FROM Persona p, Deuda d WHERE p.Rut IN ($Query) AND p.Rut = d.Rut");
             while($row = mysql_fetch_array($ExecQuery))
            {
                $MontoMora= $row[0];
            }

            $CantidadRegistros = mysql_num_rows(mysql_query($Query));
            mysql_query("UPDATE SIS_Querys_Estrategias SET cantidad=$CantidadRegistros,monto=$MontoMora WHERE id=$Id");
            $QueryConcat = mysql_query("SELECT  GROUP_CONCAT(Rut) FROM Persona WHERE Rut IN($Query) AND FIND_IN_SET($Id_Cedente,Id_Cedente)");
            while($row = mysql_fetch_array($QueryConcat)){
                $Concat = $row[0];
            }

            mysql_query("INSERT INTO Trazabilidad_Rut_Grupo(Rut, Cola_Trabajo, Fecha_Traza, Id_Cedente,Monto,Registros) VALUES ('$Concat','$ColaFinal','$Fecha','$Id_Cedente','$MontoMora','$CantidadRegistros')");
            $QueryRecupero = mysql_query("SELECT 
t.id,
MAX(ROUND( (r.Monto / t.Monto) *100 ))
FROM Recupero_Foco r, Trazabilidad_Rut_Grupo t
WHERE FIND_IN_SET( r.Rut, t.Rut ) GROUP BY t.id ");
            while($row=mysql_fetch_array($QueryRecupero)){
                $Id=$row[0];
                $Recupero = $row[1];
                //mysql_query("UPDATE Trazabilidad_Rut_Grupo SET Recupero=$Recupero WHERE id=$Id AND Fecha_Traza = '$Fecha'");
            }
                               
        } 
    }
    public function RecalculaQueryCedente($Cedente){
        $this->Id_Cedente = $Cedente;
        $SelectQuery = mysql_query("SELECT id,query,Id_Cedente FROM SIS_Querys_Estrategias WHERE Id_Cedente = $this->Id_Cedente");
        $Fecha = date('Y-m-d');
        while($row = mysql_fetch_array($SelectQuery)){

            $Id = $row[0];
            $Query  =$row[1];
            $Id_Cedente  =$row[2];
            $ColaFinal = "QR_".$Id_Cedente."_".$Id;

            $ExecQuery = mysql_query("SELECT SUM( d.Monto_Mora) FROM Persona p, Deuda d WHERE p.Rut IN ($Query) AND p.Rut = d.Rut");
             while($row = mysql_fetch_array($ExecQuery))
            {
                $MontoMora= $row[0];
            }

            $CantidadRegistros = mysql_num_rows(mysql_query($Query));
            mysql_query("UPDATE SIS_Querys_Estrategias SET cantidad=$CantidadRegistros,monto=$MontoMora WHERE id=$Id");
            $QueryConcat = mysql_query("SELECT  GROUP_CONCAT(Rut) FROM Persona WHERE Rut IN($Query) AND FIND_IN_SET($Id_Cedente,Id_Cedente)");
            while($row = mysql_fetch_array($QueryConcat)){
                $Concat = $row[0];
            }

            mysql_query("INSERT INTO Trazabilidad_Rut_Grupo(Rut, Cola_Trabajo, Fecha_Traza, Id_Cedente,Monto,Registros) VALUES ('$Concat','$ColaFinal','$Fecha','$Id_Cedente','$MontoMora','$CantidadRegistros')");
            $QueryRecupero = mysql_query("SELECT 
t.id,
MAX(ROUND( (r.Monto / t.Monto) *100 ))
FROM Recupero_Foco r, Trazabilidad_Rut_Grupo t
WHERE FIND_IN_SET( r.Rut, t.Rut ) GROUP BY t.id ");
            while($row=mysql_fetch_array($QueryRecupero)){
                $Id=$row[0];
                $Recupero = $row[1];
               // mysql_query("UPDATE Trazabilidad_Rut_Grupo SET Recupero=$Recupero WHERE id=$Id AND Fecha_Traza = '$Fecha'");
            }
                               
        } 
    }
}
?>
