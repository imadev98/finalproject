<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reqests_Delivery;
use App\Additions_Delivery;
use App\Delivery;
use App\Addition;
use App\Dishe;
use App\User;
use App\Vehicle;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class DeliveryController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */ public function delivery(Request $request){  

            }



            public function delivery_now(Request $request){  

                $this->validate($request, [
                    'Address' => 'required',
              ]);
               $Address = $request->input('Address');
               $Delivery= User::where('deliverer', '=' ,1)->where('status', '=' ,1 )->first();
               $Vehicle= Vehicle::where('status', '=' ,1)->first();
               if($Delivery==null){
                   return "sorry no deliverer available Now ! " ;
               }elseif($Vehicle==null){
                return "sorry no vehicle available Now ! " ;
               }else{
                 //$user_id = Auth::user()->id;
                 $table = Delivery::create([
                   'user_id' =>2,
                   'vehicle_id'=>$Vehicle->id,
                   'deliverer_id'=>$Delivery->id,
                    'status' =>'on way',
                    'Address' => $Address
                       
               ]);

               $Delivery->status = 0 ;
               $Delivery->save();
               $Vehicle->status=0;
               $Vehicle->save();


              return"Thank you !  "; 
               }
            }
      /*
       *----------------------------------------------------------------------------------------------
       *----------------------------------------------------------------------------------------------
       */

            public function demandeDelivery(Request $request){
                $delivery_id = Delivery::orderBy('created_at', 'desc')->first(); 
                
                $this->validate($request, [
                   'name_dish'=> 'required',
                    'Additions' => 'required',
                    'Quantity' => 'required'
             ]);
              
               
             $name_dish = Dishe::where('name', '=',$request->input('name_dish'))->first();
             $QteDispo=$name_dish->Quantity;
             $Additions = Addition::where('name', '=', $request->input('Additions'))->first();
             $Quantity = $request->input('Quantity');
             if($QteDispo==0 || $QteDispo < $Quantity){
                 return "sorry Qte Dispo is '$QteDispo' ";
             }else{
             $table = Reqests_Delivery::create([
                'user_id' => $delivery_id->user_id,
                'dish_id' =>$name_dish->id,
                 'Quantity'=>$Quantity,
                 'delivery_id' => $delivery_id->id
            ]);
        
            $name_dish->Quantity=$QteDispo-$Quantity;
            $name_dish->save();
            $reqest_id = Reqests_Delivery::orderBy('created_at', 'desc')->first();
        
            $table = Additions_Delivery::create([
                'Addition_id' => $Additions->id,
                'deliveryrequest_id' =>$reqest_id->id
            ]);
             return 'thanks for order :D !';
            }
      /*
       *----------------------------------------------------------------------------------------------
       *----------------------------------------------------------------------------------------------
       */
            }
              //show_all_deliveries
            public function showAll(){
                $alldel=Delivery::all();
                        return $alldel;
            }
            //show_one_Delivery
            public function showOne($id){
                $delv=Delivery::find($id);
                        return $delv;
            }
            //Update Delivery 
            public function updateDelivery(Request $request , $id)
            {
                $Delivery= Delivery::find($id);
                $this->validate($request, [
                    'user_id',
                    'deliverer_id',
                    'vehicle_id',
                    'Address',
                    'delivery_at',
                    'status'
                ]);
                $user_id =$request->input('user_id');
                $deliverer_id =$request->input('deliverer_id');
                $vehicle_id =$request->input('vehicle_id');
                $Address =$request->input('Address');
                $delivery_at =$request->input('delivery_at');
                $status =$request->input('status');
                if($user_id!=null ){
                $Delivery->user_id =$user_id;
               }
               if($deliverer_id!=null){
                  $Delivery->deliverer_id =$deliverer_id;
               }
               if($vehicle_id!=null){
                $Delivery->vehicle_id  =$vehicle_id;
               }
               if($Address!=null){
                $Delivery->Address =$Address;
             }
             if($delivery_at !=null){
              $Delivery->delivery_at =$delivery_at ;
             }
             if($status !=null){
                $Delivery->status =$status ;
               }
               $Delivery->save();
               return 'Delivery updated !';
              
            }//update Adresse
            public function updateAddress(Request $request , $id)
            {
                $Delivery= Delivery::find($id);
                $this->validate($request, [
                    'Address'
                ]);
                $Address =$request->input('Address');
               
               if($Address!=null){
                $Delivery->Address =$Address;
               }
               $Delivery->save();
               return 'Address updated !';
              
            }
           //delete Delivery
            public function annulerDel($id)
            {
                $Delivery= Delivery::find($id);
                $Delivery->status='annuler';
                $Delivery->save();
                return 'Delivery Annuler !  ';
            }
      /*
       *----------------------------------------------------------------------------------------------
       *----------------------------------------------------------------------------------------------
       */

            //show_all_deliveries_request
            public function showReqestsDel(){
                $allReq=Reqests_Delivery::all();
                        return $allReq;
            }
            //show_one_Delivery_request
            public function showReqestDel($id){
                $Reqdel=Reqests_Delivery::find($id);
                        return $Reqdel;
            }
         
            //update_Delivery_request_client
     public function updateReqestDel(Request $request , $id){

             $Reqests_Delivery= Reqests_Delivery::find($id); 
             $this->validate($request, [
                   'name_dish',
                    'Additions',
                    'Quantity' 
             ]);
             
             if($request->input('name_dish')!=null ){
                $name_di = Dishe::where('name', '=', $request->input('name_dish'))->first();
                $Reqests_Delivery->dish_id =$name_di->id;
                $Reqests_Delivery->save();
               }
               $Quantity= $request->input('Quantity');
              if($Quantity !=null){
                $name_dish = Dishe::find($Reqests_Delivery->dish_id);
                if($request->input('name_dish')==null){
                $name_dish->Quantity=$name_dish->Quantity+$Reqests_Delivery->Quantity;
                $name_dish->save();
                }
                $QteDispo=$name_dish->Quantity;
                

             if($QteDispo==0 || $QteDispo < $Quantity){
                $name_dish->Quantity=$name_dish->Quantity-$Reqests_Delivery->Quantity;
                $name_dish->save();
                 return "sorry Qte Dispo is '$QteDispo' ";
             }else{
            $name_dish->Quantity=$QteDispo-$Quantity;
            $name_dish->save();
            $Reqests_Delivery->Quantity =$Quantity;
            $Reqests_Delivery->save();
            }
        }
           if($request->input('Additions')!=null ) {
            $Additions = Addition::where('name', '=', $request->input('Additions'))->first();
            $Additions_Reqest =Additions_Delivery::where('reqest_id','=',$Reqests_Delivery->id)->first();
            $Additions_Reqest->Addition_id =$Additions->id;
            $Additions_Reqest->save();
            }

            return 'Reqests_Delivery updated !';

        }
           //delete Delivery_request
            public function annulerReqestDel($id)
            {
                $Reqests_Delivery= Reqests_Delivery::find($id);
                $Reqests_Delivery->status='annuler';
                $Reqests_Delivery->save();
                return 'Reqests_Delivery Annuler !  ';
            }



        
      
    
}
