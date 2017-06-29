@extends('layouts.master')

@section('body_content')
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">

  @include('layouts.navigation')

  @include('layouts.menu_admin')
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Edit</h4> </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                <div class="col-sm-6">
                  <h3 class="box-title m-b-0">Edit</h3>
                </div>
                  <div class="col-sm-6">
                    <div id="editable-datatable_filter" class="dataTables_filter">
                      <input type="search" class="form-control input-sm" placeholder="Enter search" aria-controls="editable-datatable">
                    </div>
                  </div>
                </div>
                  <div class="white-box">
                    <form method="POST" name="form-category" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar Categorias</h4> </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre Categoria:</label>
                        <input type="text" class="form-control" value="{{$category->name}}" name="name_category" id="name_category">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Image Category:</label>
                        <input type="file" class="form-control" name="image_category" id="image_category" />
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Descripcion:</label>
                        <textarea name="description_category" value="{{$category->description}}"  cols="20" rows="5"></textarea>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-danger waves-effect waves-light" value="Save changes" />
            </div>
            </form>


                  </div>
              </div>
            </div>
            <!-- ============================================================== -->
            <!-- wallet, & manage users widgets -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
@endsection

@section('library_js')
<script src="{{URL::asset('assets/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<script src="https://connect.soundcloud.com/sdk/sdk-3.1.2.js"></script>
@endsection

@section('script')

<script>
SC.initialize({
  client_id: 'QXmuRpggFFioDmDQNBTAy37TKqVyxAlY'
});
  var dataSet = [];
// find all sounds of buskers licensed under 'creative commons share alike'
SC.get('/tracks', {
  q: 'Cesar Castellanos'
}).then(function(tracks) {

  tracks.forEach(function(element) {

  dataSet.push([element.title])
  });
  console.log(dataSet)
  $('#audioTableSoundcloud').DataTable({
      data: dataSet,
      columns: [
          { title: "Name" }
      ]
  } );
});
//console.log(dataSet)


</script>

<!--
<script>

$(document).ready(function() {
  var url = 'http://api.soundcloud.com/users/105703689/tracks/?q=cesar&client_id=QXmuRpggFFioDmDQNBTAy37TKqVyxAlY';
  var dataSet = [];

  $.getJSON(url, function(tracks) {
    var i = 1;
    //console.log(tracks[0].title)
    tracks.forEach(function(element) {
    //console.log(element.title);
    dataSet.push([element.title])
});
console.log(dataSet)
$('#audioTableSoundcloud').DataTable({
    data: dataSet,
    columns: [
        { title: "Name" }
    ]
} );

  });




} );




</script>
-->

@endsection
