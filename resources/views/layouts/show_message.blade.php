@if (isset($ok))
<div class="row">
    <div class="alert alert-success alert-dismissable col-sm-10 col-sm-offset-1" role="alert">
        <strong>{{ $ok }}</strong>
    </div>
</div>
@elseif (isset($error))
<div class="row">
    <div class="alert alert-danger alert-dismissable col-sm-10 col-sm-offset-1" role="alert">
        <strong>{{ $error }}</strong>
    </div>
</div>
@endif
