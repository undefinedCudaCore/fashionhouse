@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">New Outfit</div>

               <div class="card-body">
                    <form method="POST" action="{{route('outfit.store')}}">
                        <label>Type</label>
                        <input type="text" name="outfit_type" class="form-control" value="{{old('outfit_type')}}">
                        <label>Color</label>
                        <input type="text" name="outfit_color" class="form-control" value="{{old('outfit_color')}}">
                        <label>Size</label>
                        <input type="text" name="outfit_size" class="form-control" value="{{old('outfit_size')}}">
                        <label>About</label>
                        <textarea style="margin-bottom: 15px;" name="outfit_about" class="form-control" id="summernote"  value="{{old('outfit_about')}}"></textarea>
                        <select style="margin-bottom: 15px;" name="master_id" multiple class="form-control" id="exampleFormControlSelect2">
                            @foreach ($masters as $master)
                                <option value="{{$master->id}}">{{$master->name}} {{$master->surname}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Press "Create" button to add outfit.</small>
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-lg btn-block">Create</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script>
    $(document).ready(function() {
       $('#summernote').summernote();
     });
</script>
@endsection

