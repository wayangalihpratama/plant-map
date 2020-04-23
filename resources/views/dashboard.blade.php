@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
  <section class="content-header">  
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Charts</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Filter -->
      <div class="card collapsed-card">
        <div class="card-header border-transparent">
          <h3 class="card-title">Filter</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-3">
              <div class="form-group">
                <label>Province</label>
                <select 
                  id="filterProvince" 
                  class="form-control select2bs4" 
                  style="width: 100%;"
                  onchange="filterProvinceOnChange(this.value)"
                >
                  <option value="0">Default</option>  
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Country</label>
                <select 
                  id="filterCountry" 
                  class="form-control select2bs4" 
                  style="width: 100%;"
                  onchange="filterCountryOnChange(this.value)"
                >
                  <option value="0">Default</option>    
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Type</label>
                <select 
                  id="filterType" 
                  class="form-control select2bs4" 
                  style="width: 100%;"
                  onchange="filterTypeOnChange(this.value)"  
                >
                  <option value="0">Default</option>  
                </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label>Tree</label>
                <select 
                  id="filterTree" 
                  class="form-control select2bs4" 
                  style="width: 100%;"
                  onchange="filterTreeOnChange(this.value)"
                >
                  <option value="0">Default</option>  
                </select>
              </div>
            </div>
          </div>
          <!-- ./filter -->
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->      

      <div class="row mb-2 center">
        <div class="col-md-4 center">
          <div style="height:300px;" id="pie">Pie</div>
        </div>
        <div class="col-md-8 center">
          <div style="height:300px;" id="pieCountry">Bar</div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-md-12">
          <div style="height:600px;" id="main">Map</div>
        </div>
      </div>    
    </div>
  </section>
  <!-- /.content -->
@endsection

@section('js')
  <script src="{{asset('js/map/init.js')}}"></script>
  <script src="{{asset('js/map/param.js')}}"></script>

  <script src="{{asset('js/map/areas.js')}}"></script>
  <script src="{{asset('js/map/locations.js')}}"></script>
  <script src="{{asset('js/map/types.js')}}"></script>
  <script src="{{asset('js/map/trees.js')}}"></script>

  <script src="{{asset('js/map/pie.js')}}"></script> 
  <script src="{{asset('js/map/bar.js')}}"></script> 
  <script src="{{asset('js/map/map.js')}}"></script>
  
  <script src="{{asset('js/map/filter.js')}}"></script>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  </script>
@endsection