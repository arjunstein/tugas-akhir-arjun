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
                  <td>Pengguna</td>
                  <td>Departemen</td>
                  <td>Jabatan</td>
                  <td>Whatsapp</td>
                  <td>Registrasi</td>
                  <td>Aksi</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($pengguna as $e=>$pgn)
                <tr>
                  <td>{{ $e+1 }}</td>
                  <td>{{ ucwords($pgn->nama) }}</td>
                  <td>{{ ucwords($pgn->departemen->nama_departemen) }}</td>
                  <td>{{ $pgn->jabatan }}</td>
                  <td>{{ $pgn->no_hp }}</td>
                  <td>{{ date('d-M-Y', strtotime($pgn->created_at)) }}</td>
                  <td>
                    <p>
                      <form action="{{ url('pengguna/delete/'.$pgn->id) }}" method="POST">
                       <a class="btn btn-warning btn-xs" href="{{ url('pengguna/edit/'.$pgn->id) }}"><i class="fa fa-pencil"></i></a>
                      
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
        <form action="/pengguna/store" method="POST">
          @csrf

          <div class="form-group">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" id="exampleInputEmail1" placeholder="Nama Pengguna" name="nama" aria-describedby="emailHelp">
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
                        <option value="{{ $dpt->id }}">{{ $dpt->nama_departemen }}</option>
                    @endforeach
            </select>
            @if ($errors->has('departemen_id'))
               <span class="invalid-feedback">
                   <strong>{{ $errors->first('departemen_id') }}</strong>
                </span>
            @endif
          </div>

          <div class="form-group">
            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" name="jabatan" id="exampleInputEmail1" placeholder="Jabatan" aria-describedby="emailHelp">
            @error('jabatan')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
            @enderror  
          </div>

          {{-- <div class="form-group">
            <select name="role" class="form-control">
                <option value="" selected disabled>Pilih Hak akses</option>   
                        <option value="petugas">Petugas</option>
                        <option value="user">Pengguna</option>
            </select>
            @if ($errors->has('role'))
               <span class="invalid-feedback">
                   <strong>{{ $errors->first('role') }}</strong>
                </span>
            @endif
          </div> --}}

          <div class="form-group">
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" name="no_hp" placeholder="No.Whatsapp" id="exampleInputPassword1">
            @error('no_hp')
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