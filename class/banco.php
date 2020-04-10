<?php

require_once("./connection/connection.php");

class Banco {

    private $con;
    private $iduser;
    private $adm;
    private $tipo;
    private $dinheiro;
    private $dinheiroup;
    private $dinheirolimite;
    private $rrid;
    private $value;
    private $vr;

    public function __construct() {
        $this->con = new Connection();
    }

// Start global querys **
    public function queryInsertBanco() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("INSERT INTO banco (serialcontas) VALUES (:iduser)");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            $cst1 = $this->con->connect()->prepare("INSERT INTO deposito (serialcontas) VALUES (:iduser)");
            $cst1->bindValue(":iduser", $this->iduser);
            $cst1->execute();
            $cst2 = $this->con->connect()->prepare("INSERT INTO saque (serialcontas) VALUES (:iduser)");
            $cst2->bindValue(":iduser", $this->iduser);
            $cst2->execute();
        } catch (PDOException $ex) {
            echo "Error :( <br> CODE: " . $ex->getMessage() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function querySelectBanco() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM banco WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            if ($cst->rowCount() == 0) {
                $pacoca = new Banco();
                $pacoca->queryInsertBanco();
            } else {
                $rst = $cst->fetch();
                $_SESSION['bdinheiroup'] = $rst['dinheiroup'];
                $_SESSION['btipo'] = $rst['tipo'];
                $_SESSION['bdinheirolimite'] = $rst['dinheirolimite'];
                $pacoca = new Banco();
                $pacoca->SelectDeposito();
                $pacoca->SelectSaque();
            }
        } catch (PDOException $ex) {
            echo "Error!: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function SelectDeposito() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM deposito WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['ddeposito'] = $rst['deposito'];
            $_SESSION['dverificar'] = $rst['verificar'];
        } catch (PDOException $ex) {
            echo "Error!: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function SelectSaque() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM saque WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['ssaque'] = $rst['saque'];
            $_SESSION['sverificar'] = $rst['verificar'];
        } catch (PDOException $ex) {
            echo "Error in B80: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Deposito($data) {
        try {
            $this->value = $data['incmoney'];
            $cst = $this->con->connect()->prepare("UPDATE deposito SET deposito = :value, verificar = '1' WHERE serialcontas = :iduser");
            $cst->bindValue(":value", $this->value);
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new Banco();
                $objUser->SelectDeposito();
            }
        } catch (PDOException $ex) {
            echo "Error in B95: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Saque($data) {
        try {
            $this->value = $data['decmoney'];
            $cst = $this->con->connect()->prepare("UPDATE saque SET saque = :value, verificar = '1' WHERE serialcontas = :iduser");
            $cst->bindValue(":value", $this->value);
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new Banco();
                $objUser->SelectSaque();
            }
        } catch (PDOException $ex) {
            echo "Error in B112: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

// End global querys **

    public function Moneyup($data) {
        try {
            $this->value = $data['moneyup'];
            $cst = $this->con->connect()->prepare("UPDATE contas SET dinheiroup = :value WHERE serial= :iduser");
            $cst->bindValue(":value", $this->value);
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            if ($cst->execute()) {
                $id['iduser'] = $_SESSION['iduser'];
                $objUser = new Banco();
                $objUser->querySelectBanco();
            }
        } catch (PDOException $ex) {
            echo "Error in B131: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ControllerBanco() {
        $objUser = new User();
        $objBanco = new Banco();
        $_SESSION['btimepa'] = new DateTime('+7 days');
        $_SESSION['btime'] = new DateTime();
        $cbndt = new DateTime($_SESSION['datalimite']);
        if ($cbndt->format("Y-m-d H:i:s") < $_SESSION['btime']->format("Y-m-d H:i:s")) {
            $cst = $this->con->connect()->prepare("UPDATE contas SET dinheiro = dinheiro + :dimup, datalimite = :dl WHERE SERIAL = :iduser");
            $cst->bindValue(":dimup", $_SESSION['dinheiroup']);
            $cst->bindValue(":dl", $_SESSION['btimepa']->format("Y-m-d H:i:s"));
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            $cst->execute();
            $id['iduser'] = $_SESSION['iduser'];
            $objUser->querySelect($id);
            $objBanco->querySelectBanco();
        }
    }

    public function FixMoneyup() {
        try {
            $cst = $this->con->connect()->prepare("UPDATE contas SET dinheiroup = :dimup WHERE serial = :iduser");
            $cst->bindValue(":dimup", intval($_SESSION['dupvalor']));
            $cst->bindValue(":iduser", $_SESSION['iduser']);
            $cst->execute();
            $cst1 = $this->con->connect()->prepare("UPDATE banco SET dinheiroup = :dimup WHERE serialcontas = :iduser");
            $cst1->bindValue(":dimup", intval($_SESSION['dupvalor']));
            $cst1->bindValue(":iduser", $_SESSION['iduser']);
            $cst1->execute();
        } catch (PDOException $ex) {
            echo "Error in B166: " . $ex->getMessage() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Vrdpsq() {
        $objBanco = new Banco();
        $objBanco->SelectDeposito();
        $objBanco->SelectSaque();
        if ($_SESSION['dverificar'] == 1) {
            echo "<script type='text/javascript'>showWarn(this);</script>";
            $_SESSION['ddeposito'] = number_format($_SESSION['ddeposito'], 0, ",", ".");
            $_SESSION['depsaq'] = "<P style='text-align: center; color: greenyellow;'>O valor do seu depósito é:</P>" . "$ " . $_SESSION['ddeposito'];
        }
        if ($_SESSION['sverificar'] == 1) {
            echo "<script type='text/javascript'>showWarn(this);</script>";
            $_SESSION['ssaque'] = number_format($_SESSION['ssaque'], 0, ",", ".");
            $_SESSION['depsaq'] = "<P style='text-align: center; color: greenyellow;'>O valor do seu saque é:</P>" . "$ " . $_SESSION['ssaque'];
        }
    }

}
