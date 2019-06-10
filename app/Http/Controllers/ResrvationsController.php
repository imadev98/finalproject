<?php namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Additions_Reqest;
use App\Addition;
use App\Reservation;
use App\Table;
use App\Reqest;
use App\Dishe;
use App\User;
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
            $name= Table::where('position', '=' ,$position )->whereIn('capacity', array($nbpersone,$nbpersone+1,$nbpersone+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
           
            if($name==null){
                return "sorry no table";
                
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
              $user = Auth::user();
              $count = Auth::user()->count;
              $user->count=$count+1;
              $user->save();
              $test=$user->count;
              if($test==4){
                $reduc=$name->price;
                $reduc=$reduc*0.1;
                $price_red=$name->price;
                $price_red=$price_red-$reduc;
                $user->count=0;
               $user->save();
              }else $price_red=$name->price;
              $table = Reservation::create([
                'user_id' =>$user_id,
                'table_id' =>$name->id ,
                 'status' =>'confirmed',
                 'nb_personne'=>$nbpersone,
                 'arrive_at'=>$arrive_at,
                 'price'=>$price_red
            ]);
            
           return"Great! your table is : '$name' , now please insert your demande "; 
              }

      /*
       *----------------------------------------------------------------------------------------------
       *----------------------------------------------------------------------------------------------
       */

         // Request Food For client 
        public function demande(Request $request){
        $reservation_id = Reservation::orderBy('created_at', 'desc')->first(); 
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
     $table = Reqest::create([
        'user_id' => $reservation_id->user_id,
        'dish_id' =>$name_dish->id,
         'Quantity'=>$Quantity,
         'reservation_id' => $reservation_id->id
    ]);

    $name_dish->Quantity=$QteDispo-$Quantity;
    $name_dish->save();

    $reqest_id = Reqest::orderBy('created_at', 'desc')->first();
   
    $table = Additions_Reqest::create([
        'Addition_id' => $Additions->id,
        'reqest _id' =>$reqest_id->id,
    ]);
     return 'thanks for order :D !';
    }
     
    }
/*  
 *----------------------------------------------------------------------------------------------
 *----------------------------------------------------------------------------------------------
 */


   //show_all_reservation
    public function showAll(){
        $allres=Reservation::all();
                return $allres;
    }

    //show_one_reservation

    public function showOne($id){
        $res=Reservation::find($id);
                return $res;
    }

    
     //filter request reservation ::
     //sort by date 
     public function filterReqest(){
        $res = Reservation::orderBy('created_at', 'desc')->get();
        return $res;
    }
    //sort by date:today 
    public function filterReqestToday(){
        $res = Reservation::whereDate('created_at', Carbon::today())->get();
        return $res;
    }

    //Update Reservation
    public function updateReservation(Request $request,$id){
        
            $Reservation= Reservation::find($id);
            $old_arrive=$Resevation->arrive_at;
            $old_tableid=$Resevation->table_id;
            $old_nbpersonne=$Resevation->nb_personne;
            $old_table=Table::find($old_tableid);

            $this->validate($request, [
                'position',
                'nbpersone',
                'arrive_at'
            ]);
            $position=$request->input('position');
            $nbpersone =$request->input('nbpersone');
            $arrive_at =$request->input('arrive_at');
            $time =$arrive_at;
 /*
  *------------------------------------------------------------------------------------------------------------------------
  */
            if($position!=null && $nbpersone !=null && $arrive_at !=null){
                $new= Table::where('position', '=' ,$position )->whereIn('capacity', array($nbpersonne,$nbpersonne+1,$nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
                if($new==null){
                    return "sorry no table";
                }
                //ba3dha yhwas ida hadi tabla li yhwas aliha mahkoma fi had wa9t yglo bli thkmat  
                  
                    $count = 00;
                    $k=0;
                    while( $k <=30){ //hna yhwas kol d9i9aa 
                        $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));
                        $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));                 
                        $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                        $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
                     if($dateplus || $dateminus){
                        return "sorry the table taken ";
                     }
                     $count= $count +1;
                     $k++;     
                 }
                 $Reservation->table_id  =$new->id ;
                 $Reservation->nb_personne =$nbpersonne;
                 $Reservation->arrive_at =$arrive_at;
                 $Reservation->save();
                 return 'Reservation updated !';

                }

/*
  *------------------------------------------------------------------------------------------------------------------------
  */
           if($position!=null && $nbpersone !=null){
            $new= Table::where('position', '=' ,$position )->whereIn('capacity', array($nbpersonne,$nbpersonne+1,$nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
                if($new==null){
                    return "sorry no table";
                }
                $count = 00;
                    $k=0;
                    while( $k <=30){ 
                        $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($old_arrive)));
                        $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($old_arrive)));                 
                        $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                        $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
                     if($dateplus || $dateminus){
                        return "sorry the table taken ";
                     }
                     $count= $count +1;
                     $k++;     
                 }
                 $Reservation->table_id  =$new->id ;
                 $Reservation->nb_personne =$nbpersonne;
                 $Reservation->save();
                 return 'Reservation updated !';
           }
/*
 *------------------------------------------------------------------------------------------------------------------------
 */
           if($position!=null && $arrive_at !=null){
            $new= Table::where('position', '=' ,$position )->whereIn('capacity', array($old_nbpersonne,$old_nbpersonne+1,$old_nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
            if($new==null){
                return "sorry no table";
            }
            $count = 00;
                    $k=0;
                    while( $k <=30){ //hna yhwas kol d9i9aa 
                        $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));
                        $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));                 
                        $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                        $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
                     if($dateplus || $dateminus){
                        return "sorry the table taken ";
                     }
                     $count= $count +1;
                     $k++;     
                 }
                 $Reservation->table_id  =$new->id ;
                 $Reservation->arrive_at =$arrive_at;
                 $Reservation->save();
                 return 'Reservation updated !';
           }
 /*
  *------------------------------------------------------------------------------------------------------------------------
  */          
           if($nbpersone !=null && $arrive_at !=null){
            $new= Table::where('position', '=' ,$old_table->position )->whereIn('capacity', array($nbpersonne,$nbpersonne+1,$nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
            if($new==null){
                return "sorry no table";
            }
            $count = 00;
            $k=0;
            while( $k <=30){ //hna yhwas kol d9i9aa 
                $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));
                $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));                 
                $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
             if($dateplus || $dateminus){
                return "sorry the table taken ";
             }
             $count= $count +1;
             $k++;     
         }
         $Reservation->table_id  =$new->id ;
         $Reservation->nb_personne =$nbpersonne;
         $Reservation->arrive_at =$arrive_at;
         $Reservation->save();
         return 'Reservation updated !';
           }
  /*
  *------------------------------------------------------------------------------------------------------------------------
  */         

           if($position!=null){
            $new= Table::where('position', '=' ,$position )->whereIn('capacity', array($old_nbpersonne,$old_nbpersonne+1,$old_nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
            if($new==null){
                return "sorry no table";
            }
            $count = 00;
                    $k=0;
                    while( $k <=30){ 
                        $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($old_arrive)));
                        $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($old_arrive)));                 
                        $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                        $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
                     if($dateplus || $dateminus){
                        return "sorry the table taken ";
                     }
                     $count= $count +1;
                     $k++;     
                 }
                 $Reservation->table_id  =$new->id ;
                 $Reservation->save();
                 return 'Reservation updated !';
           }
   /*
  *------------------------------------------------------------------------------------------------------------------------
  */        
           if($nbpersone !=null ){
            $new= Table::where('position', '=' ,$old_table->position )->whereIn('capacity', array($nbpersonne,$nbpersonne+1,$nbpersonne+2))->where('status', '=' , 1 )->orderBy('capacity', 'asc')->first();
            if($new==null){
                return "sorry no table";
            }
            $count = 00;
                    $k=0;
                    while( $k <=30){ 
                        $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($old_arrive)));
                        $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($old_arrive)));                 
                        $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$new->id)->first();              
                        $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$new->id)->first();
                     if($dateplus || $dateminus){
                        return "sorry the table taken ";
                     }
                     $count= $count +1;
                     $k++;     
                 }
                 $Reservation->table_id  =$new->id ;
                 $Reservation->nb_personne =$nbpersonne;
                 $Reservation->save();
                 return 'Reservation updated !';
           }
/*
 *------------------------------------------------------------------------------------------------------------------------
 */        
           if($arrive_at !=null){
            $count = 00;
            $k=0;
            while( $k <=30){ 
                $timeplus = date('Y-m-d H:i:s',strtotime("+$count minute ",strtotime($time)));
                $timemins = date('Y-m-d H:i:s',strtotime("-$count minute ",strtotime($time)));                 
                $dateplus = Reservation::where('arrive_at','=',$timeplus)->where('table_id','=',$old_tableid)->first();              
                $dateminus = Reservation::where('arrive_at','=',$timemins)->where('table_id','=',$old_tableid)->first();
             if($dateplus || $dateminus){
                return "sorry the table taken in this time !  ";
             }
             $count= $count +1;
             $k++;     
         }
         $Reservation->arrive_at =$arrive_at;
         $Reservation->save();
         return 'Reservation updated !';
           }
        }

   //delete reservation
    public function annuler($id)
    {
        $reservation= Reservation::find($id);
        $reservation->status='annuler';
        $reservation->save();
        return 'Reservation Annuler !  ';
    }
/*  
 *---------------------------------------------------------------------------------------------------
 *---------------------------------------------------------------------------------------------------
 */


    //show_all_request
    public function showReqestsDel(){
        $allReq=Reqest::all();
                return $allReq;
    }
    //show_one_request
    public function showReqestDel($id){
        $Req=Reqest::find($id);
                return $Req;
    }

    
 
    //update_request_client
public function updateReqest(Request $request , $id){

     $Reqest= Reqest::find($id); 
     $this->validate($request, [
           'name_dish',
            'Additions',
            'Quantity' 
     ]);
     
     if($request->input('name_dish')!=null ){
        $name_di = Dishe::where('name', '=', $request->input('name_dish'))->first();
        $Reqest->dish_id =$name_di->id;
        $Reqest->save();
       }
     if($Quantity !=null){
        $name_dish = Dishe::find($Reqest->dish_id);
        if($request->input('name_dish')==null){
        $name_dish->Quantity=$name_dish->Quantity+$Reqest->Quantity;
        $name_dish->save();
        }
        $QteDispo=$name_dish->Quantity;
        $Quantity = $request->input('Quantity');

     if($QteDispo==0 || $QteDispo < $Quantity){
        $name_dish->Quantity=$name_dish->Quantity-$Reqest->Quantity;
        $name_dish->save();
         return "sorry Qte Dispo is '$QteDispo' ";
     }else{
    $name_dish->Quantity=$QteDispo-$Quantity;
    $name_dish->save();
    $Reqest->Quantity =$Quantity;
    $Reqest->save();
    }
}
   if($request->input('Additions')!=null ) {
    $Additions = Addition::where('name', '=', $request->input('Additions'))->first();
    $Additions_Reqest =Additions_Reqest::where('reqest_id','=',$Reqest->id)->first();
    $Additions_Reqest->Addition_id =$Additions->id;
    $Additions_Reqest->save();
    }

    return 'Reqest updated !';

}
   //delete request
    public function annulerReqestDel($id)
    {
        $Reqest= Reqest::find($id);
        $Reqest->status='annuler';
        $Reqest->save();
        return 'Reqest Annuler !  ';
    }
     

    
}

                               