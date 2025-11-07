@extends('admin.layouts.app')
@section('title', 'upload - Goforfit')

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
          
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
		<h3 class="card-title">Import PGTs</h3>
        </div>
		<div class="card-body">
					@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
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
            <form action="{{ route('admin.submitteacher') }}" method="POST" enctype="multipart/form-data">
                @csrf
				<div class="col-md-6">
											<div class="form-group">
											<label>NVS Region</label>
											<select id="chainopts" name="regions" aria-required="true" 
											class="form-control @error('regions') is-invalid @enderror" value="{{ old('regions') }}">
											<option value="">Select region</option>
											@foreach($regions as $region)
											<option value="{{$region->id}}">{{ $region->name }}</option>                              
											@endforeach
											</select>
											{!!$errors->first("regions", "<span class='text-danger'>:message</span>")!!}
											</div>
										
				</div>
				<div class="col-md-6">
					<div class="form-group">
                <input type="file" name="file" class="form-control">
                <br>
				</div>
				</div>
                <button class="btn btn-success">Import Bulk Data</button>
                
            </form>
			<P style="color:blue;">Please download the excel format to upload school details accordingly<a href=" " target="_blank">
		<button class="btn btn-primary">Download</button></a>  </P>     
		</div>
         
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
	
  </div>


@endsection
