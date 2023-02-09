@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <table class="table myTable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Alat</td>
                        <td>Peminjam</td>
                        <td>Petugas</td>
                        <td>Tanggal Pinjam</td>
                        <td>Tanggal Kembali</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $e=>$pjm)
                    <tr>
                        <td>{{ $e+1 }}</td>
                        <td>{{ $pjm->alat_id }}</td>
                        <td>{{ $pjm->pengguna_id }}</td>
                        <td>{{ $pjm->petugas_id }}</td>
                        <td>{{ $pjm->tgl_pinjam }}</td>
                        <td>{{ $pjm->tgl_kembali }}</td>
                        <td>
                            <p>

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