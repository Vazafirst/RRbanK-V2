<?php

require_once '../connection/connection.php';

class users {

    private $iduser;
    private $vr;

    public function __construct() {
        $this->con = new Connection();
    }

    public function VrRRID($data) {
        $this->vr = $data["usercod"];
        $cst = $this->con->connect()->prepare("SELECT * FROM contas WHERE vr = :vr");
        $cst->bindValue(":vr", $this->vr);
        $cst->execute();
        while ($fetch = $cst->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['adcverificar'] = $fetch['nomenorr'];
            $_SESSION['adcid'] = $fetch['serial'];
            $_SESSION['adclogin'] = $fetch['login'];
            $_SESSION['adcrrid'] = $fetch['RRID'];
            echo "<P> Id Da Conta:  " . $_SESSION['adcid'] . " </P><P> Nick da Conta:  " . $_SESSION['adclogin'] . "</P> ID NO RR: " . $_SESSION['adcrrid'] . "<HR>";
        }
    }

    public function ConfAcc($data) {
        try {
            $this->vr = $data["userrrid"];
            $this->iduser = $data['userid'];
            $cst = $this->con->connect()->prepare("UPDATE contas SET RRID = :RRID, vr = 0 WHERE serial = :iduser");
            $cst->bindValue(":RRID", $this->vr);
            $cst->bindValue(":iduser", $this->iduser);
            $cst1 = $this->con->connect()->prepare("UPDATE banco SET RRID = :RRID WHERE serialcontas = :iduser");
            $cst1->bindValue(":RRID", $this->vr);
            $cst1->bindValue(":iduser", $this->iduser);
            $cst2 = $this->con->connect()->prepare("UPDATE deposito SET RRID = :RRID WHERE serialcontas = :iduser");
            $cst2->bindValue(":RRID", $this->vr);
            $cst2->bindValue(":iduser", $this->iduser);
            $cst3 = $this->con->connect()->prepare("UPDATE saque SET RRID = :RRID WHERE serialcontas = :iduser");
            $cst3->bindValue(":RRID", $this->vr);
            $cst3->bindValue(":iduser", $this->iduser);
            if ($cst->execute()) {
                $cst1->execute();
                $cst2->execute();
                $cst3->execute();
                $_SESSION['Loginerror'] = "Conta verificada com sucesso";
            }
        } catch (PDOException $ex) {
            echo "Error!: ADM/U28 " . $ex->getMessage() . "<br/>";
            exit('Oops, looks like something wrong happened, could you try again please? If the problem persists contact an administrator via <a style="color: #EE82EE;" href="support.php">SUPPORT</a>');
        }
    }

}
