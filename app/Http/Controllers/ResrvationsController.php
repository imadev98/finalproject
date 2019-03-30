<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Table;
use App\Reqest;
use App\Dishe;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class ResrvationsController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */ public function reserver(Request $request){      
             $this->validate($request, [
                'position'=> 'required',
                'nbpersone' => 'required',
                'arrive_at'=> 'required'
           ]);
           $position = $request->input('position');
           $nbpersone  = $request->input('nbpersone');
           $arrive_at = $request->input('arrive_at');
           $time = $arrive_at ;
           //hna ychof ida kayna table yhwas aliha ida lgach yglo mkanch 
            $name= Table::where('position', '=' ,$position )->where('capacity', '=' ,$nbpersone )->where('status', '=' , 1 )->first();
            if($name==null){
                return "sorry no table " ;
                
            }
            //ba3dha yhwas ida hadi tabla li yhwas aliha mahkoma fi had wa9t yglo bli thkmat  
                $count = 00;
                $k=0;
                while( $k <=30){ //hna yhwas kol d9i9aa 
                    $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));

                    
                    $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));
                    
                    $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$name->id)->first(); 
                    
                    $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$name->id)->first();
                 if($dateplus || $dateminus){
                    return "sorry the table taken ";
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
        public function demande(Request $request){
        $reservation_id = Reservation::orderBy('created_at', 'desc')->first();
        $this->validate($request, [
           'name_dish'=> 'required',
            'Additions' => 'required',
            'Quantity' => 'required'
     ]);
     $name_dish = $request->input('name_dish');
     $Additions  = $request->input('Additions');
     $Quantity = $request->input('Quantity');
     $table = Reqest::create([
        'user_id' => $reservation_id->user_id,
        'dish_id' =>1,
         'Additions' =>$Additions,
         'Quantity'=>$Quantity,
         'reservation_id' => $reservation_id->id
    ]);
     return 'thanks for order :D !';
     //  return $name;
    }
   //show_all_reservation
    public function showAll(){
        $allres=Reservation::all();
        //for( $i=9 ; $i >= 10; $i++){
        //$find=$alltables[$i]->id;
        //return $i;
        //}
        //$find = Table::find(9);
                return $allres;
    }
   //delete reservation
    public function annuler(Request $request , Reservation $reservation)
    {
        $this->validate($request, [
             'id'  => 'required',  
        ]);
        $reservation= Reservation::find($request->input('id'));
        $reservation->status='annuler';
        $reservation->save();
        return 'Reservation Annuler !  ';
    }
     
    
}
