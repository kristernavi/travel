@extends('admin.includes.app')
@section('content')

                <!-- Main row -->
                <div class="row">


                    <div class="col-md-12">
                        <section class="panel">

                            <div class="panel-body table-responsive">

                                @if(session('status') !='')
                                    @if( !is_null(session('status')) )
                                        <div class="alert alert-success">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Success!</strong> User added successfully.
                                        </div>
                                    @else
                                        <div class="alert alert-block alert-danger">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Error!</strong> An error occured while adding user.
                                        </div>
                                    @endif
                                    @endif


                                <table class="table table-hover table-bordered" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </section>

                    </div>

                </div>

  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="addmodal"></div>
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="editmodal"></div>

@endsection
@section('scripts')
<script type="text/javascript">
  $(function(){
    var table = $('#users-table').DataTable({
      bProcessing: true,
      bServerSide: false,
      sServerMethod: "GET",
      'ajax': '/admin/get-business',
      searching: true,
      paging: true,
      filtering:false,
      bInfo: true,
      responsive: true,
      language:{
        "paginate": {
          "next":       "<i class='fa fa-chevron-right'></i>",
          "previous":   "<i class='fa fa-chevron-left'></i>"
        }
      },
      "columns": [
        {data: 'row',  name: 'row', className: 'col-md-1  text-left',   searchable: true, sortable: true},
        {data: 'name',  name: 'name', className: 'col-md-4  text-left',   searchable: true, sortable: true},
        {data: 'email',  name: 'email', className: 'col-md-3 text-left',  searchable: true, sortable: true},
        {data: 'status',  name: 'status', className: 'col-md-1 text-left',  searchable: true, sortable: true},
        {data: 'actions',   name: 'actions', className: 'col-md-2 text-center',  searchable: false,  sortable: false},
      ],
      'order': [[0, 'asc']]
    });

    $(".add-data-btn").click(function(x){
          x.preventDefault();
          var that = this;
          $("#addmodal").html('');
          $("#addmodal").modal();
          $.ajax({
            url: '/admin/users/create',
            success: function(data) {
              $("#addmodal").html(data);
            }
          });
    });

    $(document).off('click','.delete-data-btn').on('click','.delete-data-btn', function(e){
      e.preventDefault();
      var that = this;
            bootbox.confirm({
              title: "Confirm Delete Data?",
              className: "del-bootbox",
              message: "Are you sure you want to delete record?",
              buttons: {
                  confirm: {
                      label: 'Yes',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'No',
                      className: 'btn-danger'
                  }
              },
              callback: function (result) {
                 if(result){
                  var token = '{{csrf_token()}}';
                  $.ajax({
                  url:'/admin/users/'+that.dataset.id,
                  type: 'post',
                  data: {_method: 'delete', _token :token},
                  success:function(result){
                    $("#users-table").DataTable().ajax.url( '/admin/get-users' ).load();
                    swal({
                        title: result.msg,
                        icon: "success"
                      });
                  }
                  });
                 }
              }
          });
    });


     $(document).off('click','.active-data-btn').on('click','.active-data-btn', function(e){
      e.preventDefault();
      var that = this;
            bootbox.confirm({
              title: "Continue Process?",
              //className: "del-bootbox",
              message: "Are you sure you want to Update record?",
              buttons: {
                  confirm: {
                      label: 'Yes',
                      className: 'btn-success'
                  },
                  cancel: {
                      label: 'No',
                      className: 'btn-danger'
                  }
              },
              callback: function (result) {
                 if(result){
                  var token = '{{csrf_token()}}';
                  $.ajax({
                  url:'/admin/business-active/'+that.dataset.id,
                  type: 'get',
                  success:function(result){
                    $("#users-table").DataTable().ajax.url( '/admin/get-business' ).load();
                    swal({
                        title: result.msg,
                        icon: "success"
                      });
                  }
                  });
                 }
              }
          });
    });
  });
</script>
@endsection
