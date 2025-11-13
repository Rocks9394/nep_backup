
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startPush('style-css'); ?>



<style>

    .dropdown.show [aria-expanded="true"] {
  background:#fff;
}
.dropdown .form-control {
    height: 32px !important;
    border-radius: 4px;
    padding: 0 25px 0 10px;
}
.dropdown .form-control.dropdown-toggle::after {
        right: 10px;
    }
    .dt-container{
        color: #000!important;
    }


</style>
<?php $__env->stopPush(); ?>


<div class="container-fluid">
    <div class="t-mrg2 mb-5 pb-5 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="heading-rw mt-0 mt-md-1 mb-0 p-0">
                        <a href="#a" onclick="history.back()" class="back-button" style="left: 0px;">
                            <span class="arrow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                                </svg>
                            </span>
                        </a>
                    
                        <h1 class="ml-md-4 mb-0"><?php echo e($title); ?></h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="responsive mb-5 mt-3 pb-4">
                        <div class="tab-content cus-radius pb-5 mt-4">
                            <!-- Infrastructure List Tab -->                
                                <table id="LowerClassFitnessStatus" class="table table-striped table-bordered dt-responsive1" style="width:100%">
                                    <thead>             
                                        <tr>
                                        
                                            <th scope="col" >Class</th>
                                            <th scope="col" >Roll No.</th>
                                            <th scope="col" >Students Name</th>

                                            <th scope="col" >Running</th>
                                            <th scope="col" >Hopping</th>
                                            <th scope="col" >Jumping & Landing</th>
                                            <th scope="col" >Skipping</th>
                                            <th scope="col" >Dodging</th>

                                            <th scope="col" >One-Foot Balance</th>
                                            <th scope="col" >Beam Walk</th>

                                            <th scope="col" >Catching & Receiving Bounce Ball</th>
                                            <th scope="col" >Catching Small Ball With Two Hands</th>
                                            <th scope="col" >Under Arm Throw</th>
                                            <th scope="col" >Over Arm Throw</th>
                                            <th scope="col" >Striking drop & hit forward</th>
                                            <th scope="col" >Dribbling With Hands</th>
                                            <th scope="col" >Dribbling With Feet</th>
                                            <th scope="col" >Kicking Stationary Ball</th>

                                            <th scope="col" >Flamingo Balance Test</th>
                                            <th scope="col" >Plate Tapping</th>

                                            <th scope="col" >Body Mass Index</th>
                                            <th scope="col" >Height</th>
                                            <th scope="col" >Weight</th>
                                            <th scope="col" >Report</th>

                                        </tr>
                                    </thead>
                                    <tbody> </tbody>
                                </table>                
                        </div>
                    </div>
                </div>
            </div>



    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('page-script'); ?>

<!-- Keep only these DataTables scripts (remove all others) -->
<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script> -->


<!-- Buttons and Export -->
<!-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

<!-- Optional: If you need Select functionality -->
<!-- <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script> -->


<script>

$(document).ready(function() {

    if (!$.fn.dataTable.Responsive) {
        console.error('DataTables Responsive extension not loaded!');
        var responsiveConfig = { responsive: true };
    } else {
        var responsiveConfig = {
            responsive: {
                details: { type: 'column', target: -1 }
            }
        };
    }

    var table = $('#LowerClassFitnessStatus').DataTable({
        info: true,
        processing: true,
        serverSide: true,
        searchable: true,
        //pageLength: 100,
        // lengthMenu: [[100, 200, 300, -1], [100, 200, 300 , "All"]],
        // dom: '<"top d-flex justify-content-between align-items-center"fB>rt<"bottom d-flex justify-content-between"i><"clear">',        
        dom: '<"top"f><"filter-right"B>rt<"bottom"i><"clear">',        
        ajax: {
            url: '<?php echo e($ajaxUrl); ?>',
            type: 'GET',
            data: function(d) {
                d.class = $('#filter_class').val();
                d.status = $('#filter_status').val();            
                d.test = $('.filter_test:checked').map(function () {
                    return $(this).val();
                }).get();

            },

            beforeSend: function() {
                Swal.fire({
                    icon:'info',
                    title: 'Loading...',
                    text: 'Please wait while we fetch the data',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            complete: function() {
                Swal.close();
            }         
        },

        columns: [
            { data: 'class_name', name : 'class_name'},
            { data: 'rollno', name: 'rollno' },
            { data: 'student_name', name: 'student_name' },
            { data: 'running', name: 'running' },
            { data: 'hopping', name: 'hopping' },
            { data: 'jumping_landing', name: 'jumping_landing' },
            { data: 'skipping', name: 'skipping' },
            { data: 'dodging', name: 'dodging' },
            { data: 'one_foot_balance', name: 'one_foot_balance' },
            { data: 'beam_walk', name: 'beam_walk' },
            { data: 'catching_receiving_bounce', name: 'catching_receiving_bounce' },
            { data: 'catching_small_ball', name: 'catching_small_ball' },
            { data: 'under_arm_throw', name: 'under_arm_throw' },
            { data: 'over_arm_throw', name: 'over_arm_throw' },
            { data: 'striking_drop_hit', name: 'striking_drop_hit' },
            { data: 'dribbling_hands', name: 'dribbling_hands' },
            { data: 'dribbling_feet', name: 'dribbling_feet' },
            { data: 'kicking_ball', name: 'kicking_ball' },
            { data: 'flamingo_balance', name: 'flamingo_balance' },
            { data: 'plate_tapping', name: 'plate_tapping' },
            { data: 'bmi', name: 'bmi' },
            { data: 'height', name: 'height' },
            { data: 'weight', name: 'weight' },
            { data: 'view_link', name: 'view_link',  orderable: false,  searchable: false, className: 'noExport',
                render: function(data, type, row) {
                    return `<a href="${data}" class="btn-link" target="_blank">View</a>`;
                }
            }
        ],
        buttons: [{
            extend: 'collection',
            text: 'Export',
            className: 'exportButton itm-list',
            buttons: [
                {
                    extend: 'excel',
                    title: 'Fitness Test Status',
                    exportOptions: {
                        columns: ':visible:not(.noExport)'
                    },

                    filename: function () {
                       return getTimestamp();
                    },
                },
            ],
        }],
        order: [[0, 'asc']],

        initComplete: function () {

            $('.dt-search input[type="search"]').attr('placeholder', 'Search here...');


            /* Class Drop-Down List */
            var classList = <?php echo json_encode($classList, 15, 512) ?>;
            const $dropdown = $('<select class="form-control" id="filter_class"></select>');
            classList.forEach(option => {
                const section = option.section ? ` - ${option.section}` : '';
                const displayText = option.name + section ;
                const value = option.class_id + '-' + option.section;
                $dropdown.append(new Option(displayText, value));
            });

            $('<div class="pull-right"></div>').append($dropdown).appendTo("#LowerClassFitnessStatus_wrapper .top").next('.dt-length').addClass("pull-right");
            $dropdown.on('change', function() {
               table.ajax.reload();
            });


            /* Status Drop-Down List */
            var status = [
                { name: 'All', status: '',},
                { name: 'Complete', status: 'complete', },
                { name: 'Incomplete', status: 'incomplete', },
            ];
            const $dropdown1 = $('<select class="form-control" id="filter_status"></select>');
            status.forEach(option => {
                const section = option.status ? ` - ${option.status}` : '';
                const displayText = option.name;
                const value = option.status;
                $dropdown1.append(new Option(displayText, value));
            });

            $('<div class="pull-right"></div>').append($dropdown1).appendTo("#LowerClassFitnessStatus_wrapper .top").next('.dt-length').addClass("pull-right");
            $dropdown1.on('change', function() {
                updateTestCount();
               table.ajax.reload();
            });



            /* TestType Drop-Down List */
            var testType = [
                // { name: 'All Tests', test: 'all' },
                { name: 'Running', test: 'running' },
                { name: 'Hopping', test: 'hopping' },
                { name: 'Jumping & Landing', test: 'jumping_landing' },
                { name: 'Skipping', test: 'skipping' },
                { name: 'One-Foot Balance', test: 'one_foot_balance' },
                { name: 'Dodging', test: 'dodging' },
                { name: 'Beam Walk', test: 'beam_walk' },
                { name: 'Catching & Receiving Bounce Ball', test: 'catching_receiving_bounce' },
                { name: 'Catching Small Ball With Two Hands', test: 'catching_small_ball' },
                { name: 'Under Arm Throw', test: 'under_arm_throw' },
                { name: 'Over Arm Throw', test: 'over_arm_throw' },
                { name: 'Striking drop & hit forward', test: 'striking_drop_hit' },
                { name: 'Dribbling With Hands', test: 'dribbling_hands' },
                { name: 'Dribbling With Feet', test: 'dribbling_feet' },
                { name: 'Kicking Stationary Ball', test: 'kicking_ball' },
                { name: 'Flamingo Balance Test', test: 'flamingo_balance' },
                { name: 'Plate Tapping', test: 'plate_tapping' },                
                { name: 'Body Mass Index', test: 'bmi' }
            ];
        
            let $dropdown2 = $(`
                <div class="dropdown" style="display:inline-block;">
                    <button class="form-control dropdown-toggle" type="button" data-toggle="dropdown" id="test_count_label">
                        All Tests <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="padding:30px; max-height:300px; overflow:auto; min-width:250px;">
                    </ul>
                </div>
            `);

            let $list = $dropdown2.find(".dropdown-menu");
            let $selectAll = $(`
                <li>
                    <label style="font-weight:bold; cursor:pointer;">
                        <input type="checkbox" id="select_all_tests" > Select All
                    </label>
                    <hr style="margin:5px 0;">
                </li>
            `);
            $list.append($selectAll);


            testType.forEach(option => {
                let $chk = $(`
                    <li>
                        <label style="white-space:nowrap; cursor:pointer;">
                            <input type="checkbox" class="filter_test" value="${option.test}" checked> ${option.name}
                        </label>
                    </li>
                `);
                $list.append($chk);
            });


            $('<div class="pull-right"></div>').append($dropdown2).appendTo("#LowerClassFitnessStatus_wrapper .top").next('.dt-length') .addClass("pull-right");

            $dropdown2.find(".filter_test").prop("checked", true);
            $("#select_all_tests").prop("checked", true);
            updateTestCount();

            
            function updateTestCount() {
                let selectedCount = $('.filter_test:checked').length;


                if (selectedCount === testType.length) {
                    $("#test_count_label").text("All Tests Selected");
                    $("#select_all_tests").prop("checked", true);
                } else if (selectedCount === 0) {
                    $("#test_count_label").text("0 Tests Selected");
                    $("#select_all_tests").prop("checked", false);
                } else {
                    $("#test_count_label").text(selectedCount + " Tests Selected");
                    $("#select_all_tests").prop("checked", false);
                }
            }

            // Select All toggle
            $(document).on("change", "#select_all_tests", function() {
                $(".filter_test").prop("checked", $(this).is(":checked")).trigger("change");
                updateTestCount();
            });

            // Individual checkbox toggle
            $(document).on("change", ".filter_test", function() {
                updateTestCount();
                table.ajax.reload();
            });



            /* Handle TestType Columns Dynamically */
            $(document).on("change", ".filter_test", function() {
                // Hide all columns first
                var testColumns = ['running','hopping','jumping_landing','one_foot_balance','skipping','dodging','beam_walk','catching_receiving_bounce','catching_small_ball','under_arm_throw','over_arm_throw','striking_drop_hit','dribbling_hands','dribbling_feet','kicking_ball','flamingo_balance','plate_tapping','bmi','height','weight'];

                testColumns.forEach(test => {
                    let colIndex = table.column(test + ':name').index();
                    if (colIndex !== undefined) {
                        table.column(colIndex).visible(false);
                    }
                });

                let selectedTests = $('.filter_test:checked').map(function(){ return $(this).val(); }).get();
                if (selectedTests.length === 0) {
                    testColumns.forEach(test => {
                        let colIndex = table.column(test + ':name').index();
                        if (colIndex !== undefined) table.column(colIndex).visible(true);
                    });
                } else {

                    selectedTests.forEach(test => {
                        let colIndex = table.column(test + ':name').index();
                        if (colIndex !== undefined) table.column(colIndex).visible(true);
                    });


                    if (selectedTests.includes('bmi')) {
                        ['height', 'weight'].forEach(test => {
                            let colIndex = table.column(test + ':name').index();
                            if (colIndex !== undefined) table.column(colIndex).visible(true);
                        });
                    }
                }

                table.ajax.reload();
            });
        },

        // language: {
        //     paginate: {
        //         first: "«",
        //         previous: "‹",
        //         next: "›",
        //         last: "»"
        //     },
        // }
    });


    function getTimestamp() {
        const now = new Date();
        return `Fitness Test Status ${now.getDate()}-${now.getMonth()+1}-${now.getFullYear()}`;
    }

 });

</script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.filldart-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nep\resources\views/reports/TestStatusLowerClass.blade.php ENDPATH**/ ?>