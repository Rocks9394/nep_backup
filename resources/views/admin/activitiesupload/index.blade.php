@extends('admin.layouts.app')
@section('title', 'Goforfit Admin-All tags Class')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <a class="" href=""> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
            <h1 scope="col">Import Activity</h1>
          </div>
    </div>  
      
    <div class="row mb-2">  
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
                <div class="pull-right">
                    
                </div>              
            </ol>
          </div>
      
      <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">               
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Activity</li>
            </ol>
          </div>
      
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Import Activity</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="import" method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="file" name="file" class="form-control">
              <button class="btn btn-success btn-sm">Import Activity</button>
              <!--<a class="btn btn-primary" href="export">Export User Data</a>-->
             </form>  
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection