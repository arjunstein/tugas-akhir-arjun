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
                <form action="{{ url('/pengguna/edit/'.$pengguna->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group">
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" readonly value="{{ $pengguna->nama }}" id="exampleInputEmail1" placeholder="Nama Pengguna" name="nama" aria-describedby="emailHelp">
                      @error('nama')
                          <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
          
                    <div class="form-group">
                      <select name="departemen_id" class="form-control">
                          <option value="" selected disabled>Pilih Departemen</option>
                              @foreach ($departemen as $dpt)   
                                  <option value="{{ $dpt->id }}" {{ $pengguna->departemen_id == $dpt->id ? 'selected' 
                                  : '' }}>{{ $dpt->nama_departemen }}</option>
                              @endforeach
                      </select>
                      @if ($errors->has('departemen_id'))
                         <span class="invalid-feedback">
                             <strong>{{ $errors->first('departemen_id') }}</strong>
                          </span>
                      @endif
                    </div>
          
                    <div class="form-group">
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $pengguna->jabatan }}" name="jabatan" id="exampleInputEmail1" placeholder="Jabatan" aria-describedby="emailHelp">
                      @error('jabatan')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror  
                    </div>
          
                    <div class="form-group">
                      <input type="text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $pengguna->no_hp }}" name="no_hp" placeholder="No.Whatsapp" id="exampleInputPassword1">
                      @error('no_hp')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
          
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Update</button>
                    </div>
                
                  </form>

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