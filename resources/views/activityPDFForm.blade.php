@extends('layouts.app')
@section('title', 'Goforfit')
@section('content')


<nav aria-label="breadcrumb">
<div class="container">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#a">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
          </ol>
</div>
        </nav>
<section class="pg-sec all-chaptr-cards">
        <div class="container">
        <div class="row">
            <div class="col">
                <div class="heading-rw">
                    <h1>Generate Activities PDF</h1>
                </div>
            </div>
        </div>
		
		<div class="row">
            <div class="col">
                <form action="{{ route('generateactivitypdf'); }}" method="POST">
				@csrf
					<div class="mb-3">
					  <label for="exampleFormControlTextarea1" class="form-label">Example textarea </label>
					  <textarea class="form-control" name="activities" rows="3"></textarea>
					</div>
					
					<div class="mb-3">
					 Note : Add activity ID with comma seperated, No space, no anyother special charater
					</div>
					<div class="col-sm-10">
						<input type="submit" class="btn btn-primary" value="Generate PDF">
					</div>
				</form>
            </div>
        </div>
       
	</div>
     
        
</section>

@endsection