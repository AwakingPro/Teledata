<?php
$array_central = array();
$sql = mysql_query("SELECT id,id_subquery FROM SIS_Querys WHERE id_estrategia = $id_estrategia AND Id_Cedente = $cedente ");
while($row = mysql_fetch_array($sql))
{
  $id = $row[0];
  $id_subquery = $row[1];
  if($id_subquery==0)
  {
    array_push($array_central, $id);
    $sql2 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
    while($row = mysql_fetch_array($sql2))
    {
      $id = $row[0];
      array_push($array_central, $id);
      $sql3 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
      while($row = mysql_fetch_array($sql3))
      {
        $id = $row[0];
        array_push($array_central, $id);
        $sql4 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
        while($row = mysql_fetch_array($sql4))
        {
          $id = $row[0];
          array_push($array_central, $id);
          $sql5 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
          while($row = mysql_fetch_array($sql5))
          {
            $id = $row[0];
            array_push($array_central, $id);
            $sql6 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
            while($row= mysql_fetch_array($sql6))
            {
              $id = $row[0];
              array_push($array_central, $id);
              $sql7 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
              while($row= mysql_fetch_array($sql7))
              {
                $id = $row[0];
                array_push($array_central, $id);
                $sql8 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                while($row= mysql_fetch_array($sql8))
                {
                  $id = $row[0];
                  array_push($array_central, $id);
                  $sql9 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                  while($row= mysql_fetch_array($sql9))
                  {
                    $id = $row[0];
                    array_push($array_central, $id);
                    $sql10 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                    while($row= mysql_fetch_array($sql10))
                    {
                      $id = $row[0];
                      array_push($array_central, $id);
                      $sql11= mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                      while($row= mysql_fetch_array($sqL11))
                      {
                        $id = $row[0];
                        array_push($array_central, $id);
                        $sql12 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                        while($row= mysql_fetch_array($sql12))
                        {
                          $id = $row[0];
                          array_push($array_central, $id);
                          $sql13 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                          while($row= mysql_fetch_array($sql13))
                          {
                            $id = $row[0];
                            array_push($array_central, $id);
                            $sql14 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                            while($row= mysql_fetch_array($sql14))
                            {
                              $id = $row[0];
                              array_push($array_central, $id);
                              $sql15 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                              while($row= mysql_fetch_array($sql15))
                              {
                                $id = $row[0];
                                array_push($array_central, $id);
                                $sql16 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                                while($row= mysql_fetch_array($sql16))
                                {
                                  $id = $row[0];
                                  array_push($array_central, $id);
                                  $sql17 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
                                  while($row= mysql_fetch_array($sql17))
                                  {
                                    $id = $row[0];
                                    array_push($array_central, $id);
                                    $sql18 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id AND Id_Cedente = $cedente ");
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
?>




