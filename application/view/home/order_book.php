<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('<?php echo SITE_URL; ?>home/datacharts', function (data) {


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
<div id="container" style="height: 400px; min-width: 310px"></div>
<br/><br/>
<div class="col-sm-6">
    <h2 style="font-family: Inika; font-weight: 700; font-size: 30px;"><?php echo Filtration\Core\System::translate("Current Buy Orders"); ?></h2>
    <div class="panel panel-flat">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" data-max="100">
                <thead>
                    <tr>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Value"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->buyorders as $orders): ?>
                        <tr>
                            <td><?php echo System::escape($orders->order_price); ?></td>
                            <td><?php echo System::escape($orders->order_amount); ?></td>
                            <td><?php echo System::escape($orders->order_cost); ?></td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <h2 style="font-family: Inika; font-weight: 700; font-size: 30px;"><?php echo Filtration\Core\System::translate("Current Sell Orders"); ?></h2>
    <div class="panel panel-flat">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" data-max="100">
                <thead>
                    <tr>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Value"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->sellorders as $orders): ?>
                        <tr>
                            <td><?php echo System::escape($orders->price); ?></td>
                            <td><?php echo System::escape($orders->amount); ?></td>
                            <td><?php echo System::escape($orders->cost); ?></td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <h2 style="font-family: Inika; font-weight: 700; font-size: 30px;"><?php echo Filtration\Core\System::translate("Recent Trades"); ?></h2>
    <div class="panel panel-flat">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" data-max="100">
                <thead>
                    <tr>
                        <th><?php echo Filtration\Core\System::translate("Date"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Price"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Amount"); ?></th>
                        <th><?php echo Filtration\Core\System::translate("Value"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->trades as $orders): ?>
                        <tr>
                            <td><?php echo System::escape($orders->trade_date); ?></td>
                            <td><?php echo System::escape($orders->trade_price); ?></td>
                            <td><?php echo System::escape($orders->trade_amount); ?></td>
                            <td><?php echo System::escape($orders->trade_cost); ?></td>
                        <tr>
                        <?php endforeach; ?>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>		



</div>