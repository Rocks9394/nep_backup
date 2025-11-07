@extends('admin.layouts.app')
@section('title', 'Goforfit Admin-All tags Class')
@section('content')
<style>
.mb-3{ margin-bottom: 0 !important; margin-right: 10px; }
.btn-sm{ padding: .375rem .75rem; }
.rtside{ float:right; }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tags</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Tags</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
     <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
      <div class="card">
        <div class="card-header">
        <div class="row">
        <div class="col-md-2">
         <a href="{{ route('admin.tags.create') }}"> <input type="submit" value="Create New Tags" class="btn btn-sm btn-success float-left"> </a>
          <br>
        </div>
        <div class="col-md-10">
        
          </div> 
          </div>
        </div>
              <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
              
          <table class="table table-striped projects">
              <thead >
                  <tr class="thead-dark">
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
               <?php $i=0; ?>
              @foreach($tags as $cls)
                  <tr>
                     <th scope="row">{{++$i}}</th>
                     <td style="width:200px;">{{ $cls->name }}</td>                    
                     <td><?=(!empty($cls->status)&& $cls->status==1 ? 'Active' : 'In Active');?></td>
                     <td class="form-check form-check-radio form-check-inline">
                      <a style="display: inline !important;" class="btn btn-info btn-xs" href="{{ route('admin.tags.edit',$cls->id) }}"> <i class="fas fa-pencil-alt"></i></a>
                       &nbsp;&nbsp;
                          <form action="{{ route('admin.tags.destroy',$cls->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                           <button  style="display: inline !important;"class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i>&nbsp;</button>
                         </form>
                     </td>  
                     <td></td>  
                    </tr>
            @endforeach
              </tbody>
          </table>
         
         </div>
      </div>
        </div>
      </div>
      </div>
    </section>
    
  </div>
@endsection