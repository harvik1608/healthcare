<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Speciality;
use App\Models\Appointment;
use Carbon\Carbon;

class CommonController extends Controller
{
    public function fetch_specialities()
    {
        $data = Speciality::select("id","name")->where("is_active", 1)->get();
        return response()->json(['status' => 200,'specialities' => $data]);
    }

    public function fetch_professionals(Request $request)
    {
        if($request->speciality_id == "") {
            $professionals = Professional::where("is_active", 1)->with("speciality")->get();
        } else {
            $professionals = Professional::where("is_active", 1)->where("speciality_id",$request->speciality_id)->with("speciality")->get();
        }
        return response()->json(['status' => 200,'professionals' => $professionals]);
    }

    public function view_professional(Request $request)
    {
        $professional = Professional::where("id",$request->professional_id)->where("is_active", 1)->with("speciality")->first();
        return response()->json(['status' => 200,'professional' => $professional]);
    }

    public function book_appointment(Request $request)
    {
        $post = $request->all();

        $model = new Appointment;
        $count = $model->where(["user_id" => $post["user_id"],"professional_id" => $post["professional_id"],"date" => $post["date"],"stime" => $post["stime"].":00","etime" => $post["etime"].":00"])->where("status", "confirmed")->count();
        if($count == 0) {
            $count = $model->where(["user_id" => $post["user_id"],"date" => $post["date"],"stime" => $post["stime"].":00","etime" => $post["etime"].":00"])->where("status", "confirmed")->count();
            if($count == 0) {
                if(strtotime(date("Y-m-d H:i:s",strtotime($post["date"]." ".$post["stime"]))) > strtotime(date("Y-m-d H:i:s"))) {
                    $model = new Appointment;
                    $model->user_id = $post["user_id"];
                    $model->professional_id = $post["professional_id"];
                    $model->date = $post["date"];
                    $model->stime = $post["stime"].":00";
                    $model->etime = $post["etime"].":00";
                    $model->note = $post["note"];
                    $model->status = "confirmed";
                    $model->created_at = date("Y-m-d H:i:s");
                    $model->save();

                    return response()->json(['status' => 200,'message' => "Appointment booked successfully."]);
                } else {
                    return response()->json(['status' => 400,'message' => "You can't book appointment in past."]); 
                }
            } else {
                return response()->json(['status' => 400,'message' => "You already booked appointment with same date & slot with other professional."]);
            }
        } else {
            return response()->json(['status' => 400,'message' => "Selected slot already booked"]);
        }
    }

    public function my_appointment(Request $request)
    {
        $appointments = Appointment::with(['professional' => function ($query) {
            $query->select('id', 'name'); 
            }
        ])->where("user_id",$request->user_id)->get();
        return response()->json(['status' => 200,'appointments' => $appointments]);
    }

    public function update_appointment_status(Request $request)
    {
        $post = $request->all();

        $appointment = Appointment::find($post['appointment_id']);
        $appointment->status = $post['status'];
        $appointment->save();
        
        return response()->json(['status' => 200,'message' => $post["status"] == "completed" ? "Appointment completed successfully." : "Appointment cancelled successfully."]);
    }
}
