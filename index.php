<?php
require_once "connect.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Desafio</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	</head>
	<body>
		<div class="col-md-6 col-md-offset-3 jumbotron">
			<?
			if (isset($_GET['error']) && $_GET['error'] == 1) {?>
				<div class="alert alert-danger">
                    <strong>Arquivo não compatível para importação! Somente arquivos com extenção <i>.tab</i> ou <i>.txt</i></strong>
                </div> 
			<?
			}

			if (isset($_GET['success']) && $_GET['success'] == 1) {?>
				<div class="alert alert-success">
                    <strong>Importação realizada com sucesso!</strong>
                </div>
			<?
			}
			?>
			<h3>Importação de arquivos</h3>
			<form method="post" action="action/upload.php" enctype="multipart/form-data">
				<div class="input-group">
      				<input type="file" class="form-control" accept=".tab,.txt" name="arquivo">
      				<input type="hidden" name="teste" value="asdmilahdasnd">
      				<span class="input-group-btn">
        				<button class="btn btn-success" type="submit">Importar</button>
      				</span>
    			</div>
			</form>

			<div class="clearfix"></div>
		</div>

		<?
		$query = "SELECT * FROM venda ORDER BY id DESC";
		$vendas = $conn->prepare($query);
		$vendas->execute();
		if ($vendas->rowCount() > 0) {
		?>
    		<div class="col-md-6 col-md-offset-3">
    			<h3>Vendas importadas</h3>
    			<table class="table table-bordered table-hover table-stripped">
    				<thead>
    					<th>Código</th>
    					<th>Comprador</th>
    					<th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
    					<th>Endereço do vendedor</th>
    					<th>Vendedor</th>
    				</thead>
                    <tbody>
                        <?php
                        $receitaBruta = 0;
                        while ($venda = $vendas->fetch(PDO::FETCH_OBJ)) {
                            $receitaBruta += $venda->preco_item * $venda->quantidade;
                            ?>
                            <tr>
                                <td><?php echo $venda->id?></td>
                                <td><?php echo $venda->comprador_nome?></td>
                                <td><?php echo $venda->descricao_item?></td>
                                <td>R$ <?php echo number_format($venda->preco_item, 2, ',', '.')?></td>
                                <td><?php echo $venda->quantidade?></td>
                                <td><?php echo $venda->endereco_vendedor?></td>
                                <td><?php echo $venda->nome_vendedor?></td>
                            </tr>
                        <?
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <th colspan="7" class="text-center">Receita Bruta Total: R$ <?php echo number_format($receitaBruta, 2, ',', '.')?></th>
                    </tfoot>
    			</table>
    		</div>
        <?php } ?>
	</body>
</html>