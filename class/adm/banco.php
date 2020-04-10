<?php

date_default_timezone_set('America/Bahia');
require_once("../connection/connection.php");

class AdmBanco {

    private $con;
    private $iduser;
    private $tipo;
    private $dinheiro;
    private $rrid;
    private $value;
    private $vr;

    public function __construct() {
        $this->con = new Connection();
    }

    public function Saques() {
        try {
            $cst = $this->con->connect()->prepare("SELECT * FROM saque WHERE verificar = 1");
            $cst->execute();
            if ($cst->rowCount() == 0) {
                echo "Não há ninguém realizando saques no momento";
            }
            while ($fetch = $cst->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['adsverificar'] = $fetch['verificar'];
                $_SESSION['adsid'] = $fetch['serialcontas'];
                $_SESSION['adssaque'] = $fetch['saque'];
                $_SESSION['adsrrid'] = $fetch['RRID'];
                echo "<P> Id Da Conta:  " . $_SESSION['adsid'] . " </P><P> Valor Do Deposito:  " . $_SESSION['adssaque'] . "</P> ID NO RR: " . $_SESSION['adsrrid'] . "<HR>";
            }
        } catch (PDOException $ex) {
            echo "Error in ADMB19: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Depositos() {
        try {
            $cst = $this->con->connect()->prepare("SELECT * FROM deposito WHERE verificar = 1");
            $cst->execute();
            if ($cst->rowCount() == 0) {
                echo "Não há ninguém realizando depositos no momento";
            }
            while ($fetch = $cst->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['addverificar'] = $fetch['verificar'];
                $_SESSION['addid'] = $fetch['serialcontas'];
                $_SESSION['adddeposito'] = $fetch['deposito'];
                $_SESSION['addrrid'] = $fetch['RRID'];
                echo "<P> Id Da Conta:  " . $_SESSION['addid'] . " </P><P> Valor Do Deposito:  " . $_SESSION['adddeposito'] . "</P> ID NO RR: " . $_SESSION['addrrid'] . "<HR>";
            }
        } catch (PDOException $ex) {
            echo "Error in ADMB36: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ConfTransacao($data) {
        try {
            $this->iduser = $data['iduser'];
            $this->dinheiro = $data['dpsq'];
            if ($data['sq'] == 1) {
                $tipo = "saque";
                $si = "-";
            } else if ($data['sq'] == 2) {
                $tipo = "deposito";
                $si = "+";
            } else {
                echo '<script>alert("Aconteceu um erro")</script>';
                exit();
            }
            $cst = $this->con->connect()->prepare("UPDATE $tipo SET $tipo = '0', verificar = '0' WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst1 = $this->con->connect()->prepare("UPDATE contas SET dinheiro = dinheiro $si :dim WHERE serial = :iduser");
            $cst1->bindValue(":dim", $this->dinheiro);
            $cst1->bindValue(":iduser", $this->iduser);
            if ($cst1->execute()) {
                $cst->execute();
            } else {
                echo '<script>alert("OPPPSS")</script>';
            }
        } catch (PDOException $ex) {
            echo "Error in ADMB54: " . $ex->getMessage() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

}
