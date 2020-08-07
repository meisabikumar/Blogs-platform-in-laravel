@if (count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <strong>{{$error}}</strong>
        </div>        
    @endforeach    
@endif

{{-- @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
@endif --}}

@if (session('success'))
        <div class="alert alert-success" role="alert">
            <strong>{{session('success')}}</strong>
        </div>   
@endif

@if (session('error'))
        <div class="alert alert-danger" role="alert">
            <strong>{{session('error')}}</strong>
        </div>   
@endif
