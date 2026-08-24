@extends('layouts.filldart-app')
@section('title', 'Goforfit | ' . $title)
@section('content')


    <style>
        /* Clean Corporate Layout Overrides */
        body {
            background: #f8fafc !important;
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        body .__main {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 100vh !important;
            width: 100% !important;
            padding: 40px 20px !important;
            box-sizing: border-box;
        }

        /* Solid & Refined Form Container */
        .warmup-card {
            width: 100% !important;
            max-width: 580px !important;
            background: #ffffff !important;
            border-radius: 16px !important;
            padding: 40px !important;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06) !important;
            border: 1px solid #e2e8f0 !important;
        }

        .warmup-card h2 {
            color: #0f172a !important;
            font-weight: 700 !important;
            font-size: 24px !important;
            margin-top: 0;
            margin-bottom: 28px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
        }

        .form-group {
            margin-bottom: 24px !important;
        }

        .form-group label {
            display: block !important;
            color: #334155 !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            margin-bottom: 8px !important;
        }

        /* High-quality Input Fields */
        .form-control-custom {
            width: 100% !important;
            padding: 12px 16px !important;
            border-radius: 8px !important;
            border: 1px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            color: #1e293b !important;
            font-size: 15px !important;
            box-sizing: border-box !important;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            outline: none !important;
            border-color: #ff8000 !important;
            box-shadow: 0 0 0 3px rgba(255, 128, 0, 0.12) !important;
        }

        /* Clean Binary Toggle Options (All vs Custom) */
        .toggle-container {
            display: flex !important;
            gap: 12px !important;
            margin-top: 8px !important;
        }

        .toggle-btn {
            background-color: #ffffff !important;
            color: #64748b !important;
            border: 1px solid #cbd5e1 !important;
            padding: 10px 24px !important;
            border-radius: 8px !important;
            cursor: pointer !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            transition: all 0.2s ease;
            flex: 1;
            text-align: center;
        }

        .toggle-btn:hover {
            background-color: #f8fafc !important;
            border-color: #94a3b8 !important;
        }

        .toggle-btn.active {
            background-color: #ff8000 !important;
            color: #ffffff !important;
            border-color: #ff8000 !important;
        }

        /* Dynamic Count Box Wrapper */
        #count-input-box {
            display: none;
            margin-top: 16px;
        }

        .file-upload-box {
            border: 2px dashed #cbd5e1 !important;
            padding: 16px !important;
            border-radius: 8px !important;
            background: #f8fafc !important;
            transition: border-color 0.2s;
        }

        .file-upload-box:hover {
            border-color: #94a3b8 !important;
        }

        .btn-send {
            width: 100% !important;
            background-color: #ff8000 !important;
            color: #ffffff !important;
            border: none !important;
            padding: 14px !important;
            border-radius: 8px !important;
            font-size: 16px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            box-shadow: 0 4px 12px rgba(255, 128, 0, 0.2) !important;
            transition: all 0.2s ease;
        }

        .btn-send:hover {
            background-color: #e67300 !important;
            box-shadow: 0 6px 16px rgba(255, 128, 0, 0.3) !important;
        }

        /* AJAX Response Alerts Layout */
        .alert-msg {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            display: none;
        }

        .alert-success {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .invalid-feedback-custom {
            color: #ef4444 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            margin-top: 6px !important;
            display: none; /* Default state initialization hide logic */
        }

        /* Jab text box invalid hoga tab ka border glow look */
        .border-danger-custom {
            border-color: #ef4444 !important;
            background-color: #fff5f5 !important;
        }

        /* File container wrapper modification box if broken size limits */
        .box-danger-custom {
            border-color: #ef4444 !important;
            background-color: #fff5f5 !important;
        }
    </style>

    <main class="__main">
        <div class="warmup-card">
            <h2>Warmup Email Configuration</h2>

            <!-- Success/Error Message Container for AJAX -->
            <div id="response-alert" class="alert-msg"></div>

            <!-- Form Element Container -->
            <form id="warmup-email-form" enctype="multipart/form-data">
                @csrf

                <!-- 1. User Type Dropdown (Required) -->
                <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select name="user_type" id="user_type" class="form-control-custom" required>
                        <option value="" disabled selected>Select User Type</option>
                        <option value="school">School</option>
                        <option value="trainer">Trainer</option>
                        <option value="parent">Parent</option>
                    </select>
                    <div class="invalid-feedback-custom" id="error-user_type">Please choose a target user category.</div>
                </div>

                <!-- 2. Send To Selection Layout (Required) -->
                <div class="form-group">
                    <label>Send To</label>
                    <!-- Value hidden framework inputs schema map -->
                    <input type="hidden" name="send_to" id="send_to" value="all">

                    <div class="toggle-container">
                        <button type="button" class="toggle-btn active" onclick="handleSendToToggle('all')">All</button>
                        <button type="button" class="toggle-btn" onclick="handleSendToToggle('custom')">Custom</button>
                    </div>

                    <!-- 3. Dynamic Count Input (Nullable/Integer) -->
                    <div id="count-input-box">
                        <label for="count">Target Record Count</label>
                        <input type="number" id="count" name="count" class="form-control-custom"
                            placeholder="Enter target limit count (e.g. 50)">
                    </div>
                </div>

                <!-- 4. Subject Input (Required) -->
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control-custom"
                        placeholder="Enter email subject header" required>
                </div>

                <!-- 5. Message Body Input (Required) -->
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control-custom" rows="5"
                        placeholder="Write your email body message content here..." required></textarea>
                </div>

                <!-- 6. Attachment Document (Nullable - Max 512KB validation rule) -->
                <div class="form-group">
                    <label for="attachment">Attachment (Max 512KB)</label>
                    <div class="file-upload-box">
                        <input type="file" id="attachment" name="attachment" accept=".jpg,.png,.pdf,.doc,.docx">
                    </div>
                </div>

                <!-- Submit Execution Button -->
                <button type="submit" class="btn-send" id="submit-btn">TRANSMIT WARMUP EMAILS</button>
            </form>
        </div>
    </main>

    <!-- AJAX script and Interactive UI behaviors logic -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Handle binary option switches control
        function handleSendToToggle(targetMode) {
            $('#send_to').val(targetMode);

            $('.toggle-btn').removeClass('active');
            event.currentTarget.classList.add('active');

            if (targetMode === 'custom') {
                $('#count-input-box').slideDown(200);
                $('#count').prop('required', true); // Custom selection changes rule to validation mandatory field
            } else {
                $('#count-input-box').slideUp(180);
                $('#count').prop('required', false).val(''); // Reset value field if hidden
            }
        }

        // Core AJAX Execution Handler Architecture
        $(document).ready(function() {
            $('#warmup-email-form').on('submit', function(e) {
                e.preventDefault(); // Default refresh behavior prevention rule

                let alertBox = $('#response-alert');
                let submitBtn = $('#submit-btn');

                // Form initialization with dynamic file stream reading interface array
                let formData = new FormData(this);
                  console.log('FormData initialized:', Object.fromEntries(formData.entries()));
                // UI Loading Status Update
                submitBtn.prop('disabled', true).text('PROCESSING... PLEASE WAIT');
                alertBox.fadeOut().removeClass('alert-success alert-danger').text('');

                $.ajax({
                    url: "{{ route('warmup.email.store') }}", // Naming alignment schema targets
                    type: "POST",
                    data: formData,
                    contentType: false, // Disables custom boundaries generation over streams
                    processData: false, // Prevents elements context mapping configurations string conversions
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_ Ester token"]').val()
                    },
                    success: function(response) {
                        submitBtn.prop('disabled', false).text('TRANSMIT WARMUP EMAILS');

                        if (response.status === 'success') {
                            alertBox.addClass('alert-success').text(response.message).fadeIn();
                            $('#warmup-email-form')[0].reset(); // Form resets completely
                            $('#count-input-box').hide();
                            $('.toggle-btn').removeClass('active').first().addClass('active');
                            $('#send_to').val('all');
                        } else {
                            alertBox.addClass('alert-danger').text(response.message).fadeIn();
                        }
                    },
                    error: function(xhr) {
                        submitBtn.prop('disabled', false).text('TRANSMIT WARMUP EMAILS');
                        let errorMsg = 'Something went wrong. Please check your inputs.';

                        // Validation errors capture framework formatting blocks
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            errorMsg = Object.values(errors).flat().join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMsg = xhr.responseJSON.message;
                        }

                        alertBox.addClass('alert-danger').html(errorMsg).fadeIn();
                    }
                });
            });
        });
    </script>

@endsection
