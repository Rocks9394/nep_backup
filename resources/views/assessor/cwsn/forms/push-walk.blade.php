@extends('assessor.cwsn.index')

@section('cwsnform')

<!-- Parameter Selector: Mobility Category Toggle -->
<div class="card shadow-sm mb-4 border-0">
    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">
        <label class="form-label font-weight-bold text-uppercase text-muted tracking-wide mb-2" style="font-size: 0.8rem;">Student Mobility Mode</label>
        
        <style>
            .theme-btn-group .btn-outline-theme {
                color: #4da3ff;
                border-color: #4da3ff;
            }
            .theme-btn-group .btn-outline-theme:hover, 
            .theme-btn-group .btn-outline-theme.active {
                color: #fff !important;
                background-color: #4da3ff !important;
                border-color: #4da3ff !important;
            }
        </style>

        <div class="btn-group btn-group-toggle theme-btn-group d-inline-flex" data-toggle="buttons" style="max-width: 360px; width: 100%;">
            <label class="btn btn-outline-theme font-weight-bold px-4 py-2 active">
                <input type="radio" name="mobility_selector" value="ambulatory" autocomplete="off" checked> Ambulatory (Walker)
            </label>
            <label class="btn btn-outline-theme font-weight-bold px-4 py-2">
                <input type="radio" name="mobility_selector" value="wheelchair" autocomplete="off"> Wheelchair User
            </label>
        </div>
    </div>
</div>

<!-- Dual Numeric Input Matrix -->
<div class="row mx-n2 mb-4">
    <!-- TIME INPUT -->
    <div class="col-6 px-2">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center p-3">
                <label class="form-label font-weight-bold text-uppercase text-muted mb-2" style="font-size: 0.75rem;">Time Taken</label>
                <div class="input-group">
                    <input type="number" 
                           id="ui_time_input" 
                           class="form-control form-control-lg text-center font-weight-bold border-2" 
                           placeholder="0.0" 
                           step="0.1" 
                           inputmode="decimal"
                           style="border-radius: 8px; font-size: 1.5rem; height: 60px;">
                    <div class="input-group-append">
                        <span class="input-group-text font-weight-bold text-muted bg-white border-left-0" style="border-radius: 0 8px 8px 0;">sec</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HEART RATE INPUT -->
    <div class="col-6 px-2">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center p-3">
                <label class="form-label font-weight-bold text-uppercase text-muted mb-2" style="font-size: 0.75rem;">Heart Rate</label>
                <div class="input-group">
                    <input type="number" 
                           id="ui_heart_rate_input" 
                           class="form-control form-control-lg text-center font-weight-bold border-2" 
                           placeholder="0" 
                           inputmode="numeric"
                           style="border-radius: 8px; font-size: 1.5rem; height: 60px;">
                    <div class="input-group-append">
                        <span class="input-group-text font-weight-bold text-muted bg-white border-left-0" style="border-radius: 0 8px 8px 0;">BPM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs to drop into your main <form id="save_bmi_record_id"> context -->
<input type="hidden" name="mobility_mode" id="mobility_mode" value="ambulatory">
<input type="hidden" name="score_time" id="score_time" value="">
<input type="hidden" name="score_heart_rate" id="score_heart_rate" value="">


@endsection
