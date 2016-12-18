<?php 
use Filtration\Model\CoinsModel;
?>
<div class="main-content">
    <div class="carousel slide " id="myCarousel">
        <!-- Indicators -->
        <div class="carousel-inner">
            <div class="item active">
                <img alt="First slide" src="img/slide/slide_3.png" />
                <div class="container">
                    <div class="carousel-caption">
                        <div class="md-intro" style="margin-top: 80.94px;">
                            <h1>
                                <?php echo Filtration\Core\System::translate("Welcome to") .' '.SITE_NAME; ?>
                            </h1>
                            <p class="md-description">
                            <h2><?php echo Filtration\Core\System::translate("Start trading Cryptocurrencies today"); ?></h2>
                            </p>
                            <div class="md-btn-group">
                                <a href="<?php echo SURL; ?>user/register" class="btn btn-large btn-success">
                                    <?php echo Filtration\Core\System::translate("Start trading"); ?>    
                                </a>
                                <a href="<?php echo SURL; ?>user/login" class="btn btn-border btn-blue"><?php echo Filtration\Core\System::translate("Login"); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-sm-offset-8">
        <select class="form-control" name="chartmarket" onchange="location = this.options[this.selectedIndex].value;">
            <option>Select Market</option>
            <?php foreach ($this->markets as $coinlinks) { ?>
                <option value="<?php echo SURL; ?>/home/order_book/<?php echo Filtration\Core\System::escape($coinlinks->coin_id); ?>">
                    <?php echo Filtration\Core\System::escape($coinlinks->coin_market); ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-sm-10 col-sm-offset-1">
        <div id="container" style="height: 400px; min-width: 310px"></div>
        <div class="row">
            <div id="liveorders" style="padding-top:55px;"></div>
        </div>

        <!--close .wrapper--> 
    </div>

    <section id="top" class="contain clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="heading centered"><span class="left"></span><span><?php echo Filtration\Core\System::translate("How it works"); ?></span><span class="right"></span></h3>
                </div>
                <div class="col-lg-3 aligncenter">
                    <img src="img/featured-1.png" class="aligncenter" alt="">
                    <h5><?php echo Filtration\Core\System::translate("Account management"); ?></h5>
                    <p>
                        <?php echo Filtration\Core\System::translate("Easily maintain your account. View orders, trades, transactions, whitelist IP's and much more"); ?>
                    </p>
                </div>
                <div class="col-lg-3 aligncenter">
                    <img src="img/featured-2.png" class="aligncenter" alt="">
                    <h5><?php echo Filtration\Core\System::translate("Multiple Markets"); ?></h5>
                    <p>
                        <?php echo Filtration\Core\System::translate("We have multiple Cryptocurrency markets for our users to trade against."); ?>
                    </p>
                </div>
                <div class="col-lg-3 aligncenter">
                    <img src="img/featured-3.png" class="aligncenter" alt="">
                    <h5><?php echo Filtration\Core\System::translate("API"); ?></h5>
                    <p>
                        <?php echo Filtration\Core\System::translate("Easily build 3rd party applications with our public and/or private API -- fully documented, easy to use."); ?>
                    </p>
                </div>
                <div class="col-lg-3 aligncenter">
                    <img src="img/featured-4.png" class="aligncenter" alt="">
                    <h5><?php echo Filtration\Core\System::translate("2Factor Authentication"); ?></h5>
                    <p>
                        <?php echo Filtration\Core\System::translate("To protect our users and their accounts we have implemented 2factor authentication."); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">// <![CDATA[
        var $ = jQuery.noConflict();
        $(document).ready(function () {
            $('#myCarousel').carousel({interval: 3000, cycle: true});
        });
        // ]]>
    </script>

<link rel="stylesheet" href="<?php echo SURL; ?>css/custom.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script>

  
    $(document).ready(function () {
        $("#liveorders").load("<?php echo SURL; ?>/home/liveorders");
        var refreshId = setInterval(function () {
            $("#liveorders").load('<?php echo SURL; ?>/home/liveorders/?randval=' + Math.random());
        }, 9000);
        $.ajaxSetup({cache: false});

    });


    $(document).ready(function () {
        $.getJSON('<?php echo SURL; ?>home/datacharts', function (data) {


            var ohlc = [],
                    volume = [],
                    dataLength = data.length,
                    groupingUnits = [[
                            'week',
                            [1]
                        ], [
                            'month',
                            [1, 2, 3, 4, 6]
                        ]],
                    i = 0;

            for (i; i < dataLength; i += 1) {
                ohlc.push([
                    data[i][0],
                    data[i][2],
                    data[i][2],
                    data[i][2],
                    data[i][2]
                ]);

                volume.push([
                    data[i][0],
                    data[i][1]
                ]);
            }

            $('#container').highcharts('StockChart', {
                rangeSelector: {
                    selected: 1
                },
                title: {
                    text: 'Trade Historical'
                },
                yAxis: [{
                        labels: {
                            align: 'right',
                            x: -3
                        },
                        title: {
                            text: 'Price'
                        },
                        height: '60%',
                        lineWidth: 2
                    }, {
                        labels: {
                            align: 'right',
                            x: -3
                        },
                        title: {
                            text: 'Volume'
                        },
                        top: '65%',
                        height: '35%',
                        offset: 0,
                        lineWidth: 2
                    }],
                series: [{
                        type: 'candlestick',
                        name: 'BTC',
                        data: ohlc,
                        dataGrouping: {
                            units: groupingUnits
                        }
                    }, {
                        type: 'column',
                        name: 'Volume',
                        data: volume,
                        yAxis: 1,
                        dataGrouping: {
                            units: groupingUnits
                        }
                    }]
            });
        });
    });

</script>