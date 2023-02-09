@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                      </button>
                </p>
            </div>
            <div class="box-body">
               <table class="table myTable">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Departemen</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($departemen as $e=>$dpt)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ ucwords($dpt->nama_departemen) }}</td>
                        <td>
                            <p>
                                <form action="{{ url('departemen/delete/'.$dpt->id) }}" method="POST">
                                 <a class="btn btn-warning btn-xs" href="{{ url('departemen/edit/'.$dpt->id) }}"><i class="fa fa-pencil"></i></a>
                                
                                 @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                              </form>
                              </p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
               </table>
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

<!-- Modal tambah data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel"><b>Tambah {{ $title }}</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/departemen/store" method="POST">
            @csrf
  
            <div class="form-group">
              <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror" value="{{ old('nama_departemen') }}" id="exampleInputEmail1" placeholder="Nama Departemen" name="nama_departemen" aria-describedby="emailHelp">
              @error('nama_departemen')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
  
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        
          </form>
        </div>      
      </div>
    </div>
  </div>