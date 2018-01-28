@if(count($errors) > 0)
  @foreach($errors->all() as $error)
    <div class="collout alert">
      {{$error}}
    </div>
  @endforeach
@endif

@if(session('success'))
    <div class="collout alert">
      {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="collout alert">
      {{session('error')}}
    </div>
@endif
