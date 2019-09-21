<?php

namespace App\Http\Controllers;
use DB;
use App\Job;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $getPayOut = DB::select( DB::raw("SELECT sum(professional_take) as cleaners_payed_out, sum(company_take) as company_payed_out from jobs" ));
      $pendingPayOut = DB::select( DB::raw("SELECT  *  from jobs where status = 3 and payed is null"));
      $totalPayIn = DB::select( DB::raw("SELECT  sum(total_charge) as total_pay_in  from jobs"));
      $clientUsers = User::where('professional',0)->get();
      $proffesionalUsers = User::where('professional',1)->get();
      $activeJobs = DB::select( DB::raw("SELECT * from jobs where status=2"));
      $confirmedJobs =  DB::select( DB::raw("SELECT * from jobs where status=3"));
      $CancledJobs =  DB::select( DB::raw("SELECT * from jobs where status=0"));

      return view('home',[
        'getPayOut' => $getPayOut,
        'pendingPayOut' => $pendingPayOut,
        'totalPayIn' => $totalPayIn,
        'clientUsers' => count($clientUsers),
        'proffesionalUsers' => count($proffesionalUsers),
        'activeJobs' => count($activeJobs),
        'confirmedJobs' =>count($confirmedJobs),
        'CancledJobs' => count($CancledJobs)
      ]);
  }

    }
