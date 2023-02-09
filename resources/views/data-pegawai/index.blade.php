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
                        <td>Nama Pegawai</td>
                        <td>NIK</td>
                        <td>NPWP</td>
                        <td>No. Rek</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datapegawai as $e=>$dp)
                        <tr>
                            <td>{{ $e+1 }}</td>
                            <td>{{ $dp->nama_pegawai }}</td>
                            <td>
                                <a href="https://drive.google.com/file/d/1XdHE8wNVhCoVzP2mUoGuIaJ9dCuTJg1M/view?usp=sharing">{{ $dp->nik }}</a>
                            </td>
                            <td>{{ $dp->npwp }}</td>
                            <td>{{ $dp->norek }}</td>
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