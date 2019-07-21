@extends('back.layouts.app')
@section('title', 'Product Edit Page')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link href="{{asset('backend/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
<link href="{{asset('backend/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{asset('backend/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{asset('backend/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
<link href="{{ asset('backend/assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />

@endpush


@section('content')


 <ul>
@foreach($product->medias as $media)
   <li> {{$media->pivot->media_id}}.{{$media->image}}</li>
@endforeach
</ul>
<!-- 
<ul>
@foreach($product->colors as $color)
   <li>{{$color->name}}</li>
@endforeach
</ul>

<ul>
@foreach($product->sizes as $size)
   <li>{{$size->name}}</li>
@endforeach

</ul> -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Form Layout</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Form Layout</li>
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
    <!-- Row -->
       @if(count($errors)>0)
            <ul class = "alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>
                    {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif

    <div class="card-body">

        <div class="row">
            @foreach($product->medias as $media)
            <div class="col-sm-2">
                <div id="picture_edit_{{$media->id}}" class="picture_edit_{{$media->id}}">
                    @csrf
                    <img src="{{ asset("image_real/medias/product400/product-$media->id.$media->image") }}" style='max-width: 100%;'>
                </div>
                <div>
                    <form method="post" action="{{url('/admin/image-edit')}}" enctype="multipart/form-data" id="myForm">
                        @csrf
                        <input type="hidden" name="id" value="{{$media->id}}">
                        <input type="file" name="file" onchange="getImg(event, {{ $media->id }})">
                        <input type="submit" name="upload" value="Upload">
                    </form>
                </div>
            </div>
            @endforeach
        </div>
<hr />
        <!--start of main form-->
        <form method="post" action="{{route('admin.products.update',$product->id)}}">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label>Product Title:</label>
                        <input type="text" class="form-control" name="title" value="{{$product->title}}" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <label>Product Discription:</label>
                        <textarea id="mymce" name="description">
                            @if(file_exists(storage_path("app/files/{$product->id}.txt")))
                            {!! File::get(storage_path("app/files/{$product->id}.txt")) !!}
                            @endif
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Price:</label>
                        <input type="text" class="form-control" name="price" value="{{$product->price}}" >
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Brand:</label>


                        <select class="form-control custom-select" name="brand_id">
                            <option value="0">Choose</option>
                            @foreach($brands as $brand)
                            @if($brand->id == $product->brand_id)
                            <option selected value="{{$brand->id}}">{{$brand->name}}</option>
                            @else
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endif
                            @endforeach
                        </select>


                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Stock:</label>
                        <input type="text" class="form-control" name="stock" value="{{$product->stock}}" >
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label> Subcategory - Category:</label>

                        <select class="form-control custom-select" name="subcategory_id">
                            <option value="0">Choose</option>
                            @foreach($subcategories as $subcategory)
                            @if($subcategory->id == $product->subcategory_id)
                            <option selected value="{{$subcategory->id}}">{{$subcategory->name}} - {{$subcategory->category['name']}}</option>
                            @else
                            <option value="{{$subcategory->id}}">{{$subcategory->name}} - {{$subcategory->category['name']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--/span-->
            </div>
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Size:</label>
                        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="size[]">
                            @foreach($sizes as $size)
                            @foreach($product->sizes as $siz)
                            @if($size->name == $siz->name)
                                <option selected value="{{$size->id}}">{{$size->name}}</option>

                            @else
                               <option value="{{$size->id}}">{{$size->name}}</option>
                            @endif
                            @endforeach
                            @endforeach

                        </select>
                    </div>
                </div>

                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Color:</label>

                        <select class="select2 m-b-10 select2-multiple" style="width: 100%" multiple="multiple" data-placeholder="Choose" name="color[]">

                            @foreach($colors as $color)

                            @foreach($product->colors as $colr)
                            @if($color->name == $colr->name)
                                <option selected value="{{$color->id}}">{{$color->name}}</option>

                            @else
                               <option value="{{$color->id}}">{{$color->name}}</option>
                            @endif
                            @endforeach

                            @endforeach
                        </select>

                    </div>
                </div>



                <!--/span-->
            </div>




             <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control custom-select">
                          
                            <option value="0">Choose Product Type</option>
                            <option {{ $product->type == 1 ? 'selected' : '' }} value="1">general</option>
                            <option {{ $product->type == 2 ? 'selected' : '' }} value="2">personalised</option>

                        </select>
                    </div>
                </div>



                <!--/span-->
            </div>

            <div class="row">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <div class="checkbox checkbox-success">
                            <input id="checkbox1" type="checkbox" name="action" value="1" {{ $product->action == 1 ? 'checked' : '' }}>
                            <label for="checkbox1"> Remember me </label>
                        </div>
                    </div>

                </div>



                


            </div>



            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-inverse">Cancel</button>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
@push('js')
<script src="{{ asset('backend/assets/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script>
        function getImg(evt, id){
                evt.preventDefault(); 
             var formData = new FormData();
             // console.log(formData);
             // die();
            var files = evt.target.files;
            var file = URL.createObjectURL(files[0]);
           // console.log(id);
            console.log(files[0]);
            $('#picture_edit_' + id).html('');
            $('.picture_edit_' + id).html('<img src="'  + file + '" style="max-width: 100%;">');
            //  $.ajaxSetup({
            //          headers: {
            //              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //          }
            //      });

            // $.ajax({
            //     type: 'POST',
            //     url: '/admin/image-edit',
            //     data:{"file": files[0]},
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     success: function (response){
            //         console.log(response);
            //     }
                
                
            // });


        }
        // $(document).ready(function() {
        //    $('#myForm').on('submit', function(event){
        //     event.preventDefault();
        //     $.ajax({
        //         url: "{{url('/admin/image-edit')}}",
        //         method:'GET',
        //         data: new FormData(this),
        //         dataType: 'JSON',
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         success: function(response){
        //             console.log(response);
        //         },
        //         error: function(error)
        //         {
        //             console.log(error);   
        //         }

        //     });
        //    });
        // });
        </script>

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

<!--  
    <script type="text/javascript">
        

             $(document).ready(function() {
   $('.mdb-select').materialSelect();
  });
    </script> -->










<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="{{asset('backend/assets/plugins/dropzone-master/dist/dropzone.js')}}"></script>


<script src="{{asset('backend/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
<script src="{{asset('backend/assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{asset('backend/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{asset('backend/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{asset('backend/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
<script src="{{asset('backend/assets/plugins/dff/dff.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('backend/assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>


<script type="text/javascript">
    var total_photos_counter = 0;
    Dropzone.options.myDropzone = {
        uploadMultiple: true,
        parallelUploads: 2,
        maxFilesize: 16,
        previewTemplate: document.querySelector('#preview').innerHTML,
        addRemoveLinks: true,
        dictRemoveFile: 'Remove file',
        dictFileTooBig: 'Image is larger than 16MB',
        timeout: 10000,

        init: function() {
            this.on("removedfile", function(file) {
                $.post({
                    url: 'images/images-delete',
                    data: {
                        id: file.name,
                        _token: $('[name="_token"]').val()
                    },
                    dataType: 'json',
                    success: function(data) {
                        total_photos_counter--;
                        $("#counter").text("# " + total_photos_counter);
                    }
                });
            });
        },
        success: function(file, done) {
            total_photos_counter++;
            $("#counter").text("# " + total_photos_counter);
        }
    };

</script>










<script type="text/javascript">
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });

</script>




@endpush
