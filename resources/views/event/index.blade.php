
@extends('master')
@section('content')

    <div class="row">
        <div class="col-md-8">
           @if(\Illuminate\Support\Facades\Session::get('success_message'))
                <b> <p style="color: green"> {{ \Illuminate\Support\Facades\Session::get('success_message')  }}</p></b>
            @endif
               @if(\Illuminate\Support\Facades\Session::get('error_message'))
                   <b> <p style="color: red"> {{ \Illuminate\Support\Facades\Session::get('error_message')  }}</p></b>
               @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <a class="btn btn-primary" href="{{ route('event.create') }}" type="button">Add Event</a>
        </div>
        <div class="form-group col-md-4">
                <label> Sort by</label>
            <form method="get" action="{{ route('event.index') }}">
                <select class="form-control" name="sort">
                    <option value="asc">ASC</option>
                    <option value="desc">DSC</option>
                </select>
                <button type="submit" class="btn btn-primary">Sort</button>
            </form>
        </div>

           <div class="form-group col-md-4">
               <form method="get" action="{{ route('event.index') }}">
                   <label> Filter</label>
               <select class="form-control" name="filter">
                   <option value="finished">Finished Events</option>
                   <option value="upcoming">Upcoming events</option>
                   <option value="upcoming_within">Upcoming events within 7 days</option>
                   <option value="finished_last">Finished events of last 7 days</option>
               </select>
                   <button type="submit" class="btn btn-primary">Filter</button>
        </form>
           </div>


    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">S.N</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="event_body">
        @forelse($events as $event)
            <tr>
                <th>{{ $loop->iteration  ?? null }}</th>
                <td>{{ $event->title  ?? null }}</td>
                <td>{{ $event->description  ?? null }}</td>
                <td>{{ $event->start_date  ?? null }}</td>
                <td>{{ $event->end_date  ?? null }}</td>
                <td>{{ $event->from_time  ?? null }}</td>
                <td>{{ $event->to_time  ?? null }}</td>
                <td>{{ $event->status  ?? null }}</td>
                <td>
                    <a class="btn btn-secondary" href="{{ route('event.show', $event->id) }}">View</a>
                    <a class="btn btn-secondary" href="{{ route('event.edit', $event->id) }}">Edit</a>
                    <a class="btn btn-danger delete" href="#" data-id="{{ $event->id }}"> Delete</a>
                </td>
            </tr>
        @empty
            <tr><td align="center" colspan="8">No events found!</td></tr>
        @endforelse
        </tbody>
    </table>
    <div>
        {{ $events ? $events->withQueryString()->links() : '' }}
    </div>
<script>
    //For delete operation

    $(document).on('click', '.delete', function(){
        var result = confirm('Do you want to delete?');
        if(!result){
            return false;
        }
        var id= $(this).data('id');
        if(!id){
            alert('Something is Wrong!');
            return;
        }
       var url = "{{ route('event.destroy',':id') }}";
       url = url.replace(':id', id);
        $.ajax({
            url: url,
            method: "DELETE",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (data) {
                $('#event_body').empty().append(data);
            },
            error: function (data) {
                alert('Something went wrong!')
            },
        });

    })

</script>
@endsection
