
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <div class="btn-group border-right-0">
            <button class="btn btn-sm border-right-0">
                <span data-feather="calendar"></span>
            </button>
        </div>
        <div class="input-group date  border-left-0" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input id="filterFrom" type="text" class="form-control" placeholder="Date from" value="<?php echo $from; ?>">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input id="filterTo" type="text" class="form-control" placeholder="Date to" value="<?php echo $to; ?>">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Total revenue
                    <span class="float-right" data-feather="credit-card"></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $statistic['total_revenue']; ?> &euro;</h5>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    Total orders
                    <span class="float-right" data-feather="file"></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $statistic['total_orders']; ?></h5>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <div class="card bg-success text-white mb-3">
                <div class="card-header">
                    Total customers
                    <span class="float-right" data-feather="users"></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $statistic['total_customers']; ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">Montly chart</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Share</button>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
        </div>

        <div class="btn-group border-right-0">
            <button class="btn btn-sm border-right-0">
                <span data-feather="calendar"></span>
            </button>
        </div>
        <div class="input-group date  border-left-0">
            <input id="filterMonth"  type="text" class="form-control monthPicker" placeholder="Date from" value="<?php echo $month; ?>">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>

    </div>
</div>

<canvas class="my-4" id="myChart" width="900" height="380"></canvas>

<h2>Last 10 orders</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Country</th>
                <th>Device</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['first_name']; ?> <?php echo $order['last_name']; ?></td>
                    <td><?php echo $order['country_name']; ?></td>
                    <td><?php echo $order['device_name']; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>


        </tbody>
    </table>
</div>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<script>

    var data = JSON.parse('<?php echo json_encode($graphic); ?>');

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.days,
            datasets: [
                {
                    label: "Orders",
                    data: data.orders,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                },
                {
                    label: "Customers",
                    data: data.customers,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#009312',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }
            ]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Monthly chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
            }
        }
    });
</script>