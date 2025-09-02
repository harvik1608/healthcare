<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Professional;
use App\Models\Speciality;
use App\Models\Appointment;

class ProfessionalController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost/healthcare/public/api/fetch-specialities');
        $_specialities = [];
        $res = $response->json();
        if($res["status"] && $res["status"] == 200) {
            $_specialities = $res["specialities"];
        }        
        return view('professional/professionals', compact('_specialities'));
    }

    public function load(Request $request)
    {
        try {
            $post = $request->all();
            $response = Http::post('http://localhost/healthcare/public/api/fetch-professionals', [
                'speciality_id' => $post["speciality_id"]
            ]);
            $professionals = [];
            $res = $response->json();
            if($res["status"] && $res["status"] == 200) {
                $professionals = $res["professionals"];
            }
            $html = view('professional/load_professionals', compact('professionals'))->render();
            return response()->json(["status" => 200,"message" => "","html" => $html]);
        } catch(Exception $e) {
            return response()->json(["status" => 400,"message" => $e->getMessage()]);
        }
    }

    public function show($professional_id)
    {
        $response = Http::post('http://localhost/healthcare/public/api/view-professional', [
            'professional_id' => $professional_id
        ]);
        $professional = [];
        $res = $response->json();
        if($res["status"] && $res["status"] == 200) {
            $professional = $res["professional"];
        }        
        if(!$professional) {
            return redirect("professionals"); 
        }
        $start = new \DateTime('09:00');
        $end = new \DateTime('20:00');
        $interval = new \DateInterval('PT30M');
        $slots = [];
        while ($start < $end) {
            $slot_start = $start->format('H:i');
            $slot_end_time = clone $start;
            $slot_end_time->add($interval);
            $slot_end = $slot_end_time->format('H:i');
            $slots[] = ['start' => $slot_start,'end' => $slot_end];
            $start->add($interval);
        }
        return view('professional/view_professional', compact('professional','slots'));
    }

    public function book(Request $request)
    {
        try {
            $user = Auth::guard('sanctum')->user();
            $post = $request->all();

            $response = Http::post('http://localhost/healthcare/public/api/book-appointment', [
                'user_id' => $user["id"],
                "professional_id" => $post["professional_id"],
                "date" => $post["date"],
                "stime" => $post["stime"],
                "etime" => $post["etime"],
                "note" => $post["note"] == "" ? "" : $post["note"],
            ]);
            $res = $response->json();
            if($res["status"] && $res["status"] == 200) {
                return response()->json($res);
            } else {
                return response()->json($res);
            }
        } catch(Exception $e) {
            return response()->json(["status" => 400,"message" => $e->getMessage()]);
        }
    }

    public function my_appointments()
    {
        $user = Auth::guard('sanctum')->user();
        $response = Http::post('http://localhost/healthcare/public/api/my-appointments',["user_id" => $user["id"]]);
        $appointments = [];
        $res = $response->json();
        if($res["status"] && $res["status"] == 200) {
            $appointments = $res["appointments"];
        }
        return view('my_appointments', compact('appointments'));
    }

    public function cancel($appointment_id)
    {
        $response = Http::post('http://localhost/healthcare/public/api/update-appointment-status', [
            'appointment_id' => $appointment_id,
            'status' => "cancelled"
        ]);
        return redirect("appointments");
    }

    public function complete($appointment_id)
    {
        $response = Http::post('http://localhost/healthcare/public/api/update-appointment-status', [
            'appointment_id' => $appointment_id,
            'status' => "completed"
        ]);
        return redirect("appointments");
    }
}
