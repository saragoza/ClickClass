@if(session()->has('message.level'))
    @if (session('message.level') == 'ok')
    <div class="row">
        <div class="alert alert-success alert-dismissable col-sm-10 col-sm-offset-1" role="alert">
            <strong>{{ session('message.content') }}</strong>
        </div>
    </div>
    @elseif (session('message.level') == 'error')
    <div class="row">
        <div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1" role="alert">
            <strong>{{ session('message.content') }}</strong>
        </div>
    </div>
    @endif
@endif
