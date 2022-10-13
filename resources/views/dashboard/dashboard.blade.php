@extends('admin.layouts.app')
@section('content')
<!-- Style Css -->
<link rel="stylesheet" href="{{ asset('public/dashboard-assets/css/pages-css/index.css') }}" />
<!-- Style Css -->
@if( Session::has('orig_user') )
<div class=" p-3 mb-2 bg-primary text-white">

  <span>You are now logged in as <strong>{{Auth()->user()->name }}</strong> Click
    <a href="{{url('/shadow/return')}}">here</a>
    to return back
  </span>
</div><br>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>{{ $message }}</strong>
</div>
@endif
<div class="dash-home-cards">
  <div class="row row-cols-xxl-4 row-cols-xl-3 row-cols-md-2 row-cols-1 top-cards">
    <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
      <div class="card">
        <a class="card-body" href="{{url('logActivity')}}">
          <p class="cart-title">User History</p>
          <div class="card-results">
            <h5 class="main-results">{{\App\Models\LogActivity::count()}}</h5>
            <p class="perstant-result text-success"><i class=""></i> </p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
      <div class="card">
        <a class="card-body" href="{{url('dashboard/users')}}">
          <p class="cart-title">Users</p>
          <div class="card-results">
            <h5 class="main-results">{{ \App\Models\User::count() }}</h5>
            <p class="perstant-result text-success"><i class=""></i> </p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
      <div class="card">
        <a class="card-body" href="{{url('dashboard/logs')}}">
          <p class="cart-title">Logs</p>

          <div class="card-results">
            <h5 class="main-results">{{ \App\Models\Logger::count()}}</h5>
            <p class="perstant-result text-success"><i class=""></i> </p>
          </div>
        </a>
      </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3 mb-25 mb-lg-45">
      <div class="card">
        <a class="card-body" href="{{url('notifications')}}">
          <p class="cart-title">Notifications</p>
          <div class="card-results">
            <h5 class="main-results">{{ \Modules\Notification\Entities\Notification::count() }}</h5>
            <p class="perstant-result text-success"><i class=""></i> </p>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <figure class="highcharts-figure">
          <div id="container"></div>
        </figure>
      </div>
    </div>
  </div>
</div>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">

  var userData = {{json_encode($userdata)}}

  Highcharts.chart('container', {
    title: {
      text: 'User Growth'
    },


    xAxis: {
      categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
      ]
    },
    yAxis: {
      title: {
        text: 'Number of New Users'
      }
    },
    legend: {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle'
    },
    plotOptions: {
      series: {
        allowPointSelect: true
      }
    },
    series: [{
      name: 'New Users',
      data: userData
    }],
    responsive: {
      rules: [{
        condition: {
          maxWidth: 500
        },
        chartOptions: {
          legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
          }
        }
      }]
    }
  });
</script>
@endsection