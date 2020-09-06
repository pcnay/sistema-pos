<?php
	include_once("db_connect.php");

	if(isset($_POST['import_data']))
	{
		// validate to check uploaded file is a valid csv file
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				while(($emp_record = fgetcsv($csv_file)) !== FALSE)
				{
					// Check if employee already exists with same email
					$sql_query = "SELECT id, id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta, ventas, fecha FROM t_Productos WHERE codigo = '".$emp_record[2]."'";
					$resultset = mysqli_query($conn, $sql_query) or die("database error: - Select". mysqli_error($conn));

					// if employee already exist then update details otherwise insert new record
					if(mysqli_num_rows($resultset)) 
					{
						//print_r(' Fecha  = '.$emp_record[8]);
						$sql_update = "UPDATE t_Productos set id_categoria ='".$emp_record[1]."', codigo ='".$emp_record[2]."',descripcion ='".$emp_record[3]."',imagen ='".$emp_record[4]."',stock ='".$emp_record[6]."',precio_venta ='".$emp_record[7]."',precio_venta ='".$emp_record[8]."',ventas ='".$emp_record[9]."',fecha ='".$emp_record[10]."' WHERE codigo = '".$emp_record[2]."'";
						mysqli_query($conn, $sql_update) or die("database error: - Update". mysqli_error($conn));
					} 
					else
					{
						//print_r('id_categoria = '.$emp_record[1]);
						//print_r('codigo = '.$emp_record[2]);
						//print_r('descripcion = '.$emp_record[3]);						
						//print_r('stock = '.$emp_record[6]);
						//print_r('precio_compra = '.$emp_record[7]);
						//print_r('precio_venta = '.$emp_record[8]);
						

						$mysql_insert = "INSERT INTO t_Productos (id_categoria,codigo,descripcion,stock,precio_compra,precio_venta)VALUES('".$emp_record[1]."', '".$emp_record[2]."', '".$emp_record[3]."','".$emp_record[6]."','".$emp_record[7]."','".$emp_record[8]."')";
						mysqli_query($conn, $mysql_insert) or die("database error: - Insert ". mysqli_error($conn));
					}

				} //while(($emp_record = fgetcsv($csv_file)) !== FALSE)


				fclose($csv_file);
				$import_status = '?import_status=success';
			}
			else
			{
				$import_status = '?import_status=error';

			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} 
		else
		{
			$import_status = '?import_status=invalid_file';

		} // if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))

	} // if(isset($_POST['import_data']))

	header("Location: index.php".$import_status);

?>
