<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Table;
use App\Reqest;
use App\Dishe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Response;

class ResrvationsController extends Controller {
    /**
     * Register new user
     *
     * @param $request Request
     */   
     


     
    

     public function reserver(Request $request)
    {      
            
             $this->validate($request, [
                'emplacment'=> 'required',
                'nbpersone' => 'required',
                'arrive_at'=> 'required'
           ]);
          
           $emplacment = $request->input('emplacment');
           $nbpersone  = $request->input('nbpersone');
           $arrive_at = $request->input('arrive_at');
           
           //hna ychof ida kayna table yhwas aliha ida lgach yglo mkanch 
            $name= Table::where('emplacment', '=' ,$emplacment )->where('capacity', '=' ,$nbpersone )->where('status', '=' , 1 )->first();
            if($name==null){
                return "sorry no table " ;

                //ba3dha yhwas ida hadi tabla li yhwas aliha mahkoma fi had wa9t yglo bli thkmat 
            }elseif($date = Reservation::where('arrive_at','=',$arrive_at)->where('table_id', '=' ,$name->id )->first()){
                return "sorry the table taken  ";

                //ida mahich mahkoma w kayna haya ydir reservation :D nrmlmnt hka 
            }else{
            $table = Reservation::create([
                'user_id' => 1,
                'table_id' =>$name->id ,
                 'status' =>'confirmed',
                 'arrive_at'=>$arrive_at
            ]);

            
           
           return"Great! your table is : '$name' , now please insert your demande ";
           
          
            }
            
        }

   
        public function demande(Request $request)
    {

        $this->validate($request, [
           'name_dish'=> 'required',
            'Additions' => 'required',
            'Quantity' => 'required'
     ]);

     
     $name_dish = $request->input('name_dish');
     $Additions  = $request->input('Additions');
     $Quantity = $request->input('Quantity');
       

     $table = Reqest::create([
        'user_id' => 1,
        'dish_id' =>1 ,
         'Additions' =>$Additions,
         'Quantity'=>$Quantity,
         'reservation_id' => 25

    ]);

      
   
     
     
     return 'thanks for order :D !';

       
       
     //  return $name;
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
