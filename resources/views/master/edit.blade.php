@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Master</div>

               <div class="card-body">
                    <form method="POST" action="{{route('master.update',[$master->id])}}" enctype="multipart/form-data">
                        <label>Name</label>
                        <input type="text" name="master_name" value="{{old('master_name', $master->name)}}" class="form-control">
                        <label>Surname</label>
                        <input type="text" name="master_surname" value="{{old('master_name', $master->surname)}}" class="form-control">
                        <label>Image</label>
                        <input type="file" class="form-control" name="master_logo">
                        <small class="form-text text-muted">Press "Change" button to save changes to master.</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Change</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

