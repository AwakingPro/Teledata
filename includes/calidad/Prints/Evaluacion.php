<?php
    include_once("../../../includes/functions/Functions.php");
    Prints_IncludeClasses("calidad");
    Prints_IncludeClasses("personal");
    Prints_IncludeClasses("db");

    $CalidadClass = new Calidad();
    $PersonalClass = new Personal();
    $CalidadClass->Id_Grabacion = "24";
    $Evaluation = $CalidadClass->getEvaluationByUser();
    $Evaluation = $Evaluation[0];
    $PersonalClass->id = $Evaluation["Id_Personal"];
    $Personal = $PersonalClass->getPersonal();
    $Personal = $Personal[0];
    $CalidadClass->Id_Evaluacion = $Evaluation["id"];
    $EvaluationDetails = $CalidadClass->getEvaluationDetails();
    ob_start(); 
?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teledata</title>
    </head>
    <body>
        <div class="row">
            <h4>CALIFICACIÓN GENERAL DE LA EVALUACIÓN DE <?php echo strtoupper($Personal["Nombre"]); ?></h4>
            <table cellspacing="0">
                <tr>
                    <th align=center style=" background-color: #273441; color: #FFFFFF; padding: 10px 0px;">Descripción</th>
                    <th align=center style=" background-color: #273441; color: #FFFFFF; padding: 10px 0px;">Ponderación</th>
                    <th align=center style=" background-color: #273441; color: #FFFFFF; padding: 10px 0px;">Nota</th>
                    <th align=center style=" background-color: #273441; color: #FFFFFF; padding: 10px 0px;">Calificación<br>Ponderada</th>
                    <th align=center style=" background-color: #273441; color: #FFFFFF; padding: 10px 0px;">Observación</th>
                </tr>
                <tbody>
                    
                    <?php
                        $SumPonderacion = 0;
                        $SumNota = 0;
                        $SumCalfPonderada = 0;
                        foreach($EvaluationDetails as $Detail){
                        ?>
                            <tr style="padding: 10px 0px; background-color: #f9f9f9;">
                                <td style="padding: 10px 5px;" width=344><?php echo $Detail["Descripcion"]; ?></td>
                                <td style="padding: 10px 5px;" width=50 align=right><?php echo $Detail["Ponderacion"]; ?>%</td>
                                <td style="padding: 10px 5px;" width=50 align=right><?php echo $Detail["Nota"]; ?></td>
                                <td style="padding: 10px 5px;" width=50 align=right><?php echo $Detail["CalificacionPonderada"]; ?>%</td>
                                <td style="padding: 10px 5px;" width=184 align=center><?php echo $Detail["ObservacionText"]; ?></td>
                            </tr>
                        <?php
                            $SumPonderacion += floatval($Detail["Ponderacion"]);
                            $SumNota += floatval($Detail["Nota"]);
                            $SumCalfPonderada += floatval($Detail["CalificacionPonderada"]);
                        }
                        $NotaAverage = $SumNota / count($EvaluationDetails);
                    ?>
                    <tr style="padding: 10px 0px; background-color: #273441; color: #FFFFFF">
                        <td style="padding: 10px 5px;" width=344 align=right>TOTAL:</td>
                        <td style="padding: 10px 5px; font-weight: bold;" width=50 align=right><?php echo number_format($SumPonderacion, 2, '.', ''); ?>%</td>
                        <td style="padding: 10px 5px; font-weight: bold;" width=50 align=right><?php echo number_format($NotaAverage, 2, '.', '') ?></td>
                        <td style="padding: 10px 5px; font-weight: bold;" width=50 align=right><?php echo number_format($SumCalfPonderada, 2, '.', ''); ?>%</td>
                        <td style="padding: 10px 5px;" width=184 align=center></td>
                    </tr>
                </tbody>
            </table>
            <div class="BreakLine" style="width: 100%; height: 25px;"></div>
            <table cellspacing="0" width=800>
                <tr style="background-color: #273441; color: #FFFFFF">
                    <td width=775 style="padding: 10px 5px;">ASPECTOS A FORTALECER</td>
                </tr>
                <tr>
                    <td width=775 style="padding: 10px 5px; 20px 5px">
                        <?php echo $Evaluation["Aspectos_Fortalecer"]; ?> 
                    </td>
                </tr>
                <tr style="background-color: #273441; color: #FFFFFF">
                    <td width=775 style="padding: 10px 5px;">ASPECTOS A CORREGIR</td>
                </tr>
                <tr>
                    <td width=775 style="padding: 10px 5px; 20px 5px">
                        <?php echo $Evaluation["Aspectos_Corregir"]; ?> 
                    </td>
                </tr>
                <tr style="background-color: #273441; color: #FFFFFF">
                    <td width=775 style="padding: 10px 5px;">COMPROMISO DEL EJECUTIVO</td>
                </tr>
                <tr>
                    <td width=775 style="padding: 10px 5px; 20px 5px">
                        <?php echo $Evaluation["Compromiso_Ejecutivo"]; ?> 
                    </td>
                </tr>
            </table>
            <div class="BreakLine" style="width: 100%; height: 25px;"></div>
            <table width=800 style="width: 100%;">
                <tr>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">__________________________________</td>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">__________________________________</td>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">__________________________________</td>
                </tr>
                <tr>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">Ejecutivo</td>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">Supervisor</td>
                    <td width=200 align=center style="padding: 10px 5px; 20px 5px">Calidad</td>
                </tr>
            </table>
        </div>
    </body>
</html>
<?php
    $content = ob_get_clean();

	// convert in PDF
    include("../../html2pdf/class/html2pdf.class.php");
    include("../../html2pdf/class/exception.class.php");
    include("../../html2pdf/class/locale.class.php");
    include("../../html2pdf/class/myPdf.class.php");
    include("../../html2pdf/class/parsingHtml.class.php");
    include("../../html2pdf/class/parsingCss.class.php");
    try
    {
        $html2pdf = new HTML2PDF('P','A4', 'es', true, 'UTF-8', array(0,0,0,0));
      	//$html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('pdf.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>