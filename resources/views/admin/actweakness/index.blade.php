@extends('admin.layouts.app')
@section('title', 'Goforfit Activity Weakness')
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
            <h1>Activity Weakness</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active"aria-current="page">Activity Weakness</li>
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
         <a href="{{ route('admin.actweakness.create') }}"> <input type="submit" value="Create Activity Weakness" class="btn btn-sm btn-success float-left"> </a>
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
                    <th scope="col">Activity</th>
                    <th scope="col">Class</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Chapter</th>
                    <th scope="col">Concept</th>
                    <th scope="col">Weakness</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th></th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($actwekness as $act)  
                  <tr>
                   <th scope="row">{{++$i}}</th>                    
                   <td style="width:200px;">
                @foreach($activity as $actv)
                @if($actv->id == $act->activity_id )
                {{ $actv->title }}
                @endif
               @endforeach
             </td>  
              <td style="width:200px;">
                @foreach($classes as $cl)
                @if($cl->id == $act->class_id )
                {{ $cl->name }}
                @endif
               @endforeach
             </td>     
             <td style="width:200px;">
                @foreach($subjects as $sub)
                @if($sub->id == $act->subject_id )
                {{ $cl->name }}
                @endif
               @endforeach
             </td>             
             <td style="width:200px;">
                @foreach($chapters as $chp)
                @if($chp->id == $act->chapter_id )
                {{ $chp->name }}
                @endif
               @endforeach
             </td>             
             <td style="width:200px;">
                @foreach($concepts as $conc)
                @if($conc->id == $act->concept_id )
                {{ $conc->name }}
                @endif
               @endforeach
             </td>                  
             <td style="width:200px;">{{ $act->weakness_type }}</td>                
             <td><?=(!empty($act->status)&& $act->status==1 ? 'Active' : 'In Active');?></td>
             <td class="form-check form-check-radio form-check-inline">            
              <a style="display: inline !important;" class="btn btn-info btn-sm" href="{{ route('admin.actweakness.edit',$act->id) }}"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
              <form action="{{ route('admin.actweakness.destroy',$act->id) }}" method="POST">
                @csrf
                @method('DELETE')
               <button  style="display: inline !important;"class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash" aria-hidden="true" onclick="return confirm('Do you want to delete ?')"></i></button>
               </form>
             </td> 
             <td></td>   
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