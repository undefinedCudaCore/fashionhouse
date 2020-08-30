@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">
                <div class="title">Outfit's list</div>
                <form action="{{route('outfit.index')}}" method="get">
                  <select name="master_id" class="form-control form-control-sm">
                      <option value="0">Show all</option>
                      @foreach ($masters as $master)
                          <option value="{{$master->id}}" @if ($selectId == $master->id) selected @endif>{{$master->name}} {{$master->surname}}</option>
                      @endforeach
                  </select>
                  <label>Sort by: </label>
                  <ul class="list-group">
                    Type: <input type="radio" name="sort" value="type" @if ('type' == $selectId) checked @endif><br>
                    Color: <input type="radio" name="selectId" value="color" @if ('color' == $selectId) checked @endif><br>
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="{{route('outfit.index')}}" class="btn btn-outline-primary">Reset</a>
                  </ul>
              </form>
               </div>

               <div class="card-body">
                
                @foreach ($outfits as $outfit)
                  <a style="margin-bottom: 15px; font-size: 25px; line-height: 25px; text-decoration: none; text-align: center; color: black;" href="{{route('outfit.edit',[$outfit])}}"  class="list-group-item">{{$outfit->type}} {{$outfit->outfitMaster->name}} {{$outfit->outfitMaster->surname}}</a>
                  
                  

                  
                  <form method="POST" action="{{route('outfit.destroy', [$outfit])}}">
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
