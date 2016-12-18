
<h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("Developer Guide"); ?></h2>
<div class="panel-body">

    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title">Field Descriptions</h3>
        </div>
        <table class="table table-striped">
            <tbody><tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Public Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("This is the public key to identify your account"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Secret Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("A sha256 generated key for you to sign messages with"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Message"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("A value that will be encoded with the secret key "); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("API URL"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Depending on the API request depends on the SURL"); ?></td>
                </tr>
            </tbody></table>
    </div>

    <h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("Price Ticker"); ?></h2>
    <br/>

    <?php echo Filtration\Core\System::translate("Sample Response"); ?> <pre>{"BTC_USD":{"high":445,"low":384,"avg":414.5,"vol":1.0950625,"last":384,"buy": 397,"sell": 395}}</pre>


    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("btc_usd"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("This is the market, you can replace that value with a valid market in our system"); ?>
                        <a href="<?php echo SURL; ?>api/ticker?ticker=btc_usd"> <b>api/ticker?ticker=btc_usd</b> </a>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("btc_usd"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Highest completed trade in that market"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Low"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Lowest completed trade in that market"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("AVG"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Average price of trades in that market"); ?></td>
                </tr>	
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("VOL"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Total volume of trades in that market"); ?></td>

                </tr>	
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("LAST"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Price of last trade"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("BUY"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Current buy price for that pair"); ?></td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Sell"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Current sell price for that pair"); ?></td>
                </tr>				
            </tbody>
        </table>
    </div>


    <h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("My Orders"); ?></h2>
    <br/>

    <?php echo Filtration\Core\System::translate("Sample Response"); ?> 

    <pre>{"orders":[{"id":"135","market":"BTC_USD","amount":"0.48","cost":"109.6075","price":"219.215","buysell":"sell","beforefee":"0.5"}]}</pre> 

    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("API URL"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Send a POST request to the corresponding SURL "); ?>
                        <a href="<?php echo SURL; ?>api/orders/"> <b>api/orders/</b> </a> </a></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Public Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your public key "); ?></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Private Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message will need to be signed via SHA with your secret key"); ?></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Message"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message must be the number 1 to view all of your open orders"); ?></td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("My Transactions"); ?></h2>
    <br/>

    <?php echo Filtration\Core\System::translate("Sample Response"); ?> 

    <pre>{"transactions":[{"address":"1LNnnFnuLvaFZ7wnBzGri4FdfNEKqk3spD","txid":"fd57d8d0f7ec61de563da92f4e0ab0506fad5707ce3d146270829746ced82e25","amount":"0.02000000","type":"deposit","time":"1423176634"},}]}</pre> 

    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("API URL"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Send a POST request to the corresponding SURL "); ?>
                        <a href="<?php echo SURL; ?>api/orders/"> <b>api/transactions/</b> </a> </a></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Private Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message will need to be signed via SHA with your secret key"); ?></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Message"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message must be the number 1 to view all of your transactions"); ?></td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("Delete an order"); ?></h2>
    <br/>

    <?php echo Filtration\Core\System::translate("Sample Response"); ?> 
    <pre>{"result":[{"success":true,"deleted":"135"}]}</pre>

    <div class="panel panel-plain">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Field Descriptions"); ?></h3>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("API URL"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Send a POST request to the corresponding SURL "); ?>
                        <a href="<?php echo SURL; ?>api/deleteorder/"> <b>api/deleteorder/</b> </a> </a></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Private Key"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message will need to be signed via SHA with your secret key"); ?></td>
                    </td>
                </tr>
                <tr>
                    <td><strong><?php echo Filtration\Core\System::translate("Message"); ?></strong></td>
                    <td><?php echo Filtration\Core\System::translate("Your message must be the id of the order you wish to delete/cancel"); ?></td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>	

    <h2 style="font-family: Inika; font-weight: 700;"><?php echo Filtration\Core\System::translate("PHP Sample"); ?></h2>
    <br/>

    <pre>

    // User Public/Private Keys<br/>
    $private_key = 'fjeiwortjt94j3ifomwoe20r39tjgemof';<br/>
    $public_key = 'fwoe293rtjgemfor305t4-rgjmeo';<br/><br/>

    // Data to be submitted<br/>
    $data = '135';<br/><br/>

    // Generate content verification signature<br/>
    $sig = base64_encode(hash_hmac('sha1', $data, $private_key, TRUE));<br/>

    // Prepare json data to be submitted<br/>
    $json_data = json_encode(array('data'=>$data, 'sig'=>$sig, 'pubkey'=>$public_key));
    <br/><br/>
    // Finally submit to api end point<br/>
    echo SURLencode($json_data);

    </pre>

</div>
