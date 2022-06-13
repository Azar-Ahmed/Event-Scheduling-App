@extends('front-end.include.layout')
@section('page_title', 'Dashboard')

@section('container')
<div class="container">
  <div class="row">
    <div class="col-md-6 my-5">
        <h1 style="font-size: 3.20875rem; font-weight: 900;"><b> Welcome<br> <span class="text-primary"> @foreach ($user as $item)
          {{$item->first_name.''. $item->last_name}}
      @endforeach </span></b></h1>
        <p>Event Scheduler is provide easiest way for scheduling meetings professionally and efficiently,
            eliminating all the time consuming task so you can get back to work.</p>
           <p>Event & activity booking software that automates registrations, attendee database management, event marketing, & analytics so that you can focus on delivering memorable experiences</p> 
         <button class="btn btn-outline-primary btn-lg">Get Started</button>   
    </div>
    <div class="col-md-6 text-end d-sm-none d-md-block">
      <img src="{{asset("assets/Schedule.gif")}}" style="width: 75%" alt="Schedule">
    </div>
</div>
</div>

@endsection

@section('custom_script')
@endsection
