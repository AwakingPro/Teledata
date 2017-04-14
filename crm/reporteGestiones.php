<?php
require_once('../db/db.php');
class Reporte
{
  public function gestEjecPeriodo($cedente,$fecha_ini,$fecha_fin){
    $this->cedente = $cedente;
    $this->fecha_ini = $fecha_ini;
    $this->fecha_fin = $fecha_fin;
    $q1 = mysql_query("SELECT DISTINCT nombre_ejecutivo FROM gestion_ult_semestre WHERE cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin' ORDER BY nombre_ejecutivo ASC");
    $c = mysql_num_rows($q1);

    echo '<table id="t_gest_ejec_per" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    echo '<thead>';
    echo '<th class="text-sm"><center>Usuario</center></th>';
    echo '<th class="text-sm"><center>Cantidad Gestiones</center></th>';
    echo '<th class="text-sm"><center>Contacto Titular</center></th>';
    echo '<th class="text-sm"><center>Contacto Tercero</center></th>';
    echo '<th class="text-sm"><center>Administrativa</center></th>';
    echo '<th class="text-sm"><center>Sin Contacto</center></th>';
    echo '</thead>';

    echo '<tbody>';
    if ($c == 0) {
      echo "<tr>";
      echo "<td colspan='6' class='text-sm'><center>No se han realizado gestiones en el periodo seleccionado</center></td>";
      echo "</tr>";
    }
    else {
      while($r = mysql_fetch_array($q1)){
        $qcg = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE nombre_ejecutivo = '$r[0]' and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_tot = mysql_num_rows($qcg);
        $qcg2 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion IN (1,5) and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_tit = mysql_num_rows($qcg2);
        $qcg3 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion = 2 and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_ter = mysql_num_rows($qcg3);
        $qcg4 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion = 9 and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_adm = mysql_num_rows($qcg4);
        $qcg5 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE nombre_ejecutivo = '$r[0]' and Id_TipoGestion IN (3,4) and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_sc = mysql_num_rows($qcg5);
        echo "<tr>";
        echo "<td class='text-sm'><center>$r[0]</center></td>";
        echo "<td class='text-sm'><center>$gest_tot</center></td>";
        echo "<td class='text-sm'><center>$gest_tit</center></td>";
        echo "<td class='text-sm'><center>$gest_ter</center></td>";
        echo "<td class='text-sm'><center>$gest_adm</center></td>";
        echo "<td class='text-sm'><center>$gest_sc</center></td>";
        echo "</tr>";
      }

    }
    echo '</tbody>';
    echo '</table>';
  }
  public function gestCedPeriodo($cedente,$fecha_ini,$fecha_fin){
    $this->cedente = $cedente;
    $this->fecha_ini = $fecha_ini;
    $this->fecha_fin = $fecha_fin;
    $q1 = mysql_query("SELECT DISTINCT c.Nombre_Cedente,g.cedente FROM Cedente c, gestion_ult_semestre g WHERE c.Id_Cedente = g.cedente and g.cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin' ORDER BY nombre_ejecutivo ASC");
    $c = mysql_num_rows($q1);

    echo '<table id="t_gest_ced_per" class="table table-striped table-bordered" cellspacing="0" width="100%">';
    echo '<thead>';
    echo '<th class="text-sm"><center>Usuario</center></th>';
    echo '<th class="text-sm"><center>Cantidad Gestiones</center></th>';
    echo '<th class="text-sm"><center>Contacto Titular</center></th>';
    echo '<th class="text-sm"><center>Contacto Tercero</center></th>';
    echo '<th class="text-sm"><center>Administrativa</center></th>';
    echo '<th class="text-sm"><center>Sin Contacto</center></th>';
    echo '</thead>';

    echo '<tbody>';
    if ($c == 0) {
      echo "<tr>";
      echo "<td colspan='6' class='text-sm'><center>No se han realizado gestiones en el periodo seleccionado</center></td>";
      echo "</tr>";
    }
    else {
      while($r = mysql_fetch_array($q1)){
        $qcg = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_tot = mysql_num_rows($qcg);
        $qcg2 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE  Id_TipoGestion IN (1,5) and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_tit = mysql_num_rows($qcg2);
        $qcg3 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE Id_TipoGestion = 2 and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_ter = mysql_num_rows($qcg3);
        $qcg4 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE Id_TipoGestion = 9 and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_adm = mysql_num_rows($qcg4);
        $qcg5 = mysql_query("SELECT fechahora FROM gestion_ult_semestre WHERE Id_TipoGestion IN (3,4) and cedente=$this->cedente and fechahora BETWEEN '$this->fecha_ini' and '$this->fecha_fin'");
        $gest_sc = mysql_num_rows($qcg5);
        echo "<tr>";
        echo "<td class='text-sm'><center>$r[0]</center></td>";
        echo "<td class='text-sm'><center>$gest_tot</center></td>";
        echo "<td class='text-sm'><center>$gest_tit</center></td>";
        echo "<td class='text-sm'><center>$gest_ter</center></td>";
        echo "<td class='text-sm'><center>$gest_adm</center></td>";
        echo "<td class='text-sm'><center>$gest_sc</center></td>";
        echo "</tr>";
      }

    }
    echo '</tbody>';
    echo '</table>';
  }
}
?>
