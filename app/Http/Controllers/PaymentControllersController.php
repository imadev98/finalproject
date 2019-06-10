<?php namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Reduction;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class PaymentControllersController extends Controller {

    

   
     public function reductions(Request $request){     	
             $this->validate($request, [
                'start_date'=> 'required',
                'end_date'=> 'required',
                'values'=> 'required',
                'Reason'=>'required'
           ]);
           $start_date = $request->input('start_date');
           $end_date = $request->input('end_date');
           $values = $request->input('values');
           $Reason = $request->input('Reason');

              $table = Reduction::create([
                'start_date' =>$start_date,
                'end_date' =>$end_date,
                 'values' =>$values,
                 'Reason'=>$Reason
            ]);
           return"Great! its done "; 
              }

      

}
