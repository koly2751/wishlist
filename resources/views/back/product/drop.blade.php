@extends('back.layouts.app')

@push('css')
<link href="{{ asset('backend/assets/plugins/dropzone-master/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Form dropzone</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Form dropzone</li>
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
    <div>
        <form action="{{ route('admin.products.store') }}" class="dropzone well" id="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple="" />
            </div>
            <button type="submit
                ">kk</button>
        </form>
    </div>










    @endsection

    @push('js')




    <script>
        $("#mydropzone").dropzone({
            url: "/<controller>/action/",
            autoProcessQueue: false,
            uploadMultiple: true, //if you want more than a file to be   uploaded
            addRemoveLinks: true,
            maxFiles: 10,
            previewsContainer: '#previewDiv',

            init: function() {
                var submitButton = document.querySelector("#submitForm");
                var wrapperThis = this;

                submitButton.addEventListener("click", function() {
                    wrapperThis.processQueue();
                });

                this.on("addedfile", function(file) {

                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class="
                        yourclass "> Remove File</button>");

                    // Listen to the click event
                    removeButton.addEventListener("click", function(e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        wrapperThis.removeFile(file);
                    });

                    file.previewElement.appendChild(removeButton);
                });

                // Also if you want to post any additional data, you can do it here
                this.on('sending', function(data, xhr, formData) {
                    formData.append("PKId", $("#PKId").val());
                });

                this.on("maxfilesexceeded", function(file) {
                    alert('max files exceeded');
                    // handle max+1 file.
                });
            }
        });

    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script src="{{asset('backend/assets/plugins/dropzone-master/dist/dropzone.js')}}"></script>
    @endpush
