@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div  class="container-fluid">
<div class="row">
    <div  class="col-sm-2">
        <ul class="nav">
            <li  @click="page=null" class="nav-item form-control"><a class="nav-link " style="color: lightblue" href="javascript:" ><b>Basic Summary</b></a></li>
            <li @click="page='List Of All Online Users'" class="nav-item form-control"><a class="nav-link " style="color: lightblue" href="javascript:" ><b>List Of All Online Users</b></a></li>
            <li @click="page='List Of All Online Jobs'" class="nav-item form-control"><a class="nav-link " style="color: lightblue" href="javascript:" ><b>List Of All Online Jobs</b></a></li>
            {{-- <li  @click="page='Account'" class="nav-item form-control"><a class="nav-link" style="color: lightblue"  href="javascript:"><b>Account </b></a></li> --}}
            <li  @click="page='Pending Payouts'" class="nav-item form-control"><a class="nav-link" style="color: lightblue"  href="javascript:"><b>Pending Payouts</b></a></li>
            <li  @click="page='Payouts'" class="nav-item form-control"><a class="nav-link" style="color: lightblue"  href="javascript:"><b>Payouts</b></a></li>
            <li  @click="page=''" class="nav-item form-control"><a class="nav-link" style="color: lightblue"  href="javascript:"></a></li>
        </ul>
    </div>

{{--    pages comes here--}}
    <div style="background: white" class="col-sm-9 offset-0">
        <h4 v-if="!page"><u>Basic Summary Page</u></h4>
    <table v-if="!page" class="table table-bordered ">
   <thead>
     <tr class='alert-info'>
       <th>Total Cash Income</th>
       <th>Total Company Gain</th>
       <th>Total Cleaners Pay Out</th>
       <th>Total online Clients</th>
       <th>Total online Cleaners</th>
       <th>Total Active Jobs</th>
       <th>Total confirmed Jobs</th>
       <th>Total User Canceled Jobs</th>
     </tr>
   </thead>
   <tbody>
     <tr class='alert-warning'>
       <td>£ {{$totalPayIn[0]->total_pay_in}}</td>
       <td>£ {{ $getPayOut[0]->company_payed_out }}</td>
       <td> £ {{ $getPayOut[0]->cleaners_payed_out }}</td>
       <td> {{$clientUsers}}</td>
       <td> {{ $proffesionalUsers }}</td>
       <td>  {{$activeJobs}}</td>
       <td>  {{ $confirmedJobs }}</td>
       <td> {{$CancledJobs}}</td>
     </tr>
   </tbody>
 </table>
        <h4 v-else><u>@{{ page }}</u></h4>
        <example-component post-title=33 v-if="page==='List Of All Online Users'"></example-component>
        <jobs-component  v-if="page==='List Of All Online Jobs'"></jobs-component>
    </div>
    </div>


</div>
@endsection
