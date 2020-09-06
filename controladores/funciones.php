<?php
	class EliminarDirectorio
	{
 
		// =============================================================
		// Eliminar directorios 
		// ============================================================
		//============= ELIMINAR UN DIRECTORIO ==========
		static public function eliminar_directorio($dir)
		{
			$result = false;
			if ($handle = opendir($dir))
			{
				$result = true;
				while ((($file=readdir($handle))!==false) && ($result))
				{
					if ($file!='.' && $file!='..')
					{
						if (is_dir($dir/$file))
						{
							$result = eliminar_directorio($dir/$file);
						}
						else
						{
							$result = unlink($dir/$file);
						}
					}
				}
					closedir($handle);
					if ($result)
					{
						$result = rmdir($dir);
					}
				}
				return $result;
		}


	}
?>