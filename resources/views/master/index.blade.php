@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Master List</div>

               <div class="card-body">
                @foreach ($masters as $master)
                <h4>{{$master->name}} {{$master->surname}}</h4>
                <img src="{{asset('images/'.$master->logo)}}" style="width: 100px; height: auto;" alt="User_logo">
                  <a class="btn btn-dark" style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: #ffffff;" href="{{route('master.edit',[$master])}}" class="list-group-item">Edit</a>
                  <form method="POST" action="{{route('master.destroy', [$master])}}">
                  @csrf
                  <button type="submit" class="btn btn-secondary btn-lg btn-block">Remove</button>
                  </form>
                  <br>
                @endforeach
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

