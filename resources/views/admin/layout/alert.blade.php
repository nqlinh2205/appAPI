 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif
    
@if (Session::has('success'))
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif

@if (isset($alert))
    @if ($alert['error']==true)
        <div class="alert alert-danger">
            {{$alert['Message']}}
        </div>
    @else
        <div class="alert alert-success">
            {{$alert['Message']}}
        </div>
    @endif



@endif
