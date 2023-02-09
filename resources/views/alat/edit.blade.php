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
                <form action="{{ url('/alat/update/'.$alat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    
                    <div class="form-group">
                      <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" value="{{ $alat->nama_alat }}" id="exampleInputEmail1" placeholder="Nama Alat" name="nama_alat" aria-describedby="emailHelp">
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
                                        <option value="{{ $ctg->id }}" {{ $alat->category_id == $ctg->id ? 'selected' 
                                        : '' }}>{{ $ctg->nama_category }}</option>
                                    @endforeach
                            </select>
                        @if ($errors->has('category_id'))
                               <span class="invalid-feedback">
                                   <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                        @endif
                    </div>
        
                    <div class="form-grup">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                            <p>.jpg .png max 200kb</p>
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                    </div>
        
                    <div class="form-group">
                        <textarea class="form-control @error('desc') is-invalid @enderror" name="desc">{{ $alat->desc }}</textarea>
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