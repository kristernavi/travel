@extends('admin.includes.app')
@section('content')

                <!-- Main row -->
                <div class="row">


                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Book

                            </header>
                            <div class="panel-body table-responsive">



                                <table class="table table-hover table-bordered" id="customers-table">
                                    <thead>
                                        <tr>
                                            <th> Book #</th>
                                            <th>Date Reserve</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Package</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            @if(\Auth::user()->type == 'admin')
                                            <th>Booked</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </section>

                    </div>

                </div>



@endsection
@section('scripts')
<script type="text/javascript">
  $(function(){
    var table = $('#customers-table').DataTable({
      bProcessing: true,
      bServerSide: false,
      sServerMethod: "GET",
      'ajax': '/admin/get-transcations',
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
        {data: 'book_no',  name: 'book_no', className: 'col-md-2 text-left',   searchable: true, sortable: true},
        {data: 'date',  name: 'date', className: 'col-md-2 text-left',   searchable: true, sortable: true},
        {data: 'name',  name: 'name', className: 'col-md-2  text-left',   searchable: true, sortable: true},
        {data: 'email',  name: 'email', className: 'col-md-2 text-left',  searchable: true, sortable: true},
        {data: 'package',  name: 'package', className: 'col-md-2 text-left',  searchable: true, sortable: true},
        {data: 'status',   name: 'status', className: 'col-md-1 text-left',  searchable: false,  sortable: false},
        {data: 'amount',   name: 'amount', className: 'col-md-1 text-center',  searchable: false,  sortable: false},
        @if(Auth::user()->type == 'admin')
        {data: 'booked',   name: 'booked', className: 'col-md-1 text-left',  searchable: false,  sortable: false},
        @endif
        {data: 'actions',   name: 'actions', className: 'col-md-2 text-left',  searchable: false,  sortable: false},
      ],
      'order': [[0, 'asc']]
    });

    $(".add-data-btn").click(function(x){
          x.preventDefault();
          var that = this;
          $("#addmodal").html('');
          $("#addmodal").modal();
          $.ajax({
            url: '/admin/customers/create',
            success: function(data) {
              $("#addmodal").html(data);
            }
          });
    });
    $(document).off('click','.reject-data-btn').on('click','.reject-data-btn', function(e){
      e.preventDefault();
      var that = this;
            bootbox.confirm({
              title: "Reject  Reservation?",
              className: "del-bootbox",
              message: "Are you sure you want to reject record?",
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
                  url:'/admin/reservation-reject/'+that.dataset.id,
                  type: 'post',
                  data: {_token :token},
                  success:function(result){
                    $("#customers-table").DataTable().ajax.url( '/admin/get-transcations' ).load();
                    if(result.success)
                    {
                    swal({
                        title: result.msg,
                        icon: "success"
                      });
                  }else{
                    swal({
                        title: result.msg,
                        icon: "error"
                      });
                  }
                  }
                  });
                 }
              }
          });
    });
    $(document).off('click','.confirm-data-btn').on('click','.confirm-data-btn', function(e){
      e.preventDefault();
      var that = this;
            bootbox.confirm({
              title: "Confirm  Reservation?",
              className: "del-bootbox",
              message: "Are you sure you want to confirm record?",
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
                  url:'/admin/reservation-confirm/'+that.dataset.id,
                  type: 'post',
                  data: {_token :token},
                  success:function(result){
                    $("#customers-table").DataTable().ajax.url( '/admin/get-transcations' ).load();
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

 $(document).off('click','.update-data-btn').on('click','.update-data-btn', function(e){
      e.preventDefault();
      var that = this;
            bootbox.confirm({
              title: "Update Book?",
              className: "del-bootbox",
              message: "Are you sure you want to confirm record?",
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
                  url:'/admin/book-update/'+that.dataset.id,
                  type: 'post',
                  data: {_token :token},
                  success:function(result){
                    $("#customers-table").DataTable().ajax.url( '/admin/get-transcations' ).load();
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
</script>
@endsection
