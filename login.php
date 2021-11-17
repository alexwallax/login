<?php

    //abrir a sessão
    session_start();    

    
    
    //verificar se o usuário enviou algum dado campo email
    if(isset($_POST['email']) && empty($_POST['email']) == false) {
        $email = addslashes($_POST['email']);
    
        //verificar se o usuário enviou algum dado campo senha
        if(isset($_POST['senha']) && empty($_POST['senha']) == false) {
            $senha = md5(addslashes($_POST['senha']));//transformar senha em md5(criptografia)
        }
        

        //conectar ao banco
        $dsn = "mysql:dbname=login;host=127.0.0.1";
        $dbuser = "root";
        $dbpass = "";

    

        try{
            $db = new PDO($dsn, $dbuser, $dbpass);

            //buscando os dados no banco, se o email e senha e guardando na variavel $sql
            $sql = $db->query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'");

            //verificando se os dados buscados no banco estão corretos
            if($sql->rowCount() > 0) { //  rowCount vai retorna quantidade de registros corretos email e senha, encontrados no banco 

                //pegar os dados do usuário, salvar o "id" do usuário logado na
                $dado = $sql->fetch(); //fetch vai pegar o 1º resultado da busca(no caso o 1º resultado que bater email e senha)

                //print_r($dado);//verificar os dados para teste

                //salvar id na sessão - $dado tem a chave 'id' vai salvar na sessão $_SESSION
                $_SESSION['id'] = $dado['id'];

                //redireciona para pagina index.php
                header("Location: index.php");

            }

    }catch(PDOException $e) {
        echo "Error: ".$e->getMenssage();
    }

    }


?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Clínica</title>
    </head>
    <body style="background:#D3D3D3">

        <div class="container mt-5">

            <div class="row">

                    <div class="col-md-3"></div><!--col-md-3-->

                    <div class="col-md-6">



                        <h2 class="mt-5">Página de login</h2>

                        <form method="POST" class="mt-4">

                            <div class="mb-3">

                                <label class="form-label">E-mail:</label>
                                <input type="email" class="form-control" name="email" placeholder="Digite seu e-mail aqui" />

                                <label class="form-label mt-3">Senha:</label>
                                <input type="senha" class="form-control" name="senha" placeholder="Digite sua senha aqui"/>

                                <div class="d-grid gap-2">

                                    <button type="submit" class="btn btn-dark mt-4">Entrar</button>

                                </div><!--d-grid gap-2-->

                            </div><!--mt-3-->

                        </form>    

                    </div><!--col-md-6-->

                    <div class="col-md-3"></div><!--col-md-3-->

            </div><!--row--> 

        </div><!--container-->

    </body>
    </html>




