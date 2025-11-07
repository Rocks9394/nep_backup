@extends('admin.layouts.app')
@section('title', 'Class-Technique - Goforfit')

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
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add Class-Technique</h3>

            
          </div>
          <!-- /.card-header -->
		  <form method="POST" action="{{ route('admin.storeclstech')}}" >
          <div class="card-body">
		   
			  @csrf
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
				<div class="col-md-12">
                <div class="form-group">
                  
				  <label for="exampleInputEmail1">Techniques</label>
                     <select class="form-control" id="tech" name="tech" >
					
                      @foreach($techs as $tech)
                      
                     
                      <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                      
                      
                      @endforeach
        
                    </select>
				  
				  
                </div>
               
              </div>
            
           
          </div>
		   <div class="input_fields_wrap">
		<button class="btn btn-success add-more" id="add_field_button"><i class="fa fa-plus-circle">Add More Fields</i></button>
		</div>
		   <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
		  </form>
          <!-- /.card-body -->
          
        </div>
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