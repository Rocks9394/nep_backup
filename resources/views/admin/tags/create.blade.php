@extends('admin.layouts.app')
@section('title', 'Goforfit Admin-All Tag')
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
            <a class="" href="{{ route('admin.tags.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
            <h1 scope="col">Add Tags</h1>
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
              <li class="breadcrumb-item active"aria-current="page">tags</li>
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
                <h3 class="card-title">Add tags</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.tags.store') }}" enctype="multipart/form-data">
                      @csrf
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                        @endif
                            <h4 class="card-title">Tag :</h4>
                							<div class="form-group">								
                								<input type="text" name="title" class="form-control" placeholder="Enter Tags">
                							</div>
                							<h4 class="card-title"> Parent :</h4>
                							<select name="parent_name" class="form-control" style="width:100% !important;">
                							  <option value="">Select Tag</option>		
                							  <?php								
                								 if(!empty($tag_parent)){								
                								   foreach($tag_parent as $cls){									
                								?>
                								 <option value="{{ $cls->id1 }}"><?=ucwords(strtolower($cls->name1));?></option>									
                								<?php } } ?>	
                							</select>
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1">Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0"> In Active
                              <span class="circle">
                                <span class="check"></span>
                              </span>
                              </label>
                            </div>      
                        </div>
                        <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                    </div>
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