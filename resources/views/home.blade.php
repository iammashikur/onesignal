@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session()->has('message'))
            <div class="alert alert-success mt-4 mb-4">
                {{ session()->get('message') }}
            </div>
        @endif

            <div class="card">
                <div class="card-header">{{ __('Push a Notification') }}</div>



                <div class="card-body">




                    <form method="POST" action="{{route('push.send')}}" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                          <label for="">Title</label>
                          <input type="text"
                            class="form-control" name="title" id="" aria-describedby="helpId" placeholder="" required>
                          <small id="helpId" class="form-text text-muted">Title Here</small>
                        </div>


                          <div class="form-group">
                            <label for="">Body</label>
                            <textarea type="text"
                              class="form-control" name="body" id="" aria-describedby="helpId" placeholder="" required></textarea>
                            <small id="helpId" class="form-text text-muted">Description Here</small>
                          </div>

                          <div class="form-group">
                            <label for="">Link</label>
                            <input type="text"
                              class="form-control" name="url" id="" aria-describedby="helpId" placeholder="" required>
                            <small id="helpId" class="form-text text-muted">Clickable Link here</small>
                          </div>


                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control-file" name="image" id="" placeholder="" aria-describedby="fileHelpId" required>
                            <small id="fileHelpId" class="form-text text-muted">Post Image Here</small>
                          </div>

                          <button class="btn btn-primary btn-sm float-right" type="submit">Push To All Devices</button>


                    </form>







                </div>
            </div>
        </div>
    </div>
</div>
@endsection
