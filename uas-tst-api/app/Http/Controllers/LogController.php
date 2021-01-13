<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Symptom;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

     public function logSubmit(Request $request) {
         // Validating request
        $this->validate($request, [
			'user_id' => 'required|max:3',
			'symptom_id' => 'required|max:3',
			'temperature' => 'required|max:2',
            'is_traveling' => 'required',
			'traveling_history' => 'max:100',
			'log_date' => 'required'
        ]);
        // Creating and inserting data into database
         $log = Log::create([
             'user_id' => $request->user_id,
             'symptom_id' => $request->symptom_id,
             'temperature' => $request->temperature,
             'is_traveling' => $request->is_traveling,
             'traveling_history' => $request->traveling_history,
             'log_date' => $request->log_date
         ]);

         // Check if input success
         if($log) {
             // Succed Return
            return  response()->json([
                'success' => true,
                'message' => 'Log Input Success',
                'data' => $log
            ], 201);
        } else {
            // Failed Return
            return response()->json([
                'success' => true,
                'message' => 'Log Input Failed'
            ], 400);
        }
     }

     public function logUpdate(Request $request, $logId) {
         // Find log where log.id  = $logId
         $log = Log::find($logId);
         $requestData = $request->all();
            // Check if log not found
            if(empty($log)) {
                return response()->json([
                'success' => 'false',
                'message' => 'No Such Log',
                'data' => 'For id : ' . $logId
            ], 404);
            } else {
                $log->update($requestData);
                return response()->json([
                    'success' => 'true',
                    'message' => 'Log Updated Successfuly',
                    'data' => $requestData
                ], 201);
            }   
     }

     public function logHistory($userId) {
         // Find log where log.user_id == $userId
        $logs = Log::where('user_id', $userId)->get();
        if($logs) {
            // Putting log data into array
            foreach($logs as $i => $item) {
                $log[$i]['log_id'] = $item->id;
                $log[$i]['user_id'] = $item->user_id;
                $log[$i]['username'] = $item->user->name;
                $log[$i]['symptom_name'] = $item->symptom->symptom_name;
                $log[$i]['suggestion'] = $item->symptom->suggestion;
                $log[$i]['temperature'] = $item->temperature;
                $log[$i]['is_traveling'] = $item->is_traveling;
                $log[$i]['traveling_history'] = $item->traveling_history;
                $log[$i]['log_date'] = $item->log_date;
            }
            return response()->json([
                    'success' => true,
                    'message' => 'Log History Successfully Showed',
                    'data' => $log
            ], 201);

        } else {
            return response()->json([
                    'success' => false,
                    'message' => 'Log History Failed Showed',
                    'data' => ''
            ], 400);
        }
     }

     public function logDetail($logId) {
         // Find log where log.id  = $logId
        $log = Log::where('id', $logId)->first();
        // Check if log was exist
        if($log) {
            return response()->json([
                    'success' => true,
                    'message' => 'Log History Detail Successfully Showed',
                    'data' => [
                        'log_date' => $log->log_date,
                        'symptom_name' => $log->symptom->symptom_name,
                        'temperature' => $log->temperature,
                        'is_traveling' => $log->is_traveling,
                        'traveling_history' => $log->traveling_history,
                        'suggestion' => $log->symptom->suggestion
                    ]
            ], 201);
        } else {
            return response()->json([
                    'success' => false,
                    'message' => 'Log History Detail Failed Showed',
                    'data' => ''
            ], 400);
        }
     }

     public function getSuggestion($logId) {
         // Find log where log.id  = $logId
         $log = Log::where('id', $logId)->first();
         return response()->json([
                    'success' => true,
                    'message' => 'Suggestion Successfully Showed',
                    'data' => [
                        'log_date' => $log->log_date,
                        'symptom_name' => $log->symptom->symptom_name,
                        'suggestion' => $log->symptom->suggestion
                    ]
            ], 201);
     }

}
