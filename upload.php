<?php
		$destino;
		$arquivo_tmp;

		$destino = 'docs/' .rand(1,100000).'_'.$_FILES['file']['name'];
		$arquivo_tmp = $_FILES['file']['tmp_name']; 
				
		move_uploaded_file( $arquivo_tmp, $destino  );

		echo $destino;
?>