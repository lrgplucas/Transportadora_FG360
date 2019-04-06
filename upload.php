<?php
		$destino;
		$arquivo_tmp;

		$destino = 'docs/' . $_FILES['file']['name'];
		$arquivo_tmp = $_FILES['file']['tmp_name']; 
				
		move_uploaded_file( $arquivo_tmp, $destino  );

		echo $destino;
?>