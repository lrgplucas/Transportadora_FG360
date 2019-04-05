<?php
		$destino;
		$arquivo_tmp;

		if($_FILES['fileToUpload']['name'] != null){
			$destino = 'docs/' . $_FILES['fileToUpload']['name'];
			$arquivo_tmp = $_FILES['fileToUpload']['tmp_name']; 
			
		}else if ($_FILES['fileToUpload2']['name'] != null){
			$destino = 'docs/' . $_FILES['fileToUpload2']['name'];
			$arquivo_tmp = $_FILES['fileToUpload2']['tmp_name']; 
			
		}else{
			$destino = 'docs/' . $_FILES['fileToUpload3']['name'];
			$arquivo_tmp = $_FILES['fileToUpload3']['tmp_name']; 
		}
		

		
		move_uploaded_file( $arquivo_tmp, $destino  );
		
		//echo $destino;
	

?>