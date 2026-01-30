<style type="text/css">    
table#students-sports-mapping-table th.dt-orderable-none .dt-column-order { display: none !important; }
.dt-container .top .filter-right { order: 2; margin-right: 8%; margin-top: 5px; }

.dt-button-collection.dropdown-menu {
    left: auto !important;
    right: 4px !important;
    top: 36px !important;
    border-radius: 8px 0px 8px 8px;
    border: 1px solid var(--navi-color);
    box-shadow: 0.05em 0.05em 0.15rem var(--navi-color);
}

.dt-search input[type=search] {
    width: 180px !important;
    border: none;
    font-size: 13px;
}

</style>

<div class="responsive mt-4 pt-2">
    <div class="datatable-wrapper">

    
        <div class="datatable-toolbar d-flex justify-content-between align-items-center mb-3">
            <div id="<?php echo e($id); ?>-filters" class="d-flex align-items-center gap-2"></div>
        </div>

        <table id="<?php echo e($id); ?>" class="table table-bordered tbl-style w-100">
            <thead>
                <tr>
                    <th style="width:40px;"><input type="checkbox" id="<?php echo e($id); ?>-select-all" /></th>
                    <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($header); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
        </table>
    </div>

  
    <?php if(isset($actionsInside)): ?>
        <div data-filter-slot-for="#<?php echo e($id); ?>" style="display:none;">
            <?php echo e($actionsInside); ?>

        </div>
    <?php endif; ?>

</div>


<?php $__env->startPush('scripts'); ?>
<script>
$(function () {
    const tableId = '#<?php echo e($id); ?>';
    const selectAllId = '#<?php echo e($id); ?>-select-all';
    const selectedIds = new Set();
    const enableClassFilter = <?php echo json_encode($enableClassFilter ?? false, 15, 512) ?>;
    const enableOnlyClassFilter = <?php echo json_encode($enableOnlyClassFilter ?? false, 15, 512) ?>;
    const enableSkillNameFilter = <?php echo json_encode($enableSkillNameFilter ?? false, 15, 512) ?>;
    const enableStatusFilter = <?php echo json_encode($enableStatusFilter ?? false, 15, 512) ?>;
    const enableClassSectionFilter = <?php echo json_encode($enableClassSectionFilter ?? false, 15, 512) ?>;
    const enableSchoolTermsFilter = <?php echo json_encode($enableSchoolTermsFilter ?? false, 15, 512) ?>;

    const enableLengthMenu = <?php echo json_encode($enableLengthMenu ?? true, 15, 512) ?>;
    const pageLength = <?php echo json_encode($pageLength ?? 100, 15, 512) ?>;

    const selectedClass = <?php echo json_encode($selectedClass ?? null, 15, 512) ?>; 
    const selectedOnlyClass = <?php echo json_encode($selectedOnlyClass ?? null, 15, 512) ?>; 
    const selectedSkillName = <?php echo json_encode($selectedSkillName ?? null, 15, 512) ?>; 
    const selectedSection = <?php echo json_encode($selectedSection ?? null, 15, 512) ?>;
    const selectedStatus = <?php echo json_encode($selectedStatus ?? null, 15, 512) ?>;
    const buttonsConfig = [];

    <?php $__currentLoopData = $exportButtons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $btn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if(isset($btn['type']) && $btn['type'] !== 'custom'): ?>
            buttonsConfig.push({
                extend: '<?php echo e($btn['type']); ?>',
                text: '<?php echo e($btn['text']); ?>',
                exportOptions: {
                    columns: function (idx) {
                        return idx !== 0;
                    }
                }
            });
        <?php elseif(isset($btn['type']) && $btn['type'] === 'custom'): ?>
            buttonsConfig.push({
                text: '<?php echo e($btn['text']); ?>',
                action: function (e, dt, node, config) {
                    if (typeof window['<?php echo e($btn['action'] ?? ''); ?>'] === 'function') {
                        window['<?php echo e($btn['action']); ?>'](e, dt, node, config, Array.from(selectedIds));
                    } else {
                        console.warn('Custom action not found: <?php echo e($btn['action'] ?? ''); ?>');
                    }
                }
            });
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    const columnsConfig = [
        {
            data: 'id', orderable: false, searchable: false,
            render: function (data, type, row) {
                const checked = selectedIds.has(data) ? 'checked' : '';
                const isDisabled = ['requested', 'processing'].includes(row.report_status) || ['Incomplete'].includes(row.test_status);
                const disabled = isDisabled ? 'disabled' : '';
                return `<input type="checkbox" class="row-checkbox" id="${row.test_status}" value="${data}" ${checked} ${disabled}/>`;
            }
        },

        ...<?php echo json_encode($columns); ?>

    ];

    const buttonsConfigFinal = buttonsConfig.length > 0 ? [{
        extend: 'collection',
        text: 'Export', 
        className: 'exportButton',
        buttons: buttonsConfig
    }] : [];


    const domConfig = enableLengthMenu 
        ? `<"top"lf><"filter-right"B>rt<"bottom"ip><"clear">`  // With length menu ('l')
        : `<"top"f><"filter-right"B>rt<"bottom"ip><"clear">`;


    const table = $(tableId).DataTable({
        dom: domConfig,
        lengthChange: enableLengthMenu,
        lengthMenu: enableLengthMenu ? [ // CONDITIONAL LENGTH MENU OPTIONS
            [20, 40, 60, 80, 100, -1],
            [20, 40, 60, 80, 100, 'All']
        ] : false,
        pageLength: pageLength,
        info: true,
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e($ajaxUrl); ?>",
            data: function (d) {
                d.selectedOnlyClass = $('#filter-only-class').val();
                $('[id^="filter-"]').each(function () {
                    const name = $(this).attr('id').replace('filter-', '');
                    d[name] = $(this).val();

                    selectedIds.clear();
                    $(selectAllId).prop('checked', false);
                    const visibleRows = table.rows({ page: 'current', search: 'applied' }).nodes();
                    $('.row-checkbox', visibleRows).prop('checked', false);
                    
                });

            },

            beforeSend: function () {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading...',
                    text: 'Fetching data, please wait',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });
            },

            complete: function () {
                Swal.close();
            },
            
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to load data.',
                    confirmButtonColor: '#3085d6'
                });
            }
        },
        columns: columnsConfig,
        buttons: buttonsConfigFinal,
        language: {
            searchPlaceholder: "<?php echo e($searchPlaceholder); ?>",
            search: ""
        },

        initComplete: function () {

            $('#<?php echo e($id); ?>_filter input').attr('placeholder', "<?php echo e($searchPlaceholder); ?>");

            if(enableSchoolTermsFilter){


                const TermList = <?php echo json_encode($schoolTerms ?? [], 15, 512) ?>;      
                const $dropdown = $('<select class="form-select form-select-sm ms-2" id="filter-school-terms" style="font-size: 13px;color: #2c2d78;"></select>');               

                TermList.forEach(option => {
                    const displayText = option.term_name;
                    const value = option.term_id;
        
                    const isSelected = (value == currentTermId); 
                    $dropdown.append(new Option(displayText, value, false, isSelected));
                });

                const $schoolTermFilter = $('<div class="pull-right"></div>').append($dropdown);
                $schoolTermFilter.appendTo(`${tableId}_wrapper .top`).next('.dt-length').addClass("pull-right");

                if (selectedClass) {
                    setTimeout(() => {
                        $dropdown.trigger('change');
                        // console.log('Triggered filter for pre-selected class:', selectedClass);
                    }, 100);
                } 

            }

            if (enableClassFilter) {
                const classList = <?php echo json_encode($classes ?? [], 15, 512) ?>;
                const $dropdown = $('<select class="form-select form-select-sm ms-2" id="filter-class-section" style="font-size: 13px;color: #2c2d78;"></select>');               
                $dropdown.append(new Option('All Classes', ''));

                classList.forEach(option => {
                    const section = option.section ? ` - ${option.section}` : '';
                    const displayText = option.name + section ;
                    const value = option.class_id + '-' + option.section;
                    const isSelected = (selectedClass == option.class_id && selectedSection == option.section);

                    $dropdown.append(new Option(displayText, value, false, isSelected));
                });

                const $classFilterContainer = $('<div class="pull-right"></div>').append($dropdown);
                $classFilterContainer.appendTo(`${tableId}_wrapper .top`).next('.dt-length').addClass("pull-right");

                if (selectedClass) {
                    setTimeout(() => {
                        $dropdown.trigger('change');
                        // console.log('Triggered filter for pre-selected class:', selectedClass);
                    }, 100);
                }        
            }

            if (enableClassSectionFilter) {

                const classList = <?php echo json_encode($classes ?? [], 15, 512) ?>;
                const $classDropdown = $('<select class="form-select form-select-sm ms-2" id="filter-class" style="font-size: 13px;color: #2c2d78;"></select>'); 
                const $sectionDropdown = $('<select class="form-select form-select-sm ms-2" id="filter-section" style="font-size: 13px;color: #2c2d78;"></select>'); 
                
                $sectionDropdown.append(new Option('All Section', ''));
                $classDropdown.append(new Option('All Classes', ''));

                const uniqueClasses = [...new Map(classList.map(item => [item.class_id, item])).values()];
                uniqueClasses.forEach(cls => {
                    const isSelected = (selectedClass == cls.class_id);
                    $classDropdown.append(new Option(cls.name, cls.class_id, false, isSelected));
                });

                function updateSections(selectedClassId) {

                    $sectionDropdown.empty().append(new Option('All Sections', ''));
                    if (!selectedClassId) return;

                    const sections = [
                        ...new Set(
                            classList
                                .filter(item => item.class_id == selectedClassId)
                                .map(item => item.section)
                                .filter(Boolean)
                        )
                    ];

                    sections.forEach(section => {
                        const isSelected = (selectedSection == section);
                        $sectionDropdown.append(new Option(section, section, false, isSelected));
                    });
                }

                $classDropdown.on('change', function () {
                    const selectedClassId = $(this).val();
                    updateSections(selectedClassId);
                });

                if (selectedClass) {
                    updateSections(selectedClass);
                    setTimeout(() => {
                        $classDropdown.trigger('change');
                    }, 100);
                }

                const $classFilterContainer = $('<div class="pull-right"></div>').append($classDropdown);
                const $sectionFilterContainer = $('<div class="pull-right"></div>').append($sectionDropdown);
                $classFilterContainer.appendTo(`${tableId}_wrapper .top`);
                $sectionFilterContainer.appendTo(`${tableId}_wrapper .top`);
            }


            if(enableStatusFilter) {

                const testStatus = <?php echo json_encode($statuses ?? [], 15, 512) ?>;
                const $statusDropDown = $('<select class="form-control form-select-sm ms-2"" id="filter-status" style="font-size: 13px;color: #2c2d78;"></select>');
                testStatus.forEach(option => {  
                    const isSelected = option.value === selectedStatus;                
                    $statusDropDown.append(new Option(option.label, option.value, false, isSelected));
                });

                const $filterContainer = $('<div class="pull-right"></div>').append($statusDropDown);
                $filterContainer.appendTo(`${tableId}_wrapper .top`).next('.dt-length').addClass("pull-right");
                if ($('#upload_test_data_wrapper').length) {
                    const $wrapper = $('#upload_test_data_wrapper .top');
                    const $statusDiv = $wrapper.find('#filter-status').parent();
                    const $skillDiv = $wrapper.find('#filter-skill').parent();

                    $statusDiv.insertBefore($skillDiv);
                }
                $('[id^="filter-"]').on('change', function () {
                    table.ajax.reload();
                });
            }
        }

    });

    
    // FIXED: Select All checkbox handler
    $(selectAllId).on('change', function () {
        const checked = this.checked;
        const visibleRows = table.rows({ search: 'applied' }).nodes();
        
        $('.row-checkbox', visibleRows).each(function () {

            if ($(this).is(':disabled')) return;

            this.checked = checked;
            const id = $(this).val();
            if (checked) {
                selectedIds.add(id);
            } else {
                selectedIds.delete(id);
            }
        });
    });


    // FIXED: Individual row checkbox handler
    $(tableId).on('change', '.row-checkbox', function () {
        const id = $(this).val();
        if (this.checked) {
            selectedIds.add(id);
        } else {
            selectedIds.delete(id);
            // Uncheck select-all when any checkbox is unchecked
            $(selectAllId).prop('checked', false);
        }

        // Update select-all checkbox state
        const visibleRows = table.rows({ search: 'applied' }).nodes();
        const visibleCheckboxes = $('.row-checkbox', visibleRows);
        const allChecked = visibleCheckboxes.length > 0 && 
                          visibleCheckboxes.length === visibleCheckboxes.filter(':checked').length;
        
        $(selectAllId).prop('checked', allChecked);
    });

    // FIXED: Draw event handler - reset select-all on page change
    table.on('draw', function () {
        // Update checkboxes for current page
        const visibleRows = table.rows({ page: 'current', search: 'applied' }).nodes();
        
        $('.row-checkbox', visibleRows).each(function () {
            const id = $(this).val();
            $(this).prop('checked', selectedIds.has(id));
        });

        const currentPageRows = table.rows({ page: 'current', search: 'applied' }).nodes();
        const currentPageCheckboxes = $('.row-checkbox', currentPageRows);
        const allCurrentPageChecked = currentPageCheckboxes.length > 0 && currentPageCheckboxes.length === currentPageCheckboxes.filter(':checked').length;        
        $(selectAllId).prop('checked', allCurrentPageChecked);
    });

     // NEW: Handle page length change - clear select-all checkbox
    table.on('length.dt', function (e, settings, len) {
        selectedIds.clear();
        $(selectAllId).prop('checked', false);
        const visibleRows = table.rows({ page: 'current', search: 'applied' }).nodes();
        $('.row-checkbox', visibleRows).prop('checked', false);

    });


    table.on('processing.dt', function (e, settings, processing) {
        if (processing) {
            Swal.fire({
                title: 'Loading...',
                text: 'Processing your request...',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });
        } else {
            Swal.close();
        }
    });

});
</script>
<?php $__env->stopPush(); ?>

<?php /**PATH C:\xampp\htdocs\nep\resources\views/components/listing-data.blade.php ENDPATH**/ ?>