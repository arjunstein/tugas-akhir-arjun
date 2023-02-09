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
                <form action="{{ url('/petugas/update/'.$petugas->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="form-group">
                      <input type="text" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ $petugas->nama_petugas }}" id="exampleInputEmail1" placeholder="Nama Petugas" name="nama_petugas" aria-describedby="emailHelp">
                      @error('nama_petugas')
                          <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
          
                    <div class="form-group">
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $petugas->jabatan }}" name="jabatan" id="exampleInputEmail1" placeholder="Jabatan" aria-describedby="emailHelp">
                      @error('jabatan')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                      @enderror  
                    </div>
        
                    <div class="form-group">
                      <input type="number" class="form-control @error('no_telp') is-invalid @enderror" value="{{ $petugas->no_telp }}" name="no_telp" id="exampleInputEmail1" placeholder="Whatsapp" aria-describedby="emailHelp">
                      @error('no_telp')
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