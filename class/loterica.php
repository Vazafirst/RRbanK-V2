<?php

date_default_timezone_set('America/Bahia');
require_once("./connection/connection.php");
require_once("./class/users.php");
require_once("./class/caixa.php");

class Loterica {

    private $con;
    private $iduser;
    private $value;
    private $vr;
    private $time;

    public function __construct() {
        $this->con = new Connection();
    }

    public function InsertApostadores($data) {
        try {
            $objUser = new User();
            $post['decmoney'] = 3000000000;
            $objUser->DecMoney($post);
            $this->value = $data['num'];
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("INSERT INTO apostadores (serialcontas, apostou, apostanum) VALUES (:iduser, 1, :value)");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->bindValue(":value", $this->value);
            if ($cst->execute()) {
                $objCaixa = new Caixa();
                $post['incmoney'] = 3000000000;
                $objCaixa->CaixaevInc($post);
            }
        } catch (PDOException $ex) {
            echo "Error!: L20 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ControlLoto() {
        $this->ShowResult();
        $this->ApResult();
        $dnow = new Datetime();
        $dlot = new Datetime($_SESSION['dataresult']);
        if ($dnow->format('Y-m-d H:i:s') >= $dlot->format('Y-m-d H:i:s')) {
            if ($valorlot == $apostanum) {
                
            }
            $this->LotericarsInsert();
        }
    }

    public function vrWins() {
        try {
            $this->value = $data['num'];
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT apostanum FROM apostadores WHERE serialcontas = :iduser AND apostanum = :num");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->bindValue(":num", $this->value);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['apostanumrs'] = $rst['apostanum'];
        } catch (PDOException $ex) {
            
        }
    }

    public function Vrloto($data) {
        try {
            $this->value = $data['num'];
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT apostanum FROM apostadores WHERE serialcontas = :iduser AND apostanum = :num");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->bindValue(":num", $this->value);
            $cst->execute();
            $rst = $cst->fetch();
            if ($rst['apostanum'] == $data['num']) {
                echo "<script language='JavaScript'>
          		alert('Você já apostou nesse número, por favor escolha outro número');
          		window.location.href='./loteria.php'
         		 </script>";
                exit();
            } else if ($data['num'] >= 101 or $data['num'] == 0) {
                echo "<script language='JavaScript'>
          		alert('Por favor, escolha um número entre 1 e 100');
          		window.location.href='./loteria.php'
         		 </script>";
                exit();
            } else {
                $objLoto = new Loterica();
                $objLoto->Vrlotolimit($data);
            }
        } catch (PDOException $ex) {
            echo "Error!: L64 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function Vrlotolimit($data) {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM apostadores WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            if ($cst->rowCount() >= 5) {
                echo "<script language='JavaScript'>
          		alert('Você já atingiu o máximo de apostas permitidas nesta rodada, por favor, aguarde a próxima rodada');
          		window.location.href='./loteria.php'
         		 </script>";
                exit();
            } else {
                $objLoto = new Loterica();
                $objLoto->InsertApostadores($data);
            }
        } catch (PDOException $ex) {
            echo "Error!: L98 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ZerarLoto() {
        try {
            $cst = $this->con->connect()->prepare("DELETE FROM apostadores");
            $cst->execute();
        } catch (Exception $ex) {
            echo "Error!: L120 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ShowNums() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM apostadores WHERE serialcontas = :iduser order by apostanum ASC");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            if ($cst->rowCount() == 0) {
                echo "Nenhum número apostado ainda :(";
            } else {
                while ($fetch = $cst->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['apostanum'] = $fetch['apostanum'];
                    echo "(" . $_SESSION['apostanum'] . ")";
                }
            }
        } catch (PDOException $ex) {
            echo "Error!: L130 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ApResult() {
        try {
            $this->vr = 1;
            $cst = $this->con->connect()->prepare("SELECT * FROM loterica WHERE idlot = :vr");
            $cst->bindValue(":vr", $this->vr);
            $cst->execute();
            $rst = $cst->fetch();
            $_SESSION['valorlot'] = $rst['valorlot'];
        } catch (PDOException $ex) {
            echo "Error!: L150 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ShowResult() {
        try {
            $this->vr = 1;
            $cst = $this->con->connect()->prepare("SELECT * FROM lotericars WHERE idlot = :vr");
            $cst->bindValue(":vr", $this->vr);
            if ($cst->execute()) {
                $rst = $cst->fetch();
                $_SESSION['rsvalorlot'] = $rst['valorlot'];
                $_SESSION['dataresult'] = $rst['dataresult'];
            }
        } catch (PDOException $ex) {
            echo "Error!: L164 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ShowApostars() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM apostadoresrs WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            if ($cst->execute()) {
                $rst = $cst->fetch();
                $_SESSION['rsapostanum'] = $rst['apostanum'];
            }
        } catch (PDOException $ex) {
            
        }
    }

    public function ShowNumsrs() {
        try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM apostadoresrs WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            if ($cst->rowCount() == 0) {
                
            } else {
                while ($fetch = $cst->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['apostanum'] = $fetch['apostanum'];
                    echo "(" . $_SESSION['apostanum'] . ")";
                }
            }
        } catch (PDOException $ex) {
            echo "Error!: L193 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ClearApostars() {
        try {
            $cst = $this->con->connect()->prepare("DELETE FROM apostadoresrs");
            if ($cst->execute()) {
                $this->ApostarsInsert();
            }
        } catch (PDOException $ex) {
            echo "Error!: L204 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function ApostarsInsert() {
        try {
            $cst = $this->con->connect()->prepare("INSERT INTO apostadoresrs SELECT * FROM apostadores");
            if ($cst->execute()) {
                $this->UpdateLot();
                $this->ZerarLoto();
            }
        } catch (PDOException $ex) {
            echo "Error!: L228 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function UpdateLot() {
        try {
            $this->vr = 40; //rand(1, 100);
            $this->time = new Datetime($_SESSION['dataresult']);
            $this->time = new Datetime('+1 Days');
            $cst = $this->con->connect()->prepare("UPDATE lotericars SET dataresult = :dataresult, valorlot = :vr WHERE idlot = 1");
            $cst->bindValue(":dataresult", $this->time->format('Y-m-d 15:00:00'));
            $cst->bindValue(":vr", $this->vr);
            if ($cst->execute()) {
                $vrlot['vrlot'] = 1;
                $this->Vrlot($vrlot);
                $this->Iwin();
                $this->ShowResult();
            }
        } catch (PDOException $ex) {
            echo "Error!: L241 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

    public function FixAprs(){
         try {
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("DELETE FROM apostadoresrs WHERE serialcontas = :iduser");
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
        } catch (PDOException $ex) {
            echo "Error!: L204 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }
    
    public function AntiBLot() {
        
    }

    public function ControllerLot() {
        $_SESSION['lotpremio'] = 100000000000;
        $this->ShowResult();
        $this->ApResult();
        $dnow = new Datetime();
        $dlot = new Datetime($_SESSION['dataresult']);
        if ($dnow->format('Y-m-d H:i:s') >= $dlot->format('Y-m-d H:i:s')) {
            $this->ClearApostars();
        }
    }

    public function Iwin() {
        try {
            $this->vr = $_SESSION['rsvalorlot'];
            $this->iduser = $_SESSION['iduser'];
            $cst = $this->con->connect()->prepare("SELECT * FROM apostadoresrs WHERE apostanum = :valorlot AND serialcontas = :iduser");
            $cst->bindValue(":valorlot", $this->vr);
            $cst->bindValue(":iduser", $this->iduser);
            $cst->execute();
            if ($cst->rowCount() == 1) {
                $_SESSION['lotwin'] = "Você venceu !!! <br>Faça outra aposta e continue a ganhar";
                if ($_SESSION['vrlotn'] == 1) {
                    $iwin['incmoney'] = $_SESSION['lotpremio'];
                    $objUser = new User();
                    $objUser->IncMoney($iwin);
                    $objCaixa = new Caixa();
                    $cx['decmoney'] = $_SESSION['lotpremio'];
                    $objCaixa->CaixaevDec($cx);
                    $vrlot['vrlot'] = 0;
                    $this->Vrlot($vrlot);
                    $this->FixAprs();
                }
            } else {
                $_SESSION['lotwin'] = "Você não teve sorte nessa rodada :( <br>Mas não desista, faça outra aposta";
                $vrlot['vrlot'] = 0;
                $this->Vrlot($vrlot);
            }
        } catch (PDOException $ex) {
            
        }
    }

    public function Vrlot($data) {
        try {
            $this->iduser = $_SESSION['iduser'];
            $this->vr = $data['vrlot'];
            $objUser = new User();
            $id['iduser'] = $_SESSION['iduser'];
            if ($data['vrlot'] == 1) {
                $cst1 = $this->con->connect()->prepare("SELECT * FROM contas WHERE serial = :iduser AND vrlot = :vr");
                $cst1->bindValue(":iduser", $this->iduser);
                $cst1->bindValue(":vr", $this->vr);
                $cst1->execute();
                if ($cst1->rowCount() == 1) {
                    $objUser->querySelect($id);
                } else {
                    $cst = $this->con->connect()->prepare("UPDATE contas SET vrlot = :vrlot WHERE serial = :iduser");
                    $cst->bindValue(":vrlot", $this->vr);
                    $cst->bindValue(":iduser", $this->iduser);
                    $cst->execute();
                    $id['iduser'] = $_SESSION['iduser'];
                    $objUser->querySelect($id);
                }
            } else if ($data['vrlot'] == 0) {
                $cst1 = $this->con->connect()->prepare("SELECT * FROM contas WHERE serial = :iduser AND vrlot = :vr");
                $cst1->bindValue(":iduser", $this->iduser);
                $cst1->bindValue(":vr", $this->vr);
                $cst1->execute();
                $objUser->querySelect($id);
                if ($cst1->rowCount() == 1) {
                    $objUser->querySelect($id);
                } else {
                    $cst = $this->con->connect()->prepare("UPDATE contas SET vrlot = :vrlot WHERE serial = :iduser");
                    $cst->bindValue(":vrlot", $this->vr);
                    $cst->bindValue(":iduser", $this->iduser);
                    $cst->execute();
                    $objUser->querySelect($id);
                }
            }
        } catch (PDOException $ex) {
            echo "Error!: L280 " . $ex->getCode() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

}
