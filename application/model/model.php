<?php
/*
 * This file is an old file. The functions in here need to be re-written and put inside the relevent models
 * I am just keeping them for the time being so I know where they they go, and what they're for.
*/
class Model {

 
    public function emailactivation($code, $email) {
        $email = isset($email) ? $email : '';
        $date = date("y-d-m");

        $emailcode = $this->db->prepare("INSERT INTO emailactivate (email,code,date) 
		VALUE(?,?,?)");
        $emailcode->execute(array($email, $code, $date));
    }

    public function activatecode($code, $user) {
        $checkemails = $this->db->prepare("SELECT * FROM emailactivate WHERE email=? AND code=? ");
        $checkemails->execute(array($user, $code));
        if ($checkemails) {
            $updateuser = $this->db->prepare("UPDATE user SET emailverified=1 WHERE email=?");
            $updateuser->execute(array($user));
            $deleteactivation = $this->db->prepare("DELETE FROM emailactivate WHERE email=? AND code=? ");
            $deleteactivation->execute(array($user, $code));
            header('location: ' . SITE_URL . '/dashboard');
        }
        header('location: ' . SITE_URL . '/dashboard');
    }

   

 

    public function userfees() {
        $gettrades = $this->db->prepare("SELECT sum(cost) as total FROM trades WHERE user=?");
        $gettrades->execute(array($_SESSION['user']));
        $nofee = $this->db->prepare("SELECT nofees FROM user WHERE username=?");
        $nofee->execute(array($_SESSION['user']));
        $nofees = $nofee->fetch();
        $total = $gettrades->fetch();
        if ($nofees->nofees == 1) {
            return 0;
        } else if (round($total->total, 4) >= 10000) {
            //0.35%
            return 0.035;
        } else if (round($total->total, 4) >= 750000) {
            //0.30%
            return 0.030;
        } else if (round($total->total, 4) >= 2500000) {
            //0.25%
            return 0.025;
        } else if (round($total->total, 4) >= 1000000) {
            //0.15%
            return 0.015;
        } else {
            //0.40%
            return 0.04;
        }
    }

    //user roles, admin,mod, support etc
 

    public function userverified() {
        $sql = $this->db->prepare("SELECT detailverified FROM user WHERE username=?");
        $sql->execute(array($_SESSION['user']));
        return $sql->fetch();
    }


    public function Getguides($SITE_URL) {
        if (preg_match('/^[-a-zA-Z ]+$/', $SITE_URL)) {
            $getguide = $this->db->prepare("SELECT message FROM userguides WHERE SITE_URL=?");
            $getguide->execute(array($SITE_URL));
            return $getguide->fetch();
        }
    }


    public function withdraw($coin, $startcoin, $amount, $withdrawaddress) {
        //initiate gettext because we're not including the header
        //using number format to stop 9.9E-5  type shit from happening
        //checkbalance
        //make sure their amount is more than 0.0001
        $minval = explode('.', $amount);
        if (strlen($minval[1]) > 4): header('location: ' . SITE_URL . 'transfer/withdraw?error=4');
            exit();
        endif;
        $balance = $this->db->prepare("SELECT " . $coin . " FROM user WHERE username=?");
        $balance->execute(array($_SESSION['user']));
        $userbalance = $balance->fetch();
        $validate = $startcoin->validateaddress($withdrawaddress);
        if ($validate['isvalid'] == false): header('location: ' . SITE_URL . 'transfer/withdraw?error=3');
            die();
        endif;
        if ($userbalance->$coin >= $amount && isset($withdrawaddress)) {
            if ($startcoin->getbalance() >= $amount) {
                $amounts = floatval(str_replace(",", "", number_format(($amount), 4))) - 0.0002;

                $txid = $startcoin->sendtoaddress($withdrawaddress, $amounts);
                if ($txid != '') {
                    $newbalance = round($userbalance->$coin - $amount, 6);
                    $updatebalance = $this->db->prepare("UPDATE user SET btc=? WHERE username=?");
                    $updatebalance->execute(array(number_format($newbalance, 6), $_SESSION['user']));
                    $time = strtotime("now");
                    $date = date("y-m-d h:i:s");
                    $addwithdraw = $this->db->prepare("INSERT INTO 
				transactions(address,username,txid,amount,time,date,transaction,status,market) 
				VALUES(?,?,?,?,?,?,'withdraw','1',?)");
                    $addwithdraw->execute(array(
                        $withdrawaddress,
                        $_SESSION['user'],
                        $txid,
                        number_format($amount, 6),
                        $time,
                        $date,
                        $coin));
                    return true;
                }
            }
        }
    }


 
    public function admintotaltrades($coin) {
        $totalval = $this->db->prepare("SELECT sum(amount) AS total FROM trades WHERE
		maincoin=?");
        $totalval->execute(array($coin));
        return $totalval->fetch();
    }



    public function sitenews($SITE_URL) {
        $news = $this->db->prepare("SELECT * FROM news WHERE page=? OR page=? ORDER BY date DESC");
        $news->execute(array($SITE_URL, 'all'));
        $sitesnews = $news->fetch();
        if ($sitesnews):
            if ($sitesnews->enabled == 1):
                if ($SITE_URL == $sitesnews->page):
                    echo '<div class="alert alert-info col-sm-6 col-sm-offset-3">' . $sitesnews->title . '</div>';
                endif;
            endif;
        endif;
    }


  


}

?>
