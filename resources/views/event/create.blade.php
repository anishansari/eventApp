@extends('master')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <form method="post" action="{{ route('event.store') }}" enctype="multipart/form-data" id="create_form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                    <small style="color: red"> {{ $errors->first('title') }}</small>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"> </textarea>
                    <small style="color: red"> {{ $errors->first('description') }}</small>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" class="form-control" id="start_date"
                           value="{{ date('Y-m-d') }}">
                    <small style="color: red"> {{ $errors->first('start_date') }}</small>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" class="form-control" id="end_date" value="{{ date('Y-m-d') }}">
                    <small style="color: red"> {{ $errors->first('end_date') }}</small>
                </div>

                <div class="form-group">
                    <label for="from_time">From Time</label>
                    <input type="time" name="from_time" class="form-control" id="from_time" value="{{ date('H:i') }}">
                    <small style="color: red"> {{ $errors->first('from_time') }}</small>
                </div>
                <div class="form-group">
                    <label for="to_time">To Time</label>
                    <input type="time" name="to_time" class="form-control" id="from_time" value="{{ date('H:i') }}">
                    <small style="color: red"> {{ $errors->first('to_time') }}</small>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <small style="color: red"> {{ $errors->first('status') }}</small>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#create_form").validate({
                errorClass: "error fail-alert",
                validClass: "valid success-alert",
                rules: {
                    title : {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                    from_time: {
                        required: true,
                    },
                    to_time: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                }
            });
        });
    </script>

@endsection
