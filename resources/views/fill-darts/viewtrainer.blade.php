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

<div class="">
    <div class="all-chaptr-cards">

        <!-- Success message -->
        <form class="container" method="POST" name="view-trainer-report" id="" action="">
            <div class="row">
                <div class="col">
                    <div class="heading-rw mb-4">
                        <h1>View Trainer</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div id="activity_from_div" class="sports-filtr overlay">
                            <div class="form-row">
                                <div class="form-group col-12 col-sm-6 col-md-3 mb-3">
                                 <label for="Class">By Trainer</label><br>
                                    <select class="form-control mx-0 w-100" name="trainer_id" id="trainer_id" >
                                        <option value="">---Select---</option>
                                    </select>
                                </div>
                              

                                <div class="form-group col-12 col-sm-6 col-md-3 mb-3">
                                      <label for="Period">By Class</label><br>
                                        <select class="form-control mx-0 w-100" name="custom_class_id" id="custom_class_id">
                                                    <option value="">Class</option>
                                                   
                                        </select>

                                </div>

                            
                                <div class="form-group col-12 col-sm-6 col-md-2 mb-3">
                                    <label for="skillarea">From Date</label><br>
                                    <input type="date" class="form-control mx-0 w-100" value="" required id="from_date_id" name="from_date">
                                </div>

                                <div class="form-group col-12 col-sm-6 col-md-2 mb-3">
                                     <label for="sports">To Date</label><br>
                                    <input type="date" class="form-control selctopt" value="" required id="to_date_id" name="to_date">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-2 mt-4 pt-0">
                                    <button type="submit" name="filldata" id="activity_fillter" value="filldatasubmit"
                                    class="btn btn-primary d-block w-100 mt-1 "><i class="fa fa-filter" aria-hidden="true"></i> View Report
                                    </button>

                                
                                    <a  class="btn btn-primary mt-1" href="">Reset</a>
                                   
                                </div>
                            </div>
                    </div>
                    
                </div>

            </div>

            <!---->

       </form>

    </div>

</div>
</div>


@endsection