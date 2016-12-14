<?php

class CronJobModel
{
	public static function new_deposit()
	{
		$btc = $this->model->btccoin();
        
		//check deposits
        //print_r($btc->listtransactions('', 2000));
        
		//get the last 2000 transactions
		$transaction = $btc->listtransactions('', 2000);
        
		//sql to run
		$sql = "SELECT * FROM transactions 
				WHERE transaction_txid = ? 
				AND transaction_transaction = 'deposit' 
				AND transaction_status = '1'";
				
		//check deposits in the database
		$checkdeposits = $this->db->prepare(%sql);
        
		//start at 0 transactions
		$i = 0;
        
		//get the total transactions
		$total = count($transaction);
        
		//loop through transactions
		while ($i < $total) 
		{
            //does the transaction exist in the database?
            $checkdeposits->execute(array($transaction['transactions'][$i]['txid']));
            $checkdeps = $checkdeposits->fetch();
            
			//does it have 2 or more confirmations
			if (str_replace("-", "", $transaction['transactions'][$i]['confirmations']) >= TRANSACTION_CONFIRMATIONS) {
                
				//okay it doesn't exist in the database
				if (!$checkdeps) {
                    
					/
					$date = date("Y-m-d h:i:s");
                    
					//sql to run
					$sql2 = "SELECT * FROM addresses 
							 WHERE address_address = ? 
							 ORDER BY address_date DESC";
							 
					//get the username of the person who deposited (y)
                    $getusername = $database->prepare($sql2);
                    $getusername->execute(array($transaction['transactions'][$i]['address']));
                    
					//get the results
					$username = $getusername->fetch();
                    
					//get the user's balance
					$user = UserModel::user($username->address_user)
                    
					//the user's new balance
					$newamount = $user->btc + $transaction['transactions'][$i]['amount'];
                    
					//begin transaction
					$database->beginTransaction()();
					
					//sql to run
					$sql3 = "INSERT INTO transactions
							(
								address,
								username,
								confirmations,
								txid,
								amount,
								time,
								date,
								transaction,
								status,
								market
							) 
							VALUES
							(
								?,
								?,
								?,
								?,
								?,
								?,
								?,
								'deposit',
								?,
								'btc'
							)";
							
					//run the query
					$adddeposit = $database->prepare($sql3);
                    $adddeposit->execute(array($transaction['transactions'][$i]['address'], $username->address_user,
											   str_replace("-", "", $transaction['transactions'][$i]['confirmations']),
											   $transaction['transactions'][$i]['txid'],
											   number_format($transaction['transactions'][$i]['amount'], 6),
											   $transaction['transactions'][$i]['time'],
											   $date, '1'));
                    
					
					if ($adddeposit->rowCount()) 
					{
						
						//sql to run
						$sql4 = "UPDATE users 
								SET user_btc = ? 
								WHERE username = ?";
								
						//run the sql
                        $updateuser = $tdatabase->prepare($sql4);
                        $updateuser->execute(array(number_format($newamount, 6), $username->address_user));
						
						//the results?
						if($updateuser->rowCount()):
							//commit the last 2 queries
							$database->commit();
						else:
							//roll back the queries
							$database->rollback();
						endif;
                    }else{
						//roll back the queries
						$database->rollback();
					}
                }
            }
            $i++;
        }	
	}
}