@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')
<div class="pg-yallow-color">
    <div class="container">
        <div class="navbar-expand-lg">
            <div id="fillter" class="" role="group" aria-label="Basic example">
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="all-chaptr-cards">
        <div class="row">
            <div class="col">
                <div class="heading-rw mb-2">
                    <h1>{{$title}}</h1>
                </div>
            </div>
        </div>


         <?php /*   <div class="row">
                <div class="col-12">

                    <div id="activity_from_div" class="row sports-filtr overlay">

                                <?php

                                $sclasses = '<option value="">Class</option>';

                                if (!empty($classes)) 
                                {
                                    foreach ($classes as $cls) 
                                    {

                                        $sclasses .= '<option value="' . $cls->id . '" ';
                                        if (!empty($_GET['sclass']))
                                        {
                                            if ($cls->id == $_GET['sclass']) 
                                            {
                                                $sclasses .= ' selected';
                                                $sclsname = $cls->name;
                                            }
                                        }

                                        $sclasses .= ' >' . $cls->name . '</option>';

                                    }
                                }

                                ?>


                            <div class="form-group"></div>
                            <div class="row">

                                <div class="col-12 col-md-12 mb-3">
                                 <label for="School Name">School Name</label><br>
                                    <select class="form-control mx-0 w-100" name="view_school_id" id="view_school_id" onchange="getclasses(0,this.value)">
                                    <option value="">School Name</option>
                                
                                    @foreach ($schools as $skey => $sval)
                                        <option value="{{ $sval->id  }}"> {{ $sval->school_name  }}</option>
                                    @endforeach
                                    </select>

                                </div>

                            </div>
                    </div>
                    
                </div>

            </div> */ ?>

            <div class="row">

                    <div class="col-12 col-md-12 mb-3">

                        <table class="table table-striped" id="view_student_dart_id">
                            <thead>
                                <tr>
                                <!-- <th scope="col" width="30"></th> -->
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">Trainer</th>
                                <th scope="col">Date</th>
                                <th scope="col">Class</th>
                                <th scope="col">Period</th>
                                <th scope="col">Lesson Name</th>
                                </tr>
                            </thead>
                        <tbody id="classwise_data_id">
                            @foreach($results as $key => $val)
                            <tr>
                                <!-- <td scope="col">{{ $key+1 }}</td> -->
                                <td scope="col">{{ $name }}</td>
                                <td scope="col">{{ $val->date }}</td>
                                <td scope="col">{{ $val->classname.'-'.$val->section }}</td>
                                <td scope="col">{{ $val->period }}</td>
                                <td scope="col">{{ $val->title }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                        </table>

                        @if(empty($count))
                            <div class="d-flex justify-content-center no-record"> No record found </div>
                        @endif

                        <div class="d-flex justify-content-center">
                        {{ $results->appends(request()->query())->links() }}
                        </div>
                    

                    </div>
            </div>     


<!-- 
            <tr><th><input type="checkbox" name="" value=""></th><th scope="row">1</th><td>@mdo</td><td><button type="button" class="btn btn-primary">View</button><button type="button" class="btn btn-primary">Download</button></td></tr> -->





    </div>

</div>
</div>



@endsection