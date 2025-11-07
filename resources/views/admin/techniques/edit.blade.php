@extends('admin.layouts.app')
@section('title', 'Goforfit - Edit Technique')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
				<div class="col-sm-12">
					<a class="" href="{{ route('admin.techniques.index') }}"> <i class="fas fa-long-arrow-alt-left"></i> Back </a>     
				</div>
			</div>  
      </div><!-- /.container-fluid -->
    </section>

  
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Techniques</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.techniques.update',$tech->id) }}" >
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
                   
                    <label for="exampleInputEmail1">Technique</label>
                    <input type="text" value="{{ $tech->name }}" id="tech" name="tech"  class="form-control" id="tech" placeholder="Update Technique name">
                   
                
                </div>
                
				 </div>
				 
<div class="row p-2">
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Class</label>
<select class="form-control" id="class" name="class[]" multiple="multiple" style="height:260px !important;">
@foreach($classes as $class)<option value="{{ $class->id }}" <?php echo(in_array($class->id,$classskill) ? 'selected="selected"' : '');?>>{{ $class->name }}</option>@endforeach
</select>
 </div>
 </div>
 
<div class="col-md-4">
<div class="form-group">
<label for="exampleInputEmail1">Skillarea</label>
<select class="form-control" id="skill" name="skill[]" multiple="multiple" style="height:100px !important;">
@foreach($skills as $skill)<option value="{{ $skill->id }}" <?php echo(in_array($skill->id,$clssklarea) ? 'selected="selected"' : '');?>>{{ $skill->name }}</option>@endforeach
</select>
</div>
</div>

<div class="col-md-4">
<div class="form-group"><label for="exampleInputEmail1">Sports/Skills</label>
<select class="form-control" id="sport" name="sport[]" multiple="multiple" style="height:250px !important;">
@foreach($sports as $sport) 
<option value="{{ $sport->id }}" <?php echo(in_array($sport->id,$clssports) ? 'selected="selected"' : '');?>>{{ $sport->name }}</option>
@endforeach
</select>
</div>
</div>
</div>	
   <!--<div class="input_fields_wrap">
		<button class="btn btn-success add-more" id="add_field_button"><i class="fa fa-plus-circle">Add More Fields</i></button>
		</div>-->
		   <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
		  </form>
          <!-- /.card-body -->
          
     
        <!-- /.card -->

        
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  </div>
  </div>

<script>
	$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $("#add_field_button"); 
   
    var x = 1; 
	
	
   $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
	
		     
$(wrapper).append('<div><div class="row"><div class="col-md-4">'
+'<div class="form-group"><label for="exampleInputEmail1">Class</label><select class="form-control" id="class" name="class[]">'
+'@foreach($classes as $class)<option value="{{ $class->id }}">{{ $class->name }}</option>@endforeach</select> </div></div>'
+'<div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">Skillarea</label>'
+'<select class="form-control" id="skill" name="skill[]">'
+'@foreach($skills as $skill)<option value="{{ $skill->id }}">{{ $skill->name }}</option>@endforeach</select></div></div>'
+'<div class="col-md-4"><div class="form-group"><label for="exampleInputEmail1">Sports/Skills</label>'
+'<select class="form-control" id="sport" name="sport[]" >@foreach($sports as $sport) <option value="{{ $sport->id }}">{{ $sport->name }}</option>'
+'@endforeach</select></div></div>'
+'<a href="#" class="remove_field">Remove</a></div></div>'); 
     x++;  
	  }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ 
       
		e.preventDefault(); 
		$(this).parent('div').remove(); 
		x--;
    })
});
	
	</script>
@endsection