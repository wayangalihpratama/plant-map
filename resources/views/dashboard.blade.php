@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">  
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Blank Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div style="width:100%; height:600px;" id="main">Map</div>
  </section>
  <!-- /.content -->
@endsection

@section('js')
  <script>
    // initialize echarts instance with prepared DOM
    var myChart = echarts.init(document.getElementById('main'));

    var data = {
      areas: [],
      currentPage: 1,
      lastPage: 0,
      total: 0,
    };

    var axis = [];
    var test = [];

    const showChart = () => {
      myChart.hideLoading();          
      // draw chart
      myChart.setOption({
        title: {
          text: 'ECharts entry example'
        },
        tooltip: {},
        xAxis: {
          data: axis
        },
        yAxis: {},
        series: [{
          name: 'sales',
          type: 'bar',
          data: test
        }]
      });
    };

    const loadData = (page) => {
      myChart.showLoading();
      axios.get('/api/areas?page=' + page)
        .then(res => {
          data.areas = [...data.areas, ...res.data.data];
          data.currentPage = res.data.current_page;
          data.lastPage = res.data.last_page;
          data.total = res.data.total;

          if (data.currentPage < data.lastPage) {
            loadData(data.currentPage + 1);
          } else {
            localStorage.setItem('areas', JSON.stringify(data.areas));
          }

          axis.push('Axis ' + data.currentPage);
          test.push(data.currentPage + 10);

          showChart();
        });
    };

    (!localStorage.getItem('areas'))
      ? loadData(data.page)
      : showChart();
  </script>
@endsection