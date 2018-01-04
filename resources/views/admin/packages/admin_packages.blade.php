@extends('admin.includes.app')
@section('content') 

                <!-- Main row -->
                <div class="row">

                    
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                               Packages 
                               <button class="btn btn-sm btn-success pull-right add-data-btn"><i class="fa fa-plus"></i> Add</button>
                            </header>
                            <div class="panel-body table-responsive">

                                <table class="table table-hover table-bordered" id="packages-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th> 
                                            <th>Description</th> 
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
    var table = $('#packages-table').DataTable({
      bProcessing: true,
      bServerSide: false,
      sServerMethod: "GET",
      'ajax': '/admin/get-packages',
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
        {data: 'row',  name: 'row', className: ' text-left',   searchable: true, sortable: true},
        {data: 'name',  name: 'name', className: 'col-md-3  text-left',   searchable: true, sortable: true}, 
        {data: 'description',  name: 'description', className: 'col-md-6  text-left',   searchable: true, sortable: true},  
        {data: 'actions',   name: 'actions', className: 'col-md-1 text-left',  searchable: false,  sortable: false},
      ], 
      'order': [[0, 'asc']]
    });

    $(".add-data-btn").click(function(x){  
          x.preventDefault();
          var that = this;
          $("#addmodal").html('');
          $("#addmodal").modal();
          $.ajax({
            url: '/admin/packages/create',         
            cache: false,
            success: function(data) {
              $("#addmodal").html(data);
            }
          }); 
    });
    $(document).off('click','.edit-data-btn').on('click','.edit-data-btn', function(e){
      e.preventDefault();
      var that = this; 
      $("#editmodal").html('');
      $("#editmodal").modal();
      $.ajax({
        url: '/admin/packages/'+that.dataset.id+'/edit',  
            cache: false,       
        success: function(data) {
          $("#editmodal").html(data);
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
                  url:'/admin/packages/'+that.dataset.id,
                  type: 'post',
                  data: {_method: 'delete', _token :token},
                  success:function(result){
                    $("#packages-table").DataTable().ajax.url( '/admin/get-packages' ).load();
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