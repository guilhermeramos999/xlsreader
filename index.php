<?php

use Project\Pdo\Infraestructure\Conn;
use Project\Pdo\Model\FileReader;

require_once __DIR__ . '/vendor/autoload.php';

$conn = new Conn();

$execute = $conn->startConnection();

$file = new FileReader();

$file->readFile();

$csvPath = 'src/Model/Csv/arquivo.csv';

$csv = new SplFileObject($csvPath,'r+');
$line = $csv->fgetcsv(';');

$recordStudents = [];

while($csv->valid()){
    $line = $csv->fgetcsv(';');

    if($line[0] != null){
        $dataArray = formatArray($line);
        try{
            if(!validDuplicity($dataArray['nome'],$dataArray['curso'],$execute)){
                $insertStmt = "INSERT INTO escola.alunos (nome,curso) VALUES ('{$dataArray['nome']}','{$dataArray['curso']}')";
                $execute->query($insertStmt);

                $recordStudents[] = $dataArray;
            }
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(),$e->getCode());
        }
    }else{
        echo "Planilha vazia\n\r";
    }
}

if(count($recordStudents) === 0){
    echo "Nenhum cadastro foi realizado";
}else{
    echo "Alunos Cadastrados\n\r\n\r";
    $i = 0;
    while($i < count($recordStudents)){
        echo "Nome: {$recordStudents[$i]['nome']}\n\rCurso: {$recordStudents[$i]['curso']}\n\r\n\r";
            $i++;
    }
    $recordStudents = [];
}

function validDuplicity($nome,$curso,$connection){
    $selectStmt = $connection->query("SELECT * FROM escola.alunos 
    WHERE nome = '$nome' AND curso = '$curso'");
    
    $result = $selectStmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($result) !== 0){
        echo "Dados já existentes: $nome - $curso\n\r\n\r";
        return true;
    }else{
        return false;
    }
};

function formatArray($arrayNomes){
    $newArray = [
        'nome' => $arrayNomes[0],
        'curso' => $arrayNomes[1]
    ];
    return $newArray;
}