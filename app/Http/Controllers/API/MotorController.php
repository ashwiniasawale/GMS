<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted; // Import the Mailable class
use App\Mail\MotorControlFormSubmitted;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class MotorController extends Controller
{
    //
    public function motor_control(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'company_name'=>'required',
            'contact'=>'required',
            
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'company_name.required' => 'Company Name is required.',
            'contact.required'=>'Contact is required.',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $motor = [
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'contact' => $request->contact,
            'mcu_application'=>$request->mcu_application,
            'target_users'=>$request->target_users,
            'motor_type'=>$request->motor_type,
            'motor_specifications'=>$request->motor_specifications,
            'environment_conditions'=>$request->environment_conditions,
            'nominal_voltage'=>$request->nominal_voltage,
            'max_current'=>$request->max_current,
            'power_supply_requirements'=>$request->power_supply_requirements,
            'regen_braking_requirements'=>$request->regen_braking_requirements,
            'control_algorithms'=>$request->control_algorithms,
            'performance_characteristics'=>$request->performance_characteristics,
            'torque_speed_control'=>$request->torque_speed_control,
            'safety_features'=>$request->safety_features,
            'communication_interfaces'=>$request->communication_interfaces,
            'remote_monitoring'=>$request->remote_monitoring,
            'data_logging'=>$request->data_logging,
            'logging_frequency'=>$request->logging_frequency,
            'ui_type'=>$request->ui_type,
            'display_information'=>$request->display_information,
            'user_control_functions'=>$request->user_control_functions,
            'size_weight_constraints'=>$request->size_weight_constraints,
            'mounting_requirements'=>$request->mounting_requirements,
            'environment_conditions'=>$request->environment_conditions,
            'development_budget'=>$request->development_budget,
            'development_timeline'=>$request->development_timeline,
            'preferred_suppliers'=>$request->preferred_suppliers,
            'industry_standards'=>$request->industry_standards,
            'gov_regulations'=>$request->gov_regulations,
            'additional_features'=>$request->additional_features,
            'scalability_requirements'=>$request->scalability_requirements,
        ];
      
        Mail::to(env('TO_ADDRESS'))->send(new MotorControlFormSubmitted($motor));

        return response()->json([
            'status' => true,
            'message' => 'Motor Controller Form Submitted.'
            
        ], 200);
    }
}
