@extends('layouts.app')

@section('content')

<div class="container mt-5">
<div class="d-flex align-items-center justify-content-center text-center mb-4">
    <img src="{{ URL('images/dashboard.png') }}" class="img-fluid mr-3" width="50" height="50" alt="Contact List Image">
    <h1 style="color: #052415;">Dashboard</h1>
</div>


<!-- Container for the table data -->

<div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row mt-5">
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                        <svg class="icon">
                          <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>Orders</div>
                  </div>

                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                        <svg class="icon">
                          <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-top"></use>
                        </svg>)</span></div>
                    <div>Purchase Price	</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                        <svg class="icon">
                          <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-top"></use>
                        </svg>)</span></div>
                    <div>Retail Price	</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3" style="height:70px;">
                  <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-3">
              <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                        <svg class="icon">
                          <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-arrow-bottom"></use>
                        </svg>)</span></div>
                    <div>	Deal Price</div>
                  </div>
                  <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <svg class="icon">
                        <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-options"></use>
                      </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                  </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                  <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>







    <div class="d-flex">
        <!-- Display User Registrations -->
        <div style="flex: 1; height: 370px; width: 50%; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; margin-right: 10px;">

            <canvas id="userChart"></canvas>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var ctx = document.getElementById('userChart').getContext('2d');
                    var chart = new Chart(ctx, {

                        type: 'line',
                        data: {
                            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                            datasets: [
                                {
                                    label: 'Active Users',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    data: [40, 42, 38, 50, 35],
                                },
                                {
                                    label: 'Inactive Users',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    data: [8, 7, 10, 8, 9],
                                },
                                {
                                    label: 'Banned Users',
                                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                                    borderColor: 'rgba(255, 205, 86, 1)',
                                    borderWidth: 1,
                                    data: [2, 1, 0, 2, 1],
                                },
                            ],
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: " User Status Over a Week ",
                                },
                            },
                        },
                    });
                });
            </script>
        </div>

        <!-- Display CanvasJS Chart -->
        <div id="chartContainer" style="flex: 1; height: 370px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></div>
        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
        <script>
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    title: {
                        text: " User Registrations and Deletions Over a Week"
                    },
                    axisY: {
                        title: "Count"
                    },
                    data: [
                        {
                            type: "line",
                            name: "User Registrations",
                            showInLegend: true,
                            dataPoints: [
                                { "y": 18, "label": "Sunday" },
                                { "y": 15, "label": "Monday" },
                                { "y": 25, "label": "Tuesday" },
                                { "y": 5, "label": "Wednesday" },
                                { "y": 10, "label": "Thursday" },
                                { "y": 0, "label": "Friday" },
                                { "y": 20, "label": "Saturday" }
                            ]
                        },
                        // Additional Line for Users Deletions
                        {
                            type: "line",
                            name: "Users Deletions",
                            showInLegend: true,
                            dataPoints: [
                                { "y": 5, "label": "Sunday" },
                                { "y": 3, "label": "Monday" },
                                { "y": 8, "label": "Tuesday" },
                                { "y": 1, "label": "Wednesday" },
                                { "y": 4, "label": "Thursday" },
                                { "y": 0, "label": "Friday" },
                                { "y": 6, "label": "Saturday" }
                            ]
                        },
                    ]
                });
                chart.render();
            }
        </script>
    </div>

    <!-- Display Products -->
    <div>
        <h2>Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Orders</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $date => $product)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $product['orders'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Display Sales -->
    <div>
        <h2>Sales</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Purchase Price</th>
                    <th>Retail Price</th>
                    <th>Deal Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $date => $sale)
                <tr>
                    <td>{{ $date }}</td>
                    <td>{{ $sale['purchase_price'] }}</td>
                    <td>{{ $sale['retail_price'] }}</td>
                    <td>{{ $sale['deal_price'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Container for the chart -->
    <div class="charts">
        <div id="apexcharts-line" style="height: 400px; width: 49%;"><h3 style="text-align:center;">Price Trends Over Time</h3></div>


        <div class="linechart" style="height: 400px; width: 49%; margin: auto; display: flex; justify-content: center; align-items: center;">
        <h3>Monthly Orders </h3>
    <canvas id="chartjs-line"></canvas>
     </div>

    </div>

    <!-- Display Top Searches Week-wise -->
    <div>
        <h2>Top Searches Week-wise</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Query</th>
                    <th>Count</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wSearches as $date => $value)
                    @if ($value)
                        <tr>
                            <td>{{ $value->updated_at }}</td>
                            <td>{{ $value->query }}</td>
                            <td>{{ $value->count }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

<!-- Display Top Searched Items -->
<div>
    <h2>Top Searched Items</h2>
    <ul>
        @foreach ($tSearches->take(10) as $item)
            <li>
                {{ $item->query }} = {{ $item->count }}

                <!-- Soft Delete Button -->
                <form method="post" action="{{ route('derank.search', ['id' => $item->id]) }}" style="display:inline;">
                    @csrf
                    @method('delete') <!-- Use 'delete' method for soft delete -->

                    <!-- Soft Delete Button -->
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>


    </ul>
</div>











<!-- JavaScript code for ApexCharts -->
<div id="apexcharts-line">
  <script>

    var apexOptions = {
      chart: {
        height: 350,
        type: "line",
        zoom: {
          enabled: false
        },
      },
      dataLabels: {
        enabled: false
      },
      series: [
        {
          name: "Purchase price",
          data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
        },
        {
          name: "Retail price",
          data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
        },
        {
          name: "Deal price",
          data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
        }
      ],
      markers: {
        size: 0,
        style: "hollow",
      },
      xaxis: {
        categories: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "08 Jan", "09 Jan", "10 Jan", "11 Jan", "12 Jan"],
      },
      tooltip: {
        y: [{
          title: {
            formatter: function (val) {
              return val + " (mins)"
            }
          }
        }, {
          title: {
            formatter: function (val) {
              return val + " per session"
            }
          }
        }, {
          title: {
            formatter: function (val) {
              return val;
            }
          }
        }]
      },
      grid: {
        borderColor: "#f1f1f1",
      }
    };

    var apexChart = new ApexCharts(document.querySelector("#apexcharts-line"), apexOptions);

    apexChart.render().then(() => {
      var chartContainer = document.querySelector("#apexcharts-line");
      chartContainer.style.backgroundColor = "#ffffff";
      chartContainer.style.boxShadow = "0 4px 6px rgba(0, 0, 0, 0.1)";
      chartContainer.style.borderRadius = "10px";
    });
  </script>
</div>









<!-- Chart.js Line Chart -->


<script>
// Define the data for the Chart.js Line Chart
var chartData = {
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
  datasets: [{
    label: "Quantity",
    fill: true,
    backgroundColor: "transparent",
    borderColor: "#007BFF", // You can set your desired color here
    data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
  }, {
    label: "Orders",
    fill: true,
    backgroundColor: "transparent",
    borderColor: "#adb5bd",
    borderDash: [4, 4],
    data: [958, 724, 629, 883, 915, 1214, 1476, 1212, 1554, 2128, 1466, 1827]
  }]
};

// Define the options for the Chart.js Line Chart
var chartOptions = {
  scales: {
    x: [{
      reverse: true,
      grid: {
        color: "rgba(0, 0, 0, 0.05)"
      }
    }],
    y: [{
      borderDash: [5, 5],
      grid: {
        color: "rgba(0, 0, 0, 0)",
        fontColor: "#fff"
      }
    }]
  }
};

// Create the Chart.js Line Chart
var ctx = document.getElementById("chartjs-line").getContext("2d");
var chart = new Chart(ctx, {
  type: "line",
  data: chartData,
  options: chartOptions
});
</script>

<script>
  // JavaScript code for the chart
  new Chart(document.getElementById("chartjs-line"), {
    type: "line",
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [
        {
          label: "Sales ($)",
          fill: true,
          backgroundColor: "transparent",
          borderColor: window.theme.primary,
          data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
        },
        {
          label: "Orders",
          fill: true,
          backgroundColor: "transparent",
          borderColor: "#adb5bd",
          borderDash: [4, 4],
          data: [958, 724, 629, 883, 915, 1214, 1476, 1212, 1554, 2128, 1466, 1827]
        },
        {
          label: "Quantity",
          fill: true,
          backgroundColor: "transparent",
          borderColor: "#your_color_for_quantity", // Set your desired color for Quantity
          data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
        }
      ]
    },
    options: {
      scales: {
        xAxes: [{
          reverse: true,
          gridLines: {
            color: "rgba(0,0,0,0.05)"
          }
        }],
        yAxes: [{
          borderDash: [5, 5],
          gridLines: {
            color: "rgba(0,0,0,0)",
            fontColor: "#fff"
          }
        }]
      }
    }
  });
</script>



@endsection
