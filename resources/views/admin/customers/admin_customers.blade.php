@extends('admin.includes.app')
@section('content') 

                <!-- Main row -->
                <div class="row">

                    
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                               Customers
                            </header>
                            <div class="panel-body table-responsive">


                                @if(session('status') !='')
                                    @if(session('status'))
                                        <div class="alert alert-success">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Success!</strong> Record added successfully.
                                        </div>
                                    @else
                                        <div class="alert alert-block alert-danger">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Error!</strong> An error occured while adding record.
                                        </div>
                                    @endif
                                @endif
    

                                <table class="table table-hover table-bordered" id="customers-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-md-2">Name</th> 
                                            <th class="col-md-3">Email</th> 
                                            <th class="col-md-2">Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td> 
                                            <td>
                                                <a href="{{ url('admin/customers/'.$customer->id).'/edit' }}" class="btn btn-primary btn-xs edit-btn" data-id="{{ $customer->id }}"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="javascript:;" class="btn btn-danger btn-xs del-btn" data-id="{{ $customer->id }}"><i class="fa fa-times"></i> Delete</a>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>

                    </div>
                    <div class="col-lg-4">

                        <!--chat start-->
                        <section class="panel">
                            <header class="panel-heading">
                                Add Customer
                            </header>
                            <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif 
 
                                {!! Form::open(array('url' => url('admin/customers'), 'enctype' => 'multipart/form-data', 'method' => 'POST', 'id' => 'add-destination-form', 'files' => true)) !!}
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label for="name">Name</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false">
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email address</label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="false">
                                      </div>
                                      <div class="form-group hidden">
                                          <label for="exampleInputPassword1">Password</label>
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="false" value="123123">
                                      </div>
                                      <div class="form-group hidden">
                                          <label for="exampleInputPassword1">Confirm Password</label>
                                          <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" autocomplete="false" value="123123">
                                      </div>
                                      <input type="hidden" name="type" value="customers">
                                      <button type="submit" class="btn btn-info">Submit</button>
                                  </form>


                            </div>
                        </section>

                    </div>

                </div>  

 
                  {!! Form::open(array('url' => url('admin/customers'), 'enctype' => 'multipart/form-data', 'method' => 'DELETE', 'id' => 'delete-destination-form', 'files' => true)) !!} 
                  </form>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#customers-table').DataTable();
  $('.del-btn').click(function(){
    var that = this;
    $("#delete-destination-form").attr('action','{{ url('admin/customers') }}/'+that.dataset.id);
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) { 
           $("#delete-destination-form").submit();
      } else {
        swal("Record is safe!");
      }
    });
  });
  @if(session('is_deleted') !='')
      @if(session('is_deleted'))
        swal({
            title: "Record has been deleted!",
            icon: "success"
          });
      @endif
  @endif


  @if(session('updated_status') !='')
      @if(session('updated_status'))
        swal({
            title: "Record has been updated successfully!",
            icon: "success"
          });
      @endif
  @endif
</script>
@endsection