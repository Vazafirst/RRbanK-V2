<?php

include_once ('./class/users.php');

class Viewregister {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function vrregister($data) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION['registervr'] == 1) {
            if (isset($data['username'])) {
                $_SESSION['ruser'] = $data['username'];
                $_SESSION['rmail'] = $data['email'];
                $_SESSION['passautf'] = " autofocus";
                $_SESSION['loginautf'] = "";
            } else {
                $_SESSION['ruser'] = "";
                $_SESSION['rmail'] = "";
                $_SESSION['loginautf'] = " autofocus";
                $_SESSION['passautf'] = "";
            }
            if (!isset($_SESSION['sqaautf'])) {
                $_SESSION['sqaautf'] = "";
                $_SESSION['ans'] = " autofocus";
            } else {
                $_SESSION['ans'] = "";
            }
            $_SESSION['vregister1'] = '<input class="campo" id="logininput" placeholder="LOGIN" value="' . $_SESSION['ruser'] . '" type="text" name="username" required' . $_SESSION['loginautf'] . ' />
                <input class="campo" id="emailinput" type="email" placeholder="EMAIL" value="' . $_SESSION['rmail'] . '" name="email" required />
                <div class="hrline" id="hr1" ></div>
                <input class="campo" id="passinput" type="password" minlength="8" maxlength="32" placeholder="SENHA" name="password"' . $_SESSION['passautf'] . ' required />
                <input class="campo" id="repeatpassinput" type="password" minlength="8" maxlength="32" placeholder="REPITA A SENHA" name="password2" required/>
                <p class="passwarn">Sua senha deve conter entre 8 e/ou 32 caracteres</p>
                <div class="hrline" id="hr2"></div>
		<input type="submit" class="btn" id="btnnext" name="btnrg" value="PRÓXIMO"/>';
        } else {
            $_SESSION['vregister1'] = '<select id=sq name="sq" ' . $_SESSION['sqaautf'] . ' class="select">
                    <option value="" selected disabled style="display: none;">Selecione uma pergunta de segurança</option>
                    <option>What is your mother last name?</option>
                    <option>What is your favorite color ?</option>
                    <option>What is the name of your animal pet ?</option>
                    <option>What is your favorite sport team ?</option>
                    <option>What is your favorite hobby ?</option>
                </select>
                <div class="hrline" id="hr3"></div>
                <input type="text" class="campo" id="answerinput" ' . $_SESSION['ans'] . ' name="sqanswer" minlength="2" maxlength="32" placeholder="ANSWER" required/>
                <p class="pterms"><input type="checkbox" required />By creating an account, you confirm that you have read and agree to our 
                    <a href="terms.php" style="color: white;
                       ">terms of use.</a></p>
                <input type="submit" id="scbtn" class="btn" name="btnrg" value="SUBMIT"/>';
        }
    }

    public function saveData1($data) {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if ($_SESSION['registervr'] == 0) {
            $_SESSION['rusername'] = $data['username'];
            $_SESSION['remail'] = $data['email'];
            $_SESSION['rpassword'] = $data['password'];
            $_SESSION['rpassword2'] = $data['password2'];
            $_SESSION['registervr'] = 2;
        } else {
            $_SESSION['rsq'] = $data['sq'];
            $_SESSION['rsqanswer'] = $data['sqanswer'];
            $this->user->queryInsert();
        }
    }

}
