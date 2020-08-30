@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Edit Outfit</div>

               <div class="card-body">
                    <form method="POST" action="{{route('outfit.update',[$outfit])}}">
                        <label>Type</label>
                        <input type="text" name="outfit_type" value="{{$outfit->type}}" class="form-control">
                        <label>Color</label>
                        <input type="text" name="outfit_color" value="{{$outfit->color}}" class="form-control">
                        <label>Size</label>
                        <input type="text" name="outfit_size" value="{{$outfit->size}}" class="form-control">
                        <label>About</label>
                        <textarea style="margin-bottom: 15px;" name="outfit_about"  class="form-control" id="summernote">{{$outfit->about}}"</textarea>
                        <select style="margin-bottom: 15px;" name="master_id" multiple class="form-control" id="exampleFormControlSelect2">
                            @foreach ($masters as $master)
                                <option value="{{$master->id}}" @if($master->id == $outfit->master_id) selected @endif>
                                    {{$master->name}} {{$master->surname}}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Press "Change" button to save changes to outfit.</small>
                        @csrf
                        <button type="submit"  class="btn btn-secondary btn-lg btn-block">Change</button>
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

