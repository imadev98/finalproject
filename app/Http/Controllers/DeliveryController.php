<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
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

             $this->validate($request, [
                'Address' => 'required',
                'delivery_at'=> 'required',
           ]);
           $dish_name = $request->input('dish_name');
           $Address = $request->input('Address');
           $delivery_at= $request->input('delivery_at');
           $Quantity = $request->input('Quantity');
           $Additions  = $request->input('Additions');
           
           $time = $arrive_at ;
           //hna ychof ida kayna table yhwas aliha ida lgach yglo mkanch 
            $name= Table::where('emplacment', '=' ,$emplacment )->where('capacity', '=' ,$nbpersone )->where('status', '=' , 1 )->first();
            if($name==null){
                return "sorry no table " ;
                
            }
            //ba3dha yhwas ida hadi tabla li yhwas aliha mahkoma fi had wa9t yglo bli thkmat  
                $count = 00;
                $k=0;
                while( $k <=60){ //hna yhwas kol d9i9aa 
                    $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));//hna yhwas b zyada ida kyn 
                    $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));//hna yhwas b tn9as ida kyn
                    $dateplus = Reservation::where('arrive_at','=',$timeplus,'table_id','=',$name->id)->first(); //test fi base de donne
                    $dateminus = Reservation::where('arrive_at','=',$timemins,'table_id','=',$name->id)->first();
                 if($dateplus || $dateminus){
                    return "sorry the table taken  ";
                 }
                 $count= $count +1;
                 $k++;     
             }

              $user_id = Auth::user()->id;
              $table = Reservation::create([
                'user_id' =>$user_id,
                'table_id' =>$name->id ,
                 'status' =>'confirmed',
                 'arrive_at'=>$arrive_at
            ]);
           return"Great! your table is : '$name' , now please insert your demande "; 
            }



            public function delivery_now(Request $request){  

                $this->validate($request, [
                    'Address' => 'required',
              ]);
              $Address = $request->input('Address');
              //hna ychof ida kayna table yhwas aliha ida lgach yglo mkanch 
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
                   'deliverer _id'=>$Delivery->id,
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
      
    
}
