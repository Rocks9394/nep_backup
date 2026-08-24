<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warmupemail;
use Illuminate\Support\Facades\Validator;
class WarmupEmailController extends Controller
{
    public function store(Request $request)
    {
        // 1. Data validation
        $validator = Validator::make($request->all(), [
            'user_type'  => 'required',
            'send_to'     => 'required',
            'count'       => 'nullable|integer',
            'subject'     => 'required|string',
            'message'     => 'required|string',
            'attachment'  => 'nullable|file|max:512' // Max 512KB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. File Attachment Handle 
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            // public/uploads folder 
            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $attachmentPath = 'uploads/' . $fileName;
        }

        // 3. save data to database usine eloquent orm
        WarmupEmail::create([
            'user_type'  => $request->user_type,
            'send_to'     => $request->send_to,
            'count'       => $request->count,
            'subject'     => $request->subject,
            'message'     => $request->message, 
            'attachment'  => $attachmentPath,
        ]);

        // 4. share sucess response to ajax in view 
        return response()->json([
            'status'  => 'success',
            'message' => 'Warmup Email configuration successfully processed and saved!'
        ], 200);
    }
}
