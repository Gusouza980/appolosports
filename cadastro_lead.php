<?php

if(isset($_POST["submit"])){

    $id = 1; //Importante colocar o id da academia no sistema
    $formulario = $_POST["formulario"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $estado = null;
    $cidade = null;
    $cep = null;

    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));

    if($query && $query["status"] == "success"){
        $estado = $query["region"];
        $cidade = $query["city"];
        $cep = $query["zip"];
    }

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
        $stmt = $pdo->prepare('INSERT INTO leads (academia_id, formulario, nome, email, celular, ip, ip_uf, ip_cidade, created_at) VALUES(:academia_id, :formulario, :nome, :email, :celular, :ip, :ip_uf, :ip_cidade, :created_at)');
        $stmt->execute(array(
            ':academia_id' => $id,
            ':formulario' => $formulario,
            ':nome' => $nome,
            ':email' => $email,
            ':celular' => $telefone,
            ':ip' => $ip,
            ':ip_uf' => $estado,
            ':ip_cidade' => $cidade,
            ':created_at' => $data
        ));
        if($stmt->rowCount()){
            $sucesso = true;
            header("Location: cadastro-concluido.html");
        }else{
            header("Location: index.html");
        }
    }catch(PDOException $e) {
        header("Location: index.html");
    }

}


?>