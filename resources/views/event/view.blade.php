@extends('master')
@section('content')

    <div class="row">
        <div class="col-md-8">
               Title : {{ $event->title ??  null }}
               Description : {{ $event->description ??  null }}
               Start Date : {{ $event->start_date ??  null }}
               End Date : {{ $event->end_date ??  null }}

        </div>
    </div>

@endsection
