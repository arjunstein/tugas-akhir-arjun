@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    <div class="card">
                     
                    <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                    {{ session('success') }}
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ url('update-password') }}">
                    {{ csrf_field() }}
                     
                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">Password lama</label>
                     
                    <div class="col-md-6">
                    <input id="current-password" type="password" class="form-control" placeholder="Masukan password lama" name="current-password" required>
                     
                    @if ($errors->has('current-password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('current-password') }}</strong>
                    </span>
                    @endif
                    </div>
                    </div>
                     
                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                    <label for="new-password" class="col-md-4 control-label">Password baru</label>
                     
                    <div class="col-md-6">
                    <input id="new-password" type="password" placeholder="Masukan password baru" class="form-control" name="new-password" required>
                     
                    @if ($errors->has('new-password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                    @endif
                    </div>
                    </div>
                     
                    <div class="form-group">
                    <label for="new-password-confirm" class="col-md-4 control-label">Ulangi password baru</label>
                     
                    <div class="col-md-6">
                    <input id="new-password-confirm" type="password" placeholder="Ulangi password baru" class="form-control" name="new-password_confirmation" required>
                    </div>
                    </div>
                     
                    <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-key"> 
                    Update</i>
                    </button>
                    </div>
                    </div>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection