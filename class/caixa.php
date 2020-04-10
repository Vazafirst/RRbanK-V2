<?php

date_default_timezone_set('America/Sao_Paulo');
require_once("./connection/connection.php");
require_once("./class/users.php");

class Caixa {

    private $con;
    private $cxid;
    private $value;
    private $vr;

    public function __construct() {
        $this->con = new Connection();
    }

    public function CxEvSelect() {
        try {
            $this->cxid = 2;
            $cst = $this->con->connect()->prepare("SELECT * FROM caixa WHERE CaixaID = :cxid");
            $cst->bindValue(":cxid", $this->cxid);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['cxevdinheiro'] = $rst['dinheiro'];
        } catch (PDOException $ex) {
            echo "Error in C19: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function CofreSelect() {
        try {
            $this->cxid = 1;
            $cst = $this->con->connect()->prepare("SELECT * FROM caixa WHERE CaixaID = :cxid");
            $cst->bindValue(":cxid", $this->cxid);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['cofredinheiro'] = $rst['dinheiro'];
        } catch (PDOException $ex) {
            echo "Error in C32: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function CaixaevDec($data) {
        try {
            $this->value = $data['decmoney'];
            $cst = $this->con->connect()->prepare("UPDATE caixa SET dinheiro = dinheiro - :value WHERE CaixaID = 2");
            $cst->bindValue(":value", $this->value);
            if ($cst->execute()) {
                $this->CxEvSelect();
            }
        } catch (PDOException $ex) {
            echo "Error in C46: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function CaixaevInc($data) {
        try {
            $this->value = $data['incmoney'];
            $cst = $this->con->connect()->prepare("UPDATE caixa SET dinheiro = dinheiro + :value WHERE CaixaID = 2");
            $cst->bindValue(":value", $this->value);
            if ($cst->execute()) {
                $this->CxEvSelect();
            }
        } catch (PDOException $ex) {
            echo "Error in C59: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function CofreInc($data) {
        try {
            $this->value = $data['incmoney'];
            $cst = $this->con->connect()->prepare("UPDATE caixa SET dinheiro = dinheiro + :value WHERE CaixaID = 1");
            $cst->bindValue(":value", $this->value);
            if ($cst->execute()) {
                $this->CofreSelect();
            }
        } catch (PDOException $ex) {
            echo "Error in C59: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function CofreDec($data) {
        try {
            $this->value = $data['decmoney'];
            $cst = $this->con->connect()->prepare("UPDATE caixa SET dinheiro = dinheiro - :value WHERE CaixaID = 1");
            $cst->bindValue(":value", $this->value);
            if ($cst->execute()) {
                $this->CofreSelect();
            }
        } catch (PDOException $ex) {
            echo "Error in C46: " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

}
