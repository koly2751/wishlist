@extends('back.layouts.app')
@section('title', 'Offer Edit Page')
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

            <div class="card-title">
                <h3 class="box-title m-b-0">Add New offer</h3>
            </div>
            <div class="card card-body">

                <p class="text-muted m-b-30 font-13"> new Offer </p>
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
                        <form action="{{ route('admin.offers.update',$offer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Offer Name" value="{{$offer->title}}" >
                            </div>


                        <div class="form-group">
                            <label>Discription:</label>
                             <textarea id="mymce" name="description">{!! File::get(str_limit(storage_path("app/files/offers/{$offer->id}.txt"),100)) !!}</textarea>
                         </div>


                            <div class="form-group">
                                <label for="file">Image</label>
                                <input type="file" class="form-control" id="logo" name="image">
                            </div>


                    <div class="form-group">
                        <label>Type</label>
                        <select style="width: 100%" name="type">
                            <option value="1">slider</option>
                            <option value="2">offer-image</option>
                            <option value="3">background-image</option>
                            <option value="4">promotion-image</option>
                        </select>
                   </div>





                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input id="checkbox1" type="checkbox" name="action" value="1">
                                    <label for="checkbox1"> Remember me </label>
                                </div>
                            </div>
                    </div>
                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endsection


    @push('js')
<script src="{{ asset('backend/assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });

</script>

@endpush

