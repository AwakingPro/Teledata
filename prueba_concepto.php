<?php

$link = mysql_connect("localhost", "root", "s9q7l5.,777")
    or die("Could not connect : " . mysql_error());
mysql_select_db("SPOTMANAGER") or die("Could not select database");


$q1 = mysql_query("SELECT id_hotspot,fecha_reporte,codigo_ap,fecha_reporte2 FROM reporte_diario WHERE fecha_reporte BETWEEN '2016-12-20' AND '2016-12-20'");
while($f1 = mysql_fetch_array($q1))
{
        $id_hotspot = $f1[0];
        $fecha_reporte = $f1[1];
        $codigo_ap = $f1[2];
        $fecha_reporte2 = $f1[3];


        $r1 = rand(6, 19);
        $q2 = mysql_query("SELECT codigo_ap,mac,dispositivo,fecha_inicio,numero_servicio,region,comuna,localidad FROM REP_Mac WHERE codigo_ap = '$codigo_ap'  ORDER BY RAND() LIMIT $r1");
        while($f2 = mysql_fetch_array($q2))
        {
                $codigo_ap2 = $f2[0];
                $mac = $f2[1];
                $dispositivo = $f2[2];
                $fecha_inicio = $f2[3];
                $numero_servicio = $f2[4];
                $region = $f2[5];
                $comuna= $f2[6];
                $localidad = $f2[7];
                $r2 = rand(8, 22);
                if (strlen($r2)==1)
                {
                        $r2 = "0".$r2;
                }
                else
                {
                        $r2 = $r2;
                }
                $r3= rand(1,59);
                if (strlen($r3)==1)
                {
                        $r3 = "0".$r3;
                }
 		else
                {
                        $r3 = $r3;
                }
                $r4= rand(1,59);
                if (strlen($r4)==1)
                {
                        $r4 = "0".$r4;
                }
                else
                {
                        $r4 = $r4;
                }
                $hora = $r2.":".$r3.":".$r4;
                $r5= rand(300,1800);
                $uptime = ($r5 / 60);
                if($uptime<=900)
                {
                        $r_bajada = rand(2,9);
                        $r_subida = rand(2,9);
                        $bajada = (rand(490,5000)/$r_bajada);
                        $bajada = round($bajada, 1);
                        $bajada = str_replace('.',',',$bajada);
                        $subida = (rand(10,200)/$r_subida);
                        $subida = round($subida, 1);
                        $subida = str_replace('.',',',$subida);
                }
                else
                {
                        $r_bajada = rand(2,9);
                        $r_subida = rand(2,9);
                        $bajada = (rand(1000,10010)/$r_bajada);
                        $bajada = round($bajada, 1);
                        $bajada = str_replace('.',',',$bajada);
                        $subida = (rand(20,400)/$r_subida);
                        $subida = round($subida, 1);
                        $subida = str_replace('.',',',$subida);
                }
                $uptime = round($uptime, 1);
                $uptime= str_replace('.',',',$uptime);
                $nuevafecha = strtotime ( "+ $r5 second" , strtotime ( $hora ) ) ;
                $nuevafecha = date ( 'H:i:s' , $nuevafecha );
                $q3 = mysql_query("SELECT url FROM REP_Url ORDER BY RAND() LIMIT 1");
 while($f3 = mysql_fetch_array($q3))
                {
                        $url = $f3[0];
                }
                $hora_inicio_sesion = $r2.":".$r3.":".$r4;
                $hora_termino_sesion = $nuevafecha;
                echo $hora = "Hora Inicio : ".$r2.":".$r3.":".$r4."- Hora Termino : ".$nuevafecha." + $r5 segundos , Mac : ".$mac." , Codigo AP = ".$codigo_ap."fecha : ".$fecha_reporte."fecha 2 : ".$fecha_reporte2." uptime = ".$uptime." Subida = ".$subida." Bajada =".$bajada."url = ".$url."<br>";

                //mysql_query("INSERT INTO mac_usuarios_reportes(fecha_inicio, rut_empresa, digito_verificador, codigo_sti, fecha_inicio_sesion, hora_inicio_sesion, fecha_termino_sesion, hora_termino_sesion, mac, numero_servicio, uptime, uptime_real, id_status, dispositivo, codigo_ap, region, comuna, localidad, fecha_inicio_sesion2, fecha_termino_sesion2, host_ip, link_orig, bits_in, bits_out, uptime_subtel) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25])");

                mysql_query("INSERT INTO mac_usuarios_reportes(fecha_inicio,fecha_inicio_sesion,hora_inicio_sesion,fecha_termino_sesion,hora_termino_sesion,numero_servicio,dispositivo,codigo_ap,region,comuna,localidad,fecha_inicio_sesion2,fecha_termino_sesion2,link_orig,bits_in,bits_out,uptime_subtel,mac,id_status) VALUES ('$fecha_inicio','$fecha_reporte2','$hora_inicio_sesion','$fecha_reporte2','$hora_termino_sesion','$numero_servicio','$dispositivo','$codigo_ap','$region','$comuna','$localidad','$fecha_reporte','$fecha_reporte','$url','$bajada','$subida','$uptime','$mac','2')");

        }

}

//Repositorio para mac address
//mysql_query("INSERT INTO REP_Mac (mac,dispositivo,codigo_ap,fecha_inicio,numero_servicio,region,comuna,localidad) SELECT mac,dispositivo,codigo_ap,fecha_inicio,numero_servicio,region,comuna,localidad FROM mac_usuarios_reportes");

//Repositorio para URL
//mysql_query("INSERT INTO REP_Url (url) SELECT link_orig FROM mac_usuarios_reportes");

mysql_close($link);
?>
