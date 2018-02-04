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


                              <div class="col-md-5">
                                <form action="" method="POST" role="form">
                                  <legend>Card Info</legend>

                                  <div class="form-group">
                                    <label for="">Card</label>
                                    <input type="text" class="form-control" id="" placeholder="Card No." value="{{$card}}">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Balance</label>
                                    <input type="text" class="form-control" id="" placeholder="Card No." value="{{$balance}}" disabled="">
                                  </div>



                                  <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                              </div>
                            </div>
                        </section>

                    </div>

                </div>



@endsection
@section('scripts')

@endsection
