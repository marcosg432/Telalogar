<?php
// variada privada so pode ser acessada por metodos
   Class Usuario
   {
      private $pdo; 
      public $msgErro = "";

      public function conectar($database,$host,$user,$password)
      {
        global $pdo;
        try
        {
           $pdo = new PDO("mysql:dbname=".$database,$user,$password);
        }
        catch(PDOException $erro)
           $msgErro = $erro-> getMessage();
        }
      }
      

      public function cadastroUsuario($nome,$telefone,$email,$senha)
      {
        global $pdo;

        // verificar se ja existe um email cadastrado
        $sql = $pdo->prepare("SELECT id FROM usuario WHERE email = :e"); // prepare: para segurança do banco de dados.
        $sql->bindValue(":e",$email);  //bindValue: dar apelido.
        $sql->execute();
        if($sql->rowCount()>0){
            return false;
        }else{
            $sql = $pdo->prepare("INSERT INTO usuario (nome,email,telefone,senha) VALUES (:n,:e,:t,:s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":s",$senha);
            $sql->execute();
       
             return true;
        }
       }  
   }
?>