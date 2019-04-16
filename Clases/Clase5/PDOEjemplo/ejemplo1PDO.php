<?php
                        try
                        {

                          $db = new PDO('mysql:host=localhost;dbname=cdcol;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                          $sql = $db->query('SELECT titel as titulo,interpret as cantante, jahr as año  FROM cds ');

                          
                          $catidadFilas = $sql->rowCount();


                          echo "cantidad de filas: ".$catidadFilas."<br>";


                          $resultado = $sql->fetchall();
                       
                          
                            foreach($resultado as $fila)
                            {
                              echo "titulo: ".$fila[0];
                              echo "-- Año: ".$fila[2];
                              echo "-- Cantante: ". $fila['cantante'].'<br />';

                            }

                          
                         
                        } 
                        catch(PDOException $ex)
                        {
                          echo "error ocurrido!"; 
                            echo $ex->getMessage();
                        }
                    ?>