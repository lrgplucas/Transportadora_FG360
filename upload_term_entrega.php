<?php


try{
		$destino;
		$arquivo_tmp;
		$destino_temp;
		$name = rand(1,100000).'_'.$_FILES['file']['name'];
		$destino = 'docs_term_entrega/' .$name;
		$arquivo_tmp = $_FILES['file']['tmp_name']; 
		$path_parts = pathinfo($_FILES["file"]["name"]);
		$extension = $path_parts['extension'];
				
		move_uploaded_file( $arquivo_tmp, $destino  );

		echo $destino;
}catch(Exception $e){
	echo "iu";
}
?>