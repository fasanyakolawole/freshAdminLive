<?php

namespace App\Http\Controllers;

use App\User;
use App\Job;

use Illuminate\Http\Request;

class backend extends Controller
{
  //users related end points
   public function getClients(){
       $getCients = User::where('professional',0)->orderBy('name')->paginate(10);
       foreach ($getCients as  $value) {
         $value->date= $value->created_at->format('d/m/Y') ?? '';
       }
       return response()->json([
            $getCients
       ],200);
   }

   public function getCleaners(){
       $getCients = User::where('professional',1)->where('active',true)->orderBy('name')->paginate(10);
       foreach ($getCients as  $value) {
         $value->date= $value->created_at->format('d/m/Y') ?? '';
       }
       return response()->json([
            $getCients
       ],200);
   }

   public function inactiveCleaners(){
       $getCients = User::where('professional',1)->whereNull('active')->orderBy('name')->paginate(10);
       foreach ($getCients as  $value) {
         $value->date= $value->created_at->format('d/m/Y') ?? '';
       }
       return response()->json([
            $getCients
       ],200);
     }

   public function activateCleaners(Request $request){
       $getCients = User::find($request->get('id'));
       if($getCients->active){
        $getCients->active = null;
        $response = $getCients->name.' was succesfully Deactivated';
      }else{
        $getCients->active = true;
          $response = $getCients->name.' was succesfully Activated';
      }
       $getCients->save();
       return response()->json([
            'response' => $response
       ],200);
   }


/////jobs related endpoints
   public function awaitingJobs(){
       $getJobs = Job::where('status',1)->paginate(10);

       foreach ($getJobs as  $value) {
         $value->date= $value->job_date->format('d/m/Y') ?? '';
         $value->client_name= User::find($value->client_id)->name;
        $value->cleaner_name= User::find($value->cleaners_id)->name ?? 'awaiting';
       }
       return response()->json([
            $getJobs
       ],200);
   }

   public function activeJobs(){
       $getJobs = Job::where('status',2)->paginate(10);

       foreach ($getJobs as  $value) {
         $value->date= $value->job_date->format('d/m/Y') ?? '';
         $value->client_name= User::find($value->client_id)->name;
        $value->cleaner_name= User::find($value->cleaners_id)->name ?? 'awaiting';
       }

       return response()->json([
            $getJobs
       ],200);
   }


   public function completedJobs(){
       $getJobs = Job::where('status',3)->paginate(10);

       foreach ($getJobs as  $value) {
         $value->date= $value->job_date->format('d/m/Y') ?? '';
         $value->client_name= User::find($value->client_id)->name;
        $value->cleaner_name= User::find($value->cleaners_id)->name ?? 'awaiting';
       }

       return response()->json([
            $getJobs
       ],200);
   }

   public function cancledJobs(){
       $getJobs = Job::where('status',0)->paginate(10);

       foreach ($getJobs as  $value) {
         $value->date= $value->job_date->format('d/m/Y');
         $value->client_name= User::find($value->client_id)->name;
         $value->cleaner_name= User::find($value->cleaners_id)->name ?? 'awaiting';
       }

       return response()->json([
            $getJobs
       ],200);
   }


}
