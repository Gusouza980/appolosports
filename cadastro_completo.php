<?php

if(isset($_POST["submit"])){

    $id = 1; //Importante colocar o id da academia no sistema
    $formulario = $_POST["formulario"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $celular = $_POST["celular"];
    $cpf = $_POST["cpf"];
    $nascimento = $_POST["nascimento"];
    $rg = $_POST["rg"];
    $sexo = $_POST["sexo"];
    $endereco = $_POST["endereco"];
    $cep = $_POST["cep"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    $bairro = $_POST["telefone"];

    $data = date("Y-m-d H:i:s");

    // $host = 'localhost';
    // $user = 'root';
    // $pass = '';
    // $dbname = 'gefit';

    $host = 'localhost';
    $user = 'gefit2';
    $pass = 'Adm77gefit2';
    $dbname = 'gefit2';

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $stmt = $pdo->prepare('INSERT INTO cadastros
        (academia_id, formulario, nome, email, celular, telefone, cpf, nascimento, rg,  sexo, endereco, cep, numero, complemento, cidade, estado, bairro, created_at) 
        VALUES
        (:academia_id, :formulario, :nome, :email, :celular, :telefone, :cpf, :nascimento, :rg,  :sexo, :endereco, :cep, :numero, :complemento, :cidade, :estado, :bairro, :created_at)');
        $stmt->execute(array(
            ':academia_id' => $id,
            ':formulario' => $formulario,
            ':nome' => $nome,
            ':email' => $email,
            ':celular' => $celular,
            ':telefone' => $telefone,
            ':cpf' => $cpf,
            ':nascimento' => $nascimento,
            ':rg' => $rg,
            ':sexo' => $sexo,
            ':endereco' => $endereco,
            ':cep' => $cep,
            ':numero' => $numero,
            ':complemento' => $complemento,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':bairro' => $bairro,
            ':created_at' => $data,
        ));
        if($stmt->rowCount()){
            $sucesso = true;
            header("Location: pre-matricula-concluida.html");
        }else{
            header("Location: index.html");
            // echo "erro";
        }
    }catch(PDOException $e) {
        header("Location: index.html");
        // echo $e->getMessage();
    }

}

?>