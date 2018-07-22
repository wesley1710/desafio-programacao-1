<?php
require_once "../connect.php";
require_once "../import.class.php";

if (isset($_FILES) && $_FILES["arquivo"]) {
	$import = new ImportClass($_FILES["arquivo"]);

	if (!$import->status) { //Retornou false por não ser aquivo permitido;
		header("Location: ../?error=1");
		exit;
	}

	$arrayConfigCols = array(
		"comprador_nome",
		"descricao_item",
		"preco_item",
		"quantidade",
		"endereco_vendedor",
		"nome_vendedor"
	);

	$import->separateData();

	$query = "INSERT INTO venda (".implode(", ", $arrayConfigCols).") VALUES (?, ?, ?, ?, ?, ?)";

	foreach ($import->file_data as $key => $line) {
		if ($key == 0 || $line[0] == "") {
			continue;
		}

		$q = $conn->prepare($query);
		if (!$q) {
		    echo "\nPDO::errorInfo():\n";
		    print_r($conn->errorInfo());
		}else{
			echo $q->execute($line);
		}
	}

	header("Location: ../?success=1");
	exit;
}