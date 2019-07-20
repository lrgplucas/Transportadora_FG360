<?php


try{
		$destino;
		$arquivo_tmp;
		$destino_temp;

		$destino = 'docs/' .rand(1,100000).'_'.$_FILES['file']['name'];
		$arquivo_tmp = $_FILES['file']['tmp_name']; 
				
		move_uploaded_file( $arquivo_tmp, $destino  );

		echo $destino;
}catch(Exception $e){
	echo "";
}
?>