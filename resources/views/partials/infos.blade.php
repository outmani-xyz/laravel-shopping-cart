
<!--erros and message of success begin--> 
<div class="col-md-12 text-center">
    @if(Session::has('fail'))
    <h3 class=" bg-danger">{{ Session::get('fail') }}</h3>
    @endif
    @if(Session::has('success'))
    <h3 class=" bg-success">{{ Session::get('success') }}</h3>
    @endif
    @if(count($errors)>0)
    <ul class="list-unstyled bg-danger">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>
<!--erros and message of success end--> 
