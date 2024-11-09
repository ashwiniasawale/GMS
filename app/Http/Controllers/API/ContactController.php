<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted; // Import the Mailable class
use App\Mail\CareerFormSubmitted; // Import the Mailable class
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class ContactController extends Controller
{
    //

    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject'=>'required',
            'message'=>'required',
            'file_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', // Limit file size to 10MB
           
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'subject.required' => 'Subject is required.',
            'message.required'=>'Message is required.',
            'file_attachment.file' => 'Please upload a valid file.',
            'file_attachment.mimes' => 'Only jpg, jpeg, png, pdf, doc, and docx files are allowed.',
            'file_attachment.max' => 'The file size should not exceed 10MB.',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }
        $check_contact=Contact::where('email',$request->email)
       
        ->count();

        if( $check_contact>0)
        {
            return response()->json([
                'status' => false,
                'message' => 'Already Email Id Registered.',
            ]);
        }else{
          
            $contact = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
               
           $file = null;
           $fileName = null;
           $fileMimeType = null;
            $fileContent=null;
           // Check if file is uploaded
           if ($request->hasFile('file_attachment')) {
               $file = $request->file('file_attachment');
               $fileName = $file->getClientOriginalName();  // Get original file name
               $fileMimeType = $file->getMimeType();        // Get the mime type of the file
               $fileContent = file_get_contents($file->getRealPath()); // Read file content into memory
           }
            Mail::to(env('TO_ADDRESS'))->send(new ContactFormSubmitted($contact, $fileContent, $fileName, $fileMimeType));

            return response()->json([
                'status' => true,
                'message' => 'Contact Form Submitted.'
                
            ], 200);
        }
    }

    public function career(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jobapply'=>'required',
            'name' => 'required',
            'email' => 'required',
            'contact'=>'required',
            'reason'=>'required',
            'cv' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', // Limit file size to 10MB
            'notice_period'=>'required',
            'current_ctc'=>'required',
            'expected_ctc'=>'required',
            'total_experience'=>'required',
            'tech_experience'=>'required'
           
        ], [
            'jobapply.required' => 'Job Position is required.',
            'email.required' => 'Email is required.',
            'name.required' => 'Name is required.',
            'contact.required'=>'Contact is required.',
            'reason.required'=>'Reason is required.',
            'cv.file' => 'Please upload a valid file.',
            'cv.mimes' => 'Only jpg, jpeg, png, pdf, doc, and docx files are allowed.',
            'cv.max' => 'The file size should not exceed 10MB.',
            'contact.required'=>'Contact is required.',
            'notice_period.required'=>'Notice Period is required.',
            'current_ctc.required'=>'Current CTC is required.',
            'expected_ctc.required'=>'Expected CTC is required.',
            'total_experience.required'=>'Total Experience is required.',
            'tech_experience.required'=>'Technology Experience is required.',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $career = [
           'jobapply'=>json_encode($request->jobapply),
            'name' => $request->name,
            'email' =>$request->email,
            'contact'=>$request->contact,
            'reason'=>$request->reason,
            'cv' => 'Please Check Attachment', // Limit file size to 10MB
            'notice_period'=>$request->notice_period,
            'current_ctc'=>$request->current_ctc,
            'expected_ctc'=>$request->expected_ctc,
            'total_experience'=>$request->total_experience,
            'tech_experience'=>$request->tech_experience,
            'note'=>$request->note
        ];
           
       $file = null;
       $fileName = null;
       $fileMimeType = null;
        $fileContent=null;
        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $fileName = $file->getClientOriginalName();  // Get original file name
            $fileMimeType = $file->getMimeType();        // Get the mime type of the file
            $fileContent = file_get_contents($file->getRealPath()); // Read file content into memory
        }
         Mail::to(env('TO_ADDRESS'))->send(new CareerFormSubmitted($career, $fileContent, $fileName, $fileMimeType));

         return response()->json([
             'status' => true,
             'message' => 'Career Form Submitted.'
             
         ], 200);
    }
}
