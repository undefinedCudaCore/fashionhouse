@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Master</div>

               <div class="card-body">
                    <form method="POST" action="{{route('master.store')}}" enctype="multipart/form-data">
                        <label>Name</label>
                        <input type="text" name="master_name" class="form-control" value="{{old('master_name')}}">
                        <label>Surname</label>
                        <input type="text" name="master_surname" class="form-control" value="{{old('master_surname')}}">
                        <label>Image</label>
                        <input type="file" class="form-control" name="master_logo">
                        <small class="form-text text-muted">Press "Create" button to add master.</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
