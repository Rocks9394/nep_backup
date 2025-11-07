@extends('admin.layouts.app')
@section('title', 'Goforfit Admin-All Tags')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
     <div class="row mb-2">
      <div class="col-sm-12">       
    <a class="" href="{{ route('admin.tags.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>
      <h1>Edit Tags</h1>
      </div>
     </div>
    
        <div class="row mb-2">          
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">                
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Tags</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Tags</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.tags.update', $tag->id) }}" enctype="multipart/form-data">
                      @csrf
                       @method('PATCH')
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
                        <div class="form-group">
                          <label for="exampleInputEmail1" scope="col">Tag :</label>
                          <input type="text" name="title" value="{{ $tag->name }}" class="form-control" id="title" placeholder="Enter Tags">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1" scope="col">Parent :</label>
                        <select name="parent_name" class="form-control" style="width:100% !important;">
                          <?php               
                           if(!empty($tag_parent)){               
                             foreach($tag_parent as $cls){
                                              if($cls->name1==$tag->name){
                              continue;
                            }else{                     
                          ?>
                           <option <?=$cls->id1 == $tag->id ? ' selected="selected"' : '';?> value="{{ $cls->id1 }}"><?=ucwords(strtolower($cls->name1));?></option>                  
                          <?php } ?>  
                          <?php } } ?>  
                        </select>

                          <div class="form-check form-check-radio form-check-inline">
                            <label class="form-check-label">
                            <input class="form-check-input" checked="checked" type="radio" name="status" id="inlineRadio1" value="1" <?=$tag->status=="1" ? "checked" : "" ?>>Active
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                            </label>
                          </div>
                          <div class="form-check form-check-radio form-check-inline">
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0" <?=$tag->status=="0" ? "checked" : "" ?>> In Active
                            <span class="circle">
                              <span class="check"></span>
                            </span>
                            </label>
                          </div>      
                        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary"><?=!empty($class->id) ? "Update" : "Update" ?></button>
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