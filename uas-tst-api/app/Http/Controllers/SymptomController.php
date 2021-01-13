<?php

namespace App\Http\Controllers;
use App\Models\Symptom;
class SymptomController extends Controller
{
     public function symptomList() {
         // Getting all symptom
         $symptoms = Symptom::get(['id', 'symptom_name', 'suggestion']);
         return  response()->json([
                'success' => true,
                'message' => 'Load Symptom Success',
                'data' => $symptoms
            ], 201);
     }
}
