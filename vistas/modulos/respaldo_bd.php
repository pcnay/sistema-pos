<?php
	// Para respaldar la base de datos 
	// Se ejecuta desde la carpeta donde esta el arhivo "pos-2020...."
	// 		mysql -u root -p pos(nombre BaseDeDatos) < pos-20200906-191217.sql (archivo que tiene la 		informacion respaldada)
	//
	echo "Iniciando el respaldo ... ";
  $db_host = 'localhost';
  $db_name = 'pos';
  $db_user = 'ventas-pos';
  $db_pass = 'pcnay2003';

  $fecha = date("Ymd-His");
  $salida_sql = $db_name.'-'.$fecha.'.sql';
  $dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
  system($dump,$output);
  // Se puede ejecutar la funcion : phpinfo() y buscar el comando “zip”, si no esta habilitadora en el archivo ( php.ini ) se descomenta.

  $zip = new ZipArchive();
  $salida_zip = $db_name.'-'.$fecha.'.zip';
  if ($zip->open($salida_zip,ZIPARCHIVE::CREATE) == true)
  {
    $zip->addFile($salida_sql);
    $zip->close();  
    
    // Para borrar el archivo .sql
    //unlink ($salida_sql); 
    //unlink ($salida_zip); 

    // para que muestre como descarga desde un navegador.
    //header ("Location: $salida_zip");
    
  }
  else
  {
    echo "Error";
  }


?>
  