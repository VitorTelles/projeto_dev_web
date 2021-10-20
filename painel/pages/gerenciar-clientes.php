
<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Clientes Cadastrados</h2>
	<div class="busca">
		<form method="post">
			<h4><i class="fa fa-search"></i> Realizar uma busca: </h4>
			<input placeholder="Procure por: nome, email, cpf ou cnpj..." type="text" name="busca">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div><!--busca-->
	<div class="boxes">
		<?php 
		$query = "";
		if(isset($_POST['acao'])){
			$busca = $_POST['busca'];
			$query = "WHERE nome like '%$busca%' OR email LIKE '%$busca%' OR cpf_cnpj LIKE '%$busca%' ";
		}
		$clientes = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes` $query");
		$clientes->execute();
		$clientes = $clientes->fetchAll();
		if(isset($_POST['acao'])){
			echo '<div  style = "width:100%" class="busca-result"><p>Foram encontrados <b>'.count($clientes).'</b> resultados</p></div>';
		}
		foreach($clientes as $value){

		?>
		<div class="box-single-wraper">
			<div class="box-single">
				<div class="topo-box">
					<?php 

					if($value['imagem'] == ''){

					?>
					<h2><i class="fa fa-user"></i></h2>3
				<?php }else{ ?>
					<img src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['imagem'];?>">
				<?php  }  ?>
				</div><!--topo-box-->
				<div class="body-box">
					<p><b><i class="fa fa-info-circle"></i> Nome do Cliente:</b> <?php echo $value['nome'];?></p>
					<p><b><i class="fa fa-info-circle"></i> Email:</b> <?php echo $value['email'];?></p>
					<p><b><i class="fa fa-info-circle"></i> Tipo:</b> <?php echo ucfirst( $value['tipo']);?></p>
					<p><b><i class="fa fa-info-circle"></i><?php 
							if($value['tipo'] == 'fisico')
								echo 'CPF: ';
							else
								echo 'CNPJ: ';
						?></b> <?php echo $value['cpf_cnpj'];?></p>
					
					<div class="group-btn">
						<a actionBtn="delete" item_id = "<?php echo $value['id']; ?>" class="btn delete" href=""><i class="fa fa-times"></i> Excluir</a>
						<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL?>editar-cliente?id=<?php echo $value['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
					</div><!--group-btn-->
				</div><!--body-box-->
			</div><!--box-single-->
		</div><!--box-single-wraper-->
	<?php } ?>
		<div class="clear"></div>
	</div><!--boxes-->



</div><!--box-content-->