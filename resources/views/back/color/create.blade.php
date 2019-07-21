@extends('back.layouts.app')

@section('title', 'Color Create Page')
@section('content')



            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Form float input</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Form float input</li>
                    </ol>
                </div>
                <div class="">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

                <div class="row">
                    <div class=" offset-sm-3 col-md-6">
                    <!--card title-->
                    <div class="card-title">
                    		<h3 class="box-title m-b-0">Add New Color</h3>
                    </div>
                     <!--card body-->
                    <div class="card card-body">
                            
                        <p class="text-muted m-b-30 font-13"> new  Color </p>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">

                                                   @if(count($errors)>0)
                                <ul class = "alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>
                                        {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                                                <form action="{{ route('admin.colors.store') }}" method="POST">
                                    	@csrf

                                        <!--Name-->
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Color Name" value="{{old('name')}}" >
                                        </div>
                                       
                                            <!--Action button-->              
                                         <div class="form-group">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox1" type="checkbox" name="action" value="1">
                                                <label for="checkbox1"> Remember me </label>
                                            </div>
                                        </div>
                                        
                                        </div>

                                        <!--button list-->
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                   

@endsection