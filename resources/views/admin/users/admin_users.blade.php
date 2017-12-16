@extends('admin.includes.app')
@section('content') 

                <!-- Main row -->
                <div class="row">

                    
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                               Users 
                            </header>
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
                                            <th>User Type</th>
                                            <!-- <th>Client</th> -->
                                            <th>Email</th>
                                            <!-- <th>Price</th> -->
                                            <th>Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->type }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</a>
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
                                Add User
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

                                <form  action="{{ url('admin/users') }}" method="POST">
                                        {{ csrf_field() }}
                                      <div class="form-group">
                                          <label for="name">Name</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false">
                                      </div>
                                      <div class="form-group">
                                          <label for="email">Email address</label>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="false">
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Password</label>
                                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="false">
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Confirm Password</label>
                                          <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirm Password" autocomplete="false">
                                      </div>
                                      
                                      <div class="form-group">
                                          <label for="type">Type</label>
                                            <select name="type" class="form-control">
                                                <option value="admin">Admin</option>
                                                <option value="customer">Customer</option>
                                            </select>
                                      </div>
                                      <button type="submit" class="btn btn-info">Submit</button>
                                  </form>


                            </div>
                        </section>

                    </div>

                </div>  
@endsection
@section('scripts')
<script type="text/javascript">
  $('#users-table').DataTable();
</script>
@endsection