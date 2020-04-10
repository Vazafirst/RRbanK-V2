<?php

date_default_timezone_set('America/Bahia');
require_once("./connection/connection.php");
require_once("./class/banco.php");

class User {

    private $con;
    private $iduser;
    private $adm;
    private $username;
    private $password;
    private $email;
    private $rrid;
    private $rrname;
    private $vr;
    private $vr1;
    private $fbid;

    public function __construct() {
        $this->con = new Connection();
    }

    public function __set($att, $value) {
        $this->$att = $value;
    }

    public function __get($att) {
        return $this->$att;
    }

    // Primeiro verifica se o Username e/ou Email já existem e depois insere os dados no banco de dados
    public function queryInsert($data) {
        try {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $this->adm = 1;
            $this->username = $data['username'];
            $this->rrname = $data['email'];
            $this->password = sha1($data['password']);
            $this->vr = rand(10000000, 99999999);
            $this->vr1 = new DateTime("+5 Days");
            $cst1 = $this->con->connect()->prepare("SELECT login FROM contas WHERE login = :username");
            $cst1->bindValue(":username", $this->username);
            $cst1->execute();
            $cst1->fetch();
            if ($cst1->rowCount() !== 0) {
                echo '<script>alert("Este login já está cadastrado, tente novamente")</script>';
            } else {
                $cst = $this->con->connect()->prepare("INSERT INTO contas (adm, login, senha, nomenorr, datacadastro, datalimite, vr) VALUES (:adm, :username, :password, :nomenorr, NOW(), :datalimite, :vr)");
                $cst->bindValue(":adm", $this->adm);
                $cst->bindValue(":username", $this->username);
                $cst->bindValue(":nomenorr", $this->rrname);
                $cst->bindValue(":password", $this->password);
                $cst->bindValue(":datalimite", $this->vr1->format('Y-m-d H:i:s'));
                $cst->bindValue(":vr", $this->vr);
                if ($cst->execute()) {
                    $_SESSION['Loginerror'] = "SUCESSO!!<br>Por favor, aguarde enquanto redirecionamos você para a página de login.";
                    echo '<meta http-equiv="refresh" content="5; url=./index.php">';
                    session_destroy();
                    session_unset();
                } else {
                    echo '<meta http-equiv="refresh" content="8; url=./register.php">';
                    $_SESSION['Loginerror'] = "ERROR :(<br>Please try again, if problem persists contact an administrator via <br><a style='color: #EE82EE;' href='support.php'>SUPPORT</a>";
                    session_destroy();
                    session_unset();
                }
            }
        } catch (PDOException $ex) {
            echo "Error in U34: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    // Pega os dados do usuário logado no banco de dados
    public function querySelect($data) {
        try {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            $this->iduser = $data["iduser"];
            $cst = $this->con->connect()->prepare("SELECT * FROM contas WHERE serial = :id");
            $cst->bindValue(":id", $this->iduser);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['adm'] = $rst['adm'];
            $_SESSION['username'] = $rst['login'];
            $_SESSION['nomenorr'] = $rst['nomenorr'];
            $_SESSION['dinheiro'] = $rst['dinheiro'];
            $_SESSION['dinheiroup'] = $rst['dinheiroup'];
            $_SESSION['RRID'] = $rst['RRID'];
            $_SESSION['vr'] = $rst['vr'];
            $_SESSION['datalimite'] = $rst['datalimite'];
            $_SESSION['vrlotn'] = $rst['vrlot'];
        } catch (PDOException $ex) {
            echo "Error in U78: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    // Verifica o nivel do adm do usuário, serve para verificações
    public function admVr() {
        if (!isset($_SESSION['adm'])) {
            header('location: ./index.php');
            $_SESSION['Loginerror'] = "Faça login para acessar o RRBanK";
            exit();
        } else if ($_SESSION['adm'] == 15) {
            header('location: ./index.php');
            $_SESSION['Loginerror'] = "Oops!! <br>O RRBanK está em manutenção :(<br> Voltaremos em breve";
            exit();
        } else {
            return "ok";
        }
    }

    // Verifica usuário e senha para fazer login, só que pelo index
    public function userLogin($data) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $this->username = $data['username'];
        $this->password = sha1($data['password']);
        try {
            $cst1 = $this->con->connect()->prepare("SELECT * FROM contas WHERE login = :username");
            $cst1->bindParam(":username", $this->username, PDO::PARAM_STR);
            $cst1->execute();
            if ($cst1->rowCount() == 0) {
                $_SESSION['Loginerror'] = "Está conta não foi encontrada<br> Por favor, verifique seus dados de login e tente novamente.";
            } else {
                $cst = $this->con->connect()->prepare("SELECT * FROM contas WHERE login = :username AND senha = :password");
                $cst->bindParam(":username", $this->username, PDO::PARAM_STR);
                $cst->bindParam(":password", $this->password, PDO::PARAM_STR);
                $cst->execute();
                $rst = $cst->fetch();
                if ($cst->rowCount() == 0) {
                    $_SESSION['Loginerror'] = "SENHA INCORRETA";
                } else {
                    $_SESSION['iduser'] = $rst['serial'];
                    $id['iduser'] = $_SESSION['iduser'];
                    $objUser = new User();
                    $objUser->querySelect($id);
                    $objBanco = new Banco();
                    $objBanco->querySelectBanco();
                    sleep(2);
                    header('location: ./inicio.php');
                }
            }
        } catch (PDOException $ex) {
            echo "Error in U119: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    // Money Querys \/
    public function IncMoney($data) {
        try {
            $this->value = $data['incmoney'];
            $cst = $this->con->connect()->prepare("UPDATE contas SET dinheiro = dinheiro + :value WHERE serial = :iduser");
            $cst->bindValue(":value", $this->value);
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new User();
                $objUser->querySelect($id);
            }
        } catch (PDOException $ex) {
            echo "Error in U157: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function DecMoney($data) {
        try {
            $this->value = $data['decmoney'];
            $cst = $this->con->connect()->prepare("UPDATE contas SET dinheiro = dinheiro - :value WHERE serial = :iduser");
            $cst->bindValue(":value", $this->value);
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            if ($_SESSION['dinheiro'] < $data['decmoney']) {
                echo "<script language='JavaScript'>
          		alert('Você não pode gastar um valor que você não possua, realize um deposito primeiro');
         		 history.back()</script>";
                exit();
            }
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new User();
                $objUser->querySelect($id);
            }
        } catch (PDOException $ex) {
            echo "Error in U174: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Offline() {
        try {
            $cst = $this->con->connect()->prepare("UPDATE contas SET adm = 15 WHERE adm = 1");
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new User();
                $objUser->querySelect($id);
                echo "SUCESS";
            }else{
              echo "trab";
            }
        } catch (PDOException $ex) {
            echo "Error in U180: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }
    
    public function Online() {
        try {
            $cst = $this->con->connect()->prepare("UPDATE contas SET adm = 1 WHERE adm = 15");
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new User();
                $objUser->querySelect($id);
            }
        } catch (PDOException $ex) {
            echo "Error in U180: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    // End money Querys /\
    // FB LOGIN ID
    /* public function fbidselect() {
      try {
      $this->email = $_SESSION['fbemail'];
      $cst = $this->con->connect()->prepare("SELECT fbemail FROM contas WHERE fbemail = :fbemail");
      $cst->bindValue(":fbemail", $this->email);
      $cst->execute();
      if ($cst->rowCount() == 0) {
      $this->adm = 1;
      $this->username = $_SESSION['fbname'];
      $this->fbid = $_SESSION['fbid'];
      $this->vr = rand(10000000, 99999999);
      $this->vr1 = new DateTime("+7 Days");
      $cst1 = $this->con->connect()->prepare("INSERT INTO contas (adm, fbid, datacadastro, datalimite, vr, nome, fbemail) VALUES (:adm, :fbid, NOW(), :datalimite, :vr, :username, :fbemail)");
      $cst1->bindValue(":adm", $this->adm);
      $cst1->bindValue(":fbemail", $this->email);
      $cst1->bindValue(":fbid", $this->fbid);
      $cst1->bindValue(":datalimite", $this->vr1->format('Y-m-d H:i:s'));
      $cst1->bindValue(":vr", $this->vr);
      $cst1->bindValue(":username", $this->username);
      $cst1->execute();
      $objUser = new User();
      $objUser->fbidselect();
      } else {
      $objUser = new User();
      $objUser->userFBLogin();
      }
      } catch (PDOException $ex) {

      }
      }

      public function userFBLogin() {
      if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
      }
      $this->email = $_SESSION['fbemail'];
      try {
      $cst1 = $this->con->connect()->prepare("SELECT * FROM contas WHERE fbemail = :email");
      $cst1->bindParam(":email", $this->email, PDO::PARAM_STR);
      $cst1->execute();
      $rst = $cst1->fetch();
      $_SESSION['iduser'] = $rst['serial'];
      $id['iduser'] = $_SESSION['iduser'];
      $objUser = new User();
      $objUser->querySelect($id);
      $objBanco = new Banco();
      $objBanco->querySelectBanco();
      sleep(2);
      header('location: ./inicio.php');
      } catch (PDOException $ex) {
      echo "Error!: " . $ex->getMessage() . "<br/>";
      exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
      }
      } */
}
