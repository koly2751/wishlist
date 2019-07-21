@extends('back.layouts.app')
@section('title', 'Products View Page')
@section('content')




<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Table basic</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item">pages</li>
            <li class="breadcrumb-item active">Table basic</li>
        </ol>
    </div>
    <div>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   

                    <h2 class="card-title" style="background-color: #1976D2; color: whitesmoke;">All Products</h2>
                    <h6 class="card-subtitle"><a href="{{ route('admin.products.create') }}" class="btn btn-success">Add New Product</a></h6>


                 <h2>For Offer Product</h2>
                    <form action="{{route('admin.poffer')}}" method="POST">
                        @csrf
                      <div class="col-md-6">
                      <div class="form-group">
                        <label>Offer:</label>
                        <select class="form-control custom-select" name="offer">
                            <option value="0">choose your Offer</option>
                            @foreach($offers as $off)
                            <option value="{{$off->id}}">{{$off->title}}</option>
                            @endforeach      
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="ovi" class="btn btn-primary">submit</button>
                    </div>
                </div>
                    
                    <div class="table-responsive m-t-40">

                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <!--start of table-->
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Brand</th>
                                    <th>SubCategory</th>
                                    <th>stock</th>
                                    <th>price</th>
                                    <th>color</th>
                                    <th>offer</th>
                                    <th>size</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <!--end of thead-->
                            <tfoot>
                                <tr>
                                    <!--end of tfoot-->
                                    <th>SL</th>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Brand</th>
                                    <th>SubCategory</th>
                                    <th>stock</th>
                                    <th>price</th>
                                    <th>color</th>
                                    <th>offer</th>
                                    <th>size</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>

                            <tbody>
                                @foreach($products as $key=>$product)
                                <tr>
                                    <td><input type="checkbox" style="left: auto; opacity: 1;" name="checkbox[]" value="{{$product->id}}"></td>

                                    <td>{{$product->title}}</td>
                                    <td>

                                        @foreach($product->medias as $media)

                                        {{ $media->image }}
                                        @endforeach


                                    </td>
                                    
                                    <td>{{$product->brand['name']}}</td>
                                    <td>{{$product->subcategory['name']}}</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>

                                        @foreach($product->colors as $color)

                                        {{ $color->name }}
                                        @endforeach


                                    </td>

                                    <td>
                                        @if($product->offer != NULL)
                                        <span class="btn btn-success">offered</span>
                                        @endif
                                        

                                    </td>

                                    <td>

                                        @foreach($product->sizes as $size)

                                        {{ $size->name }}
                                        @endforeach


                                    </td>
                                    <td>huj</td>
                                    <td>

                                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                         <a href="{{route('admin.products.delete',$product->id)}}" class="btn btn-danger" >
                                         
                                                <i class="fa fa-trash"></i></a>
                                     </td>


                                </tr>
                                @endforeach
                            </tbody>

                        </table>


                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')

<script type="text/javascript">
    

    $(' .hr .edit_info').click(function(){
       if($(this).is(':checked')){
            $('<input>', { 'id':'editBox', 'type': 'texbox', 'val': $(this).siblings('span').text()}).insertAfter($(this));
                $(this).siblings('span').hide();
        }else{
            $(this).siblings('#editBox').remove();
            $(this).siblings('span').show();
        }
    });

</script>



<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->







<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

</script>



@endpush
