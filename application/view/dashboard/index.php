<div class="panel-heading">
    <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Trading Chart"); ?></h3>
</div>
<div class="panel-body">
    <div id="chartdiv" style="width:100%; height:500px;"></div>
    <div class="alert alert-info" id="no-trades">
        <?php echo Filtration\Core\System::translate("There are currently not trades to display"); ?>
    </div>
</div>


<div class="col-sm-6" id="tradingsection">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"> 
                <?php echo Filtration\Core\System::translate("Buy").strtolower($this->coin2[1]); ?> </h3>
                <div class="pull-right"><b><div id="currentbuyprice"></div> 
                    <a href="<?php echo $this->user->{"user_".strtolower($this->coin2[1])}; ?>" id="buycalctotal">
                        <?php echo $this->user->{"user_".strtolower($this->coin2[1])} . ' ' . $this->coin2[1]; ?></b>
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form role="form" action="<?php echo SURL; ?>dashboard/trade_coin/<?php echo Filtration\Core\System::escape($this->coin); ?>" id="buy_coin" method="post">
                <div class="form-group">
                    <label class="control-label">
                        <?php echo Filtration\Core\System::translate("Amount of"); ?>
                        <?php echo $this->coin2[0]; ?>
                    </label>
                    <div class="row">
                        <div class="input-group input-group-lg spinner col-sm-12" min="0" data-step="1">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-single" data-type="decrement">-</button>
                            </span>
                            <input type="text" class="form-control text-center no-left-border" min="0" maxlength="10" name="amount" value="0">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-single" data-type="increment">+</button>
                            </span>
                        </div>
                        <br />
                        <label class="control-label">
                            <?php echo Filtration\Core\System::translate("Value of"); ?>
                            <?php echo $this->coin2[0]; ?>
                        </label>
                        <br />
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-<?php echo strtolower($this->coin2[1]); ?>"></i></span>
                            <input type="text" name="price" value="<?php echo number_format(Filtration\Model\TickerModel::{$this->coin2[1]}($this->coin2[1], 'buy'), 2); ?>" class="form-control" id="buyprice">
                        </div>
                    </div>
                    <br />
                    <button id="success_msg_1" class="btn btn-blue btn-icon pull-right">
                        <span> <?php echo Filtration\Core\System::translate("Buy"); ?> <?php echo $this->coin2[0]; ?></span>
                        <i class="fa fa-<?php echo strtolower($this->coin2[0]); ?>"></i>
                    </button>
            </form>
        </div>
    </div>
</div>
</div>



<!--- End of Buy Coin Collumn -->
<!-- Start of Sell Coin Collumn -->

<div class="col-sm-6 col-xs-12 ">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title"> 
                <?php echo Filtration\Core\System::translate("Sell"); ?>
                <div class="pull-right"><b><div id="currentsellprice"></div> 
                    <a href="<?php echo number_format($this->user->{"user_".strtolower($this->coin2[0])}, 4); ?>" id="buyorderamount">
                        <?php echo number_format($this->user->{"user_".strtolower($this->coin2[0])}, 4) . ' ' . Filtration\Core\System::escape($this->coin2[0]); ?>
                    </a></b>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form role="form" method="post" action="<?php echo SURL; ?>dashboard/trade_coin/<?php echo Filtration\Core\System::escape($this->coin); ?>" id="sell_coin">
                <div class="form-group">
                    <label class="control-label">
                        <?php echo Filtration\Core\System::translate("Amount of"); ?>
                        <?php echo $this->coin2[0]; ?>
                    </label>
                    <div class="row">
                        <!-- Input spinner, just add class "spinner" to input-group and it will be activated -->
                        <div class="input-group input-group-lg spinner col-sm-12" data-step="1">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-single" data-type="decrement">-</button>
                            </span>
                            <input type="text" class="form-control text-center no-left-border" maxlength="10" name="amount" value="0" />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-single" data-type="increment" >+</button>
                            </span>
                        </div>
                        <br />
                        <label class="control-label">
                            <?php echo Filtration\Core\System::translate("Value of"); ?>
                            <?php echo $this->coin2[0]; ?>
                        </label>
                        <br />

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-<?php echo strtolower($this->coin2[1]); ?>"></i></span>
                            <input type="text" class="form-control" name="price" value="<?php echo number_format(Filtration\Model\TickerModel::{$this->coin2[1]}($this->coin2[1], 'sell'), 2); ?>" />
                        </div>
                    </div>
                    <br />
                    <button class="btn btn-blue btn-icon pull-right"><span> 
                        <?php echo Filtration\Core\System::translate("Sell"); ?>
                        <?php echo $this->coin2[0]; ?></span>
                        <i class="fa fa-<?php echo strtolower($this->coin2[0]); ?>"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Sell Coin Collumn -->

<!-- Start Selling orders table -->
<div class="col-xs-12 col-sm-6">
    <!-- Basic Setup -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?php echo Filtration\Core\System::translate("Selling Orders"); ?></h3>
        </div>
        <div class="panel-body">
            <div>
                <div class="alert alert-info" id="no-selling-orders">
                    <?php echo Filtration\Core\System::translate("There are no orders in progress"); ?>
                </div>
                <table id="sellingorders" style="display:none;" class="table">
                    <thead>
                        <tr>
                            <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- End Selling orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->
<!--------------------------------- Start Buying orders table !------------------------------->

<div class="col-sm-6 col-xs-12">
    <!-- Basic Setup -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> <?php echo Filtration\Core\System::translate("Buying Orders"); ?></h3>
        </div>
        <div class="panel-body">
            <div>
                <div class="alert alert-info" id="no-buying-orders">
                    <?php echo Filtration\Core\System::translate("There are no orders in progress"); ?>
                </div>
                <table class="table" style="display:none;" id="buyingorders">
                    <thead>
                        <tr>
                            <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- End Sell orders table -->
<!-- Start Open orders table -->

<div class="col-sm-12 col-xs-12">
    <!-- Basic Setup -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Filtration\Core\System::translate("My Orders"); ?></h3>
        </div>
        <div class="panel-body">
            <div>                    
                <table class="table" id="openorders">
                    <thead>
                        <tr>		
                            <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Price"); ?></th>		  
                            <th><?php echo Filtration\Core\System::translate("Time"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Buy/Sell"); ?></th>
                            <th><?php echo Filtration\Core\System::translate("Actions"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- End Buying orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->
    <!--------------------------------- Start Trade orders table !------------------------------->

    <div class="col-sm-12 col-xs-12">
        <!-- Basic Setup -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Filtration\Core\System::translate("Trade History"); ?></h3>
            </div>
			
            <div class="panel-body">
                <div>
                    <?php if(!empty($this->trade)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                                    <th><?php echo Filtration\Core\System::translate("Coin"); ?></th>
                                    <th><?php echo Filtration\Core\System::translate("Cost"); ?></th>
                                    <th><?php echo Filtration\Core\System::translate("Time"); ?></th>
                                    <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                                    <th><?php echo Filtration\Core\System::translate("Buy/Sell"); ?></th>
                                </tr>
                            </thead>

                            <?php foreach ($this->trade as $trades) { ?>
                                <tr>
                                    <td><?php echo System::escape($trades->trade_amount); ?></td>
                                    <td><?php echo System::escape($trades->trade_market); ?></td>
                                    <td><?php echo System::escape($trades->trade_cost); ?></td>
                                    <td><?php echo System::escape($trades->trade_time); ?></td>
                                    <td><?php echo System::escape($trades->trade_date); ?></td>
                                    <td><?php echo System::escape($trades->trade_buysell); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-info">
                            <?php echo Filtration\Core\System::translate("There has been no completed trades"); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

<script type="text/javascript">

    $('#sell_coin').on("submit", function()
    {
       $.ajax(
        {
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize() + 
                '&coin=<?php echo strtolower($this->coin); ?>' + 
                '&buysell=sell',
            success: function (msg)
            {
                $.notify(msg, "info");
            }
        }); 
        return false;
    });

    $('#buy_coin').on("submit", function()
    {
        $.ajax(
        {
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize() + 
                '&coin=<?php echo strtolower($this->coin); ?>' + 
                '&buysell=sell',
            success: function (msg)
            {
                $.notify(msg, "info")
            }
        });
        return false;
    });


    $(document).ready(function () 
    {
        $("#sellamount").keypress(function (e) 
        {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                $("#sellamount").val(0);
                return false;
            }
        });


        $("#sellprice").keypress(function (e) 
        {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) 
            {
                $("#sellprice").val(0);
                return false;
            }
        });

        $("#buyprice").keypress(function (e) 
        {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) 
            {
                $("#buyprice").val(0);
                return false;
            }
        });

        $("#buyamount").keypress(function (e) 
        {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) 
            {
                $("#buyamount").val(0);
                return false;
            }
        });

    });

    $(document).ready(function ()
    {
        done();
        openorders();
        sellupdate();
        buyupdate();


        $("#buycalctotal").click(function (e)
        {
            e.preventDefault();
            var owned = Number($('#buycalctotal').attr('href'));
            var price = Number(document.getElementById('buyprice').value);
            var total = owned / price;
            document.getElementById('buyamount').value = total.toFixed(4);
            return false;
        });

        $("#buyorderamount").click(function (e)
        {
            e.preventDefault();
            $('#sellamount').val($('#buyorderamount').attr('href'));
            return false;
        });
    });


    function deleteorder(a, b) 
    {
        $.ajax(
        {
            type: 'GET',
            url: '<?php echo SURL; ?>/dashboard/deleteorders/',
            data: 'id=' + a + '&order=' + b,
            success: function ()
            {
                toastr.info("Order has been cancelled", "Order information", opts);
            }
        });
    }
    

    function done() 
    {
        setTimeout(function () 
        {
            openorders();
            sellupdate();
            buyupdate();
            done();
        }, 5000);
    }

    function set_price(a, b, c) 
    {
        buy_price = $("#sellprice");
        buy_amount = $("#sellamount");
        sell_price = $("#buyprice");
        sell_amount = $("#buyamount");
        buy_price.val(b);
        sell_price.val(b);
        1 == a && sell_amount.val(c);
        2 == a && buy_amount.val(c);
    }

    function openorders()
    {
        $.getJSON("<?php echo SURL; ?>/dashboard/myorders/<?php echo Filtration\Core\System::escape($this->coin); ?>/sell", function (data) 
        {
            $("#openorders").find('tbody').empty();
            $.each(data.result, function () 
            {
                $("#openorders").find('tbody').append("<tr><td>" + this['amount'] + "</td><td>" + this['cost'] + "</td><td>" + this['price'] + "</td><td>" + this['time'] + "</td><td>" + this['buysell'] + "</td><td style=\"cursor: pointer;\"  onclick=\"deleteorder(" + this['id'] + ",'" + this['buysell'] + "')\"> Cancel</td></tr>");
            })
        });
    }

    function sellupdate()
    {
        $.getJSON("<?php echo SURL; ?>/dashboard/openorders/<?php echo Filtration\Core\System::escape($this->coin); ?>/sell", function (data) 
        {
            if(!jQuery.isEmptyObject(data))
            {
                $('#no-selling-orders').hide();
                $('#sellingorders').show();
                $("#sellingorders").find('tbody').empty();
                $.each(data, function () 
                {
                    $("#sellingorders").find('tbody').append("<tr style=\"cursor: pointer;\" onclick=\"set_price(1," + this['price'] + "," + this['amount'] + ")\"><td>" + this['price'] + "</td><td>" + this['amount'] + "</td><td>" + this['cost'] + "</td></tr>");
                });
            }
            else
            {
                $('#sellingorders').hide();
            }
        });
    }

    function buyupdate()
    {
        $.getJSON("<?php echo SURL; ?>/dashboard/openorders/<?php echo Filtration\Core\System::escape($this->coin); ?>/buy", function (data) 
        {
            if(!jQuery.isEmptyObject(data))
            {
                $('#no-buying-orders').hide();
                $('#buyingorders').show();
                $("#buyingorders").find('tbody').empty();
                $.each(data, function () 
                {
                    $("#buyingorders").find('tbody').append("<tr onclick=\"set_price(2," + this['price'] + "," + this['amount'] + ")\"><td>" + this['price'] + "</td><td>" + this['amount'] + "</td><td>" + this['cost'] + "</td></tr>");
                });
            }
            else
            {
                $('#buyingorders').hide();
            }
        });
    }

    $(document).ready(function ()
    {
        pagetitle = document.title;
        $.get('<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/buy',
                updatetitle);

        function updatetitle(data)
        {
            document.title = "(" + data + ") " + pagetitle;
        }

        $('#currentbuyprice').load("<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/buy");
        
        $('#currentsellprice').load("<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/sell");
        
        setInterval(function ()
        {
            function updatetitle(data)
            {
                document.title = "(" + data + ") " + pagetitle;
            }
            $.get('<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/buy', updatetitle);
        }, 3000);
        
        setInterval(function ()
        {
            $('#currentbuyprice').load("<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/buy");
            $('#currentsellprice').load("<?php echo SURL; ?>/dashboard/dashboardprice/<?php echo Filtration\Core\System::escape($this->coin); ?>/sell");
        }, 35000)
    });

    AmCharts.loadJSON = function (SURL)
    {
        if (window.XMLHttpRequest)
        {
            var request = new XMLHttpRequest();
        }
        else
        {
            var request = new ActiveXObject('Microsoft.XMLHTTP');
        }
        request.open('GET', SURL, false);
        request.send();
        return eval(request.responseText);
    };

    var chartData = AmCharts.loadJSON('<?php echo SURL; ?>dashboard/chartdata/<?php echo strtolower(Filtration\Core\System::escape($this->coin)); ?>');
    var chart;

    AmCharts.ready(function ()
    {
        if(!jQuery.isEmptyObject(chartData))
        {   
            $('#no-trades').hide();          
            createStockChart();
        }

    });

    function createStockChart()
    {
        chart = new AmCharts.AmStockChart();
        chart.pathToImages = "<?php echo SURL; ?>/images/";
        var categoryAxesSettings = new AmCharts.CategoryAxesSettings();
        categoryAxesSettings.minPeriod = "mm";
        chart.categoryAxesSettings = categoryAxesSettings;
        var dataSet = new AmCharts.DataSet();
        dataSet.color = "#b0de09";
        dataSet.fieldMappings = [
            {
                fromField: "value1",
                toField: "value1"
            },
            {
                fromField: "value2",
                toField: "value2"
            }];
        dataSet.dataProvider = chartData;
        dataSet.categoryField = "date";
        chart.dataSets = [dataSet];
        var stockPanel1 = new AmCharts.StockPanel();
        stockPanel1.showCategoryAxis = false;
        stockPanel1.title = "Value";
        stockPanel1.percentHeight = 70;
        var graph1 = new AmCharts.StockGraph();
        graph1.valueField = "value1";
        graph1.type = "smoothedLine";
        graph1.lineThickness = 2;
        graph1.bullet = "round";
        graph1.bulletBorderColor = "#FFFFFF";
        graph1.bulletBorderAlpha = 1;
        graph1.bulletBorderThickness = 3;
        stockPanel1.addStockGraph(graph1);
        var stockLegend1 = new AmCharts.StockLegend();
        stockLegend1.valueTextRegular = " ";
        stockLegend1.markerType = "none";
        stockPanel1.stockLegend = stockLegend1;
        var stockPanel2 = new AmCharts.StockPanel();
        stockPanel2.title = "Volume";
        stockPanel2.percentHeight = 30;
        var graph2 = new AmCharts.StockGraph();
        graph2.valueField = "value2";
        graph2.type = "column";
        graph2.cornerRadiusTop = 2;
        graph2.fillAlphas = 1;
        stockPanel2.addStockGraph(graph2);
        var stockLegend2 = new AmCharts.StockLegend();
        stockLegend2.valueTextRegular = " ";
        stockLegend2.markerType = "none";
        stockPanel2.stockLegend = stockLegend2;
        chart.panels = [stockPanel1, stockPanel2];
        var scrollbarSettings = new AmCharts.ChartScrollbarSettings();
        scrollbarSettings.graph = graph1;
        scrollbarSettings.updateOnReleaseOnly = true;
        scrollbarSettings.usePeriod = "10mm";
        scrollbarSettings.position = "top";
        chart.chartScrollbarSettings = scrollbarSettings;
        var cursorSettings = new AmCharts.ChartCursorSettings();
        cursorSettings.valueBalloonsEnabled = true;
        chart.chartCursorSettings = cursorSettings;
        var periodSelector = new AmCharts.PeriodSelector();
        periodSelector.position = "top";
        periodSelector.dateFormat = "YYYY-MM-DD JJ:NN";
        periodSelector.inputFieldWidth = 150;
        periodSelector.periods = [
            {
                period: "hh",
                count: 1,
                label: "1 hour"
            },
            {
                period: "hh",
                count: 2,
                label: "2 hours"
            },
            {
                period: "hh",
                count: 5,
                label: "5 hour"
            },
            {
                period: "hh",
                count: 12,
                label: "12 hours"
            },
            {
                period: "MAX",
                label: "MAX"
            }];
        chart.periodSelector = periodSelector;
        var panelsSettings = new AmCharts.PanelsSettings();
        panelsSettings.mouseWheelZoomEnabled = true;
        panelsSettings.usePrefixes = true;
        chart.panelsSettings = panelsSettings;
        chart.write('chartdiv');
    }


</script>