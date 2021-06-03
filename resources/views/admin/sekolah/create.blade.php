@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="{{asset('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/themify-icons/css/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" href="{{asset('public/vendors/selectFX/css/cs-skin-elastic.css')}}">

<link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Forms</a></li>
                    <li class="active">Basic</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{$pagename}}</strong>
                    </div>
                    <div class="card-body card-block">


                        @if($errors->any())

                        <div class="alert alert-danger">
                            <div class="list-group">
                                @foreach($errors->all() as $alert)
                                    
                                <li class="list-group-item">
                                    {{$alert}}
                                </li>
                                @endforeach
                            </div>
                        </div>

                        @endif
                        <!-- Untuk Form menuju ke route dulu baru contller tugas store -->
                        <form action="{{route('sekolah.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal"> 
                            @csrf
                            <!-- Untuk Form -->

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Sekolah</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="txtnama_sekolah" placeholder="Text" class="form-control"><small class="form-text text-muted"></small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Kode Sekolah</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="txtkode_sekolah" placeholder="Text" class="form-control"><small class="form-text text-muted"></small></div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Kepala Sekolah</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="txtnama_kepala" placeholder="Text" class="form-control"><small class="form-text text-muted"></small></div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Simpan
                            </button>

                            <!-- Menghapus semua data dalam form -->
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                            <!-- Lokal -->
                            
                        </form>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('public/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('public/vendors/popper.js/dist/umd/popper.min.js')}}"></script>

<script src="{{asset('public/vendors/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js')}}"></script>

<script src="{{asset('public/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/js/main.js')}}"></script>
    
@endsection