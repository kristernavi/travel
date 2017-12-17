@extends('admin.includes.app')
@section('content') 

                <!-- Main row -->
                <div class="row">

                    
                    <div class="col-md-8">
                        <section class="panel">
                            <header class="panel-heading">
                               Destinations
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
    

                                <table class="table table-hover table-bordered" id="destinations-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="col-md-2">Name</th> 
                                            <th class="col-md-3">Description</th>
                                            <th class="col-md-2">Image</th> 
                                            <th class="col-md-3">Link</th> 
                                            <th class="col-md-2">Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($destinations as $destination)
                                        <tr>
                                            <td>{{ $destination->id }}</td>
                                            <td>{{ $destination->name }}</td>
                                            <td>{{ $destination->description }}</td>
                                            <td>{{ $destination->image }}</td>
                                            <td>{{ $destination->link }}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-primary btn-xs edit-btn" data-id="{{ $destination->id }}"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="javascript:;" class="btn btn-danger btn-xs del-btn" data-id="{{ $destination->id }}"><i class="fa fa-times"></i> Delete</a>
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
                                Add Destination
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
 
                                {!! Form::open(array('url' => url('admin/destinations/'.$destination->id), 'enctype' => 'multipart/form-data', 'method' => 'PATCH', 'id' => 'add-destination-form', 'files' => true)) !!}
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                          <label for="name">Name</label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" autocomplete="false" value="{{ $destination->name }}">
                                      </div>
                                      <div class="form-group">
                                          <label for="description">Description</label>
                                          <textarea name="description" class="form-control" rows="4" placeholder="Description">{{ $destination->description }}</textarea> 
                                      </div>  
                                      <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image"> 
                                      </div>
                                      <div class="form-group">
                                          <label for="link">Destination Website Link</label>
                                          <input type="text" class="form-control" id="link" name="link" placeholder="Enter link" autocomplete="false" value="{{ $destination->link }}">
                                      </div>
                                      <div class="form-group">
                                          <label for="long">Longitude</label>
                                          <input type="text" class="form-control" id="long" name="long" placeholder="Enter longitude" autocomplete="false" value="{{ $destination->long }}">
                                      </div>
                                      <div class="form-group">
                                          <label for="lat">Lattude</label>
                                          <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter latitude" autocomplete="false" value="{{ $destination->lat }}">
                                      </div>
                                      <button type="submit" class="btn btn-info">Submit</button>
                                  </form>


                            </div>
                        </section>

                    </div>

                </div>  

 
                  {!! Form::open(array('url' => url('admin/destinations'), 'enctype' => 'multipart/form-data', 'method' => 'DELETE', 'id' => 'delete-destination-form', 'files' => true)) !!} 
                  </form>
@endsection
@section('scripts')
<script type="text/javascript">
  $('#destinations-table').DataTable();
  $('.del-btn').click(function(){
    var that = this;
    $("#delete-destination-form").attr('action','{{ url('admin/destinations') }}/'+that.dataset.id);
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