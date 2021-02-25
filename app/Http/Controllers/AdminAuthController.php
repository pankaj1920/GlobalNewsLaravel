<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminAuthController extends Controller
{

    function admin_register(Request $request)
    {

        if ($request->has('mobile')) {
            $check_data = Admin::where('mobile', $request->mobile);
            if ($check_data->get()->count() > 0) {
                return [
                    "status" => "0",
                    "message" => "User Already Exit",
                    "data" => $check_data->get()->first()
                ];
            } else {
                $add_data = new Admin;
                $add_data->name = $request->name;
                $add_data->mobile = $request->mobile;
                $add_data->email = $request->email;
                $add_data->password = $request->password;
                $add_data->address = $request->address;
                $result = $add_data->save();

                
                if ($result) {
                    return [
                        "status" => "1",
                        "message" => "Register Sucessfully",
                        "data" => $check_data->get()->first()
                    ];
                } else {
                    return [
                        "status" => "0",
                        "message" => "Something went Wrong",

                    ];
                }
            }
        } else {
            return [
                "status" => "0",
                "message" => "Required Fields are missing"
            ];
        }
    }

    function admin_email_login(Request $request)
    {
        if ($request->has('email') and $request->has('password')) {
            $check_data = Admin::where('email', $request->email)->where('password', $request->password);
            if ($check_data->get()->count() > 0) {
                return [
                    "status" => "1",
                    "message" => "logged in",
                    "data" => $check_data->get()->first()
                ];
            } else {
                return [
                    "status" => "0",
                    "message" => "Wrong Credential"
                ];
            }
        } else {
            return [
                "status" => "0",
                'message' => "Required fields are missing"
            ];
        }
    }


    function admin_mobile_login(Request $request)
    {
        if ($request->has('mobile')) {
            $check_data = Admin::where('mobile', $request->mobile);
            if ($check_data->get()->count() > 0) {
                $result = $check_data->update([
                    "otp" => mt_rand(000000,999999)
                ]);
                if ($result) {
                    return [
                        "status" => "1",
                        "message" => "Otp Generated Sucessully"
                    ];
                } else {
                    return [
                        "status" => "0",
                        "message" => "Something went wrong"
                    ];
                }
            } else {
                return [
                    'status' => '0',
                    'message' => 'Invalid Mobile Number'
                ];
            }
        } else {
            return [
                'status' => "1",
                "message" => "Required Fields are missing"
            ];
        }
    }

    function verify_otp(Request $request){
        if($request->has('mobile') and $request->has('otp')){

            $check_data = Admin::where('mobile',$request->mobile)->where('otp',$request->otp);
            if($check_data->get()->count() > 0){
                return["status"=>"1",
            "message"=>"Otp verified sucessfully"
        ];
            }else{
                return["status"=>"0",
            "message"=>"Wrong Credential"
        ];
            }


        }else{
            return["status"=>"0",
            "message"=>"Required fields are missing"
        ];
        }
    }
}
