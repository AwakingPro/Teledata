// comentarios
<?php

define('HOST1','192.168.1.91'); 
define('USER1','svergara');
define('PASS1','svergara.2012');
define('DBNAME1','reporteria');
define('HOST2','192.168.1.122');
define('USER2','root');
define('PASS2','s9q7l5.,777');
define('DBNAME2','foco');
 
 
class BaseDatos
{
    protected $conexion1;
    protected $db1;
    protected $conexion2;
    protected $db2;
 
    public function conectar()
    {
        $this->conexion1 = mysql_connect(HOST1, USER1, PASS1);
        if ($this->conexion1 == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
        $this->db1 = mysql_select_db(DBNAME1, $this->conexion1);
        if ($this->db1 == 0) DIE("Lo sentimos, no se ha podido conectar con la base datos: " . DBNAME1);
        $this->conexion2 = mysql_connect(HOST2, USER2, PASS2);
        if ($this->conexion2 == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
        $this->db2 = mysql_select_db(DBNAME2, $this->conexion2);
        if ($this->db2 == 0) DIE("Lo sentimos, no se ha podido conectar con la base datos: " . DBNAME2);
        return true;
    }
 
    public function desconectar()
    {
        if ($this->conectar->conexion1) {
            mysql_close($this->$conexion1);
        }
        if ($this->conectar->conexion2) {
            mysql_close($this->$conexion2);
        }
 
    }
 
    public function pruebadb($var)
    {
        $this->var=$var;
        if($this->var==1)
        {   
            $query = mysql_query("SELECT * FROM gestion_ult_trimestre WHERE fechahora > CURDATE()-1",$this->conexion1);
            while($row = mysql_fetch_array($query))
            {
                $rut = $row['rut_cliente'];
                $fecha_gestion = $row['fecha_gestion'];
                $hora_gestion = $row['hora_gestion'];
                $fechahora = $row['fechahora'];
                $resultado = $row['resultado'];
                $subrespuesta = $row['subrespuesta'];
                $observacion = $row['observacion'];
                $fono_discado = $row['fono_discado'];
                $lista = $row['lista'];
                $nombre_ejecutivo = $row['nombre_ejecutivo'];
                $nombre_grabacion = $row['nombre_grabacion'];
                $duracion = $row['duracion'];
                $cedente = $row['cedente'];
                $fec_compromiso = $row['fec_compromiso'];
                $origen = $row['origen'];
                $id_eje = $row['id_eje'];
                $monto_comp = $row['monto_comp'];

                mysql_query("INSERT IGNORE INTO gestion (rut_cliente,fecha_gestion,hora_gestion,fechahora,resultado,subrespuesta,observacion,fono_discado,lista,nombre_ejecutivo,nombre_grabacion,duracion,cedente,fec_compromiso,origen,id_eje,monto_comp) VALUES ('$rut','$fecha_gestion','$hora_gestion','$fechahora','$resultado','$subrespuesta','$observacion','$fono_discado','$lista','$nombre_ejecutivo','$nombre_grabacion','$duracion','$cedente','$fec_compromiso','$origen','$id_eje','$monto_comp')",$this->conexion2);

            }
            
        }
        else
        {
            $query = mysql_query("SELECT Rut,codigo_pais,codigo_area,numero_telefono,formato_dial,formato_subtel,tipo_fono,fecha_carga,cedente FROM fono WHERE fecha_carga >= '2016-12-09' AND length(formato_subtel)=9 ",$this->conexion1);
            while($row = mysql_fetch_array($query))
            {
                $var1 = $row['Rut'];
                $var2 = $row['codigo_pais'];
                $var3 = $row['codigo_area'];
                $var4 = $row['numero_telefono'];
                $var5 = $row['formato_dial'];
                $var6 = $row['formato_subtel'];
                $var7 = $row['tipo_fono'];
                $var8 = $row['fecha_carga'];
                $var9 = $row['cedente'];
                mysql_query("INSERT IGNORE INTO fono_cob (Rut,codigo_pais,codigo_area,numero_telefono, formato_dial, formato_subtel,tipo_fono, fecha_carga,cedente) VALUES ('$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9')");
            }
            
            
        }    
    }    
}
?>
