@extends('admin.includes.app')
@section('content')

                <!-- Main row -->
                <div class="row">


                    <div class="col-md-12">
                        <section class="panel">

                            <div class="panel-body table-responsive">

                                @if(session('success'))

                                        <div class="alert alert-success">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Success!</strong> {{ session('success') }}
                                        </div>


                                    @endif
                                     @if (count($errors) > 0)


            @foreach ($errors->all() as $error)
                <div class="alert alert-block alert-danger">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Error!</strong> {{ $error }}
                                        </div>
            @endforeach

         @endif


                              <div class="col-md-5">
                                <form action="" method="POST" role="form">
                                  <legend>Card Info</legend>

                                  <div class="form-group">
                                    <label for="">Card</label>
                                    <input type="text" class="form-control" id="" placeholder="Card No." value="{{$card}}" name="number">
                                  </div>

                                  <div class="form-group">
                                    <label for="">Balance</label>
                                    <input type="text" class="form-control" id="" placeholder="Card No." value="{{ number_format($balance,2)}}" disabled="">
                                  </div>


                                  {{ csrf_field() }}
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
