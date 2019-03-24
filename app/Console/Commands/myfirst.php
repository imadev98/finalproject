<?php
namespace App\Console\Commands;

use Illuminate\Support\Carbon;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
 
class myfirst extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'command:myfirst';
 
  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'just for test ';
 
  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
  }
 
  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $hellos = DB::table('tests')->select('time')->get();
     
 
    
    for($i = sizeof($hellos) ; $i > 0 ; $i-- ){
     $hello2 = $hellos->first();
     $hello3 = $hello2->time;
     //$me1 = date('H',strtotime("+0 minute ",strtotime($hello3)));
     //$me2 = date('Y-m-d H:i:s',strtotime("+0 minute ",strtotime($hello3)));
     

     $to = Carbon::createFromFormat('Y-m-d H:i:s', $hello3);
     $from = Carbon::createFromFormat('Y-m-d H:i:s', carbon::now());
      if($to < $from){
   
       $diff_in_minutes = $to->diffInMinutes($from);
    
       if($diff_in_minutes >=60)
      {
        
      DB::table('tests')
      ->where('time','=',$to)
      ->update(['status' => 'annuled ']);
      
       }

      }
       
    
    

        $first_key = $hellos->keys()->first();
         $hellos = $hellos->forget($first_key); 
      }
      

      

//echo  date("H",strtotime($hello));
    // }


     
     // DB::table('tests')
      //->where('status', '=','annuled')
      //->update(['status' => 'confirmed']);
   
   

    
  }
}