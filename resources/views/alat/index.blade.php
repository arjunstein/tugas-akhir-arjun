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
                        <td>Alat</td>
                        <td>Kategori</td>
                        <td>Deskripsi</td>
                        <td>Gambar</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alat as $e=>$alt)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ ucwords($alt->nama_alat) }}</td>
                        <td>{{ ucwords($alt->kategori->nama_category) }}</td>
                        <td>{{ ucfirst($alt->desc) }}</td>
                        <td><img src="{{ asset('storage/alats/'.$alt->image) }}" width="100px" alt=""></td>
                        <td>
                            <p>
                                
                                <form onsubmit="return confirm('Yakin ingin hapus?')" action="{{ url('alat/delete/'.$alt->id) }}" method="POST">
                                 <a class="btn btn-warning btn-xs" href="{{ url('alat/edit/'.$alt->id) }}"><i class="fa fa-pencil"></i></a>
                                 @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
          <form action="/alat/store" method="POST" enctype="multipart/form-data">
            @csrf
  
            <div class="form-group">
              <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ old('nama_alat') }}" id="exampleInputEmail1" placeholder="Nama Alat" name="nama_alat" aria-describedby="emailHelp">
              @error('nama_alat')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
                    <select name="category_id" class="form-control">
                        <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($category as $ctg)   
                                <option value="{{ $ctg->id }}">{{ $ctg->nama_category }}</option>
                            @endforeach
                    </select>
                @if ($errors->has('category_id'))
                       <span class="invalid-feedback">
                           <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                @endif
            </div>

            <div class="form-grup">
                <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" name="image">
                    <p>.jpg .png max 200kb</p>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
            </div>

            <div class="form-group">
                <textarea class="form-control @error('desc') is-invalid @enderror" placeholder="Deskripsi alat" value="" name="desc">{{ old('desc') }}</textarea>
                @error('desc')
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