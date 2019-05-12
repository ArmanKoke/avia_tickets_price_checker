@extends('partials.main')

@section('content')
    <div class="container">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Departure</th>
                <th scope="col">Destination</th>
                <th scope="col">Price</th>
                <th scope="col">Checked</th>
                <th scope="col">Invalid</th>
                <th scope="col">Price changed</th>
            </tr>
            </thead>
            <tbody>
            @foreach($flights as $flight)
                <tr>
                    <th scope="row">{{ $flight->id }}</th>
                    <td>{{ $flight->departure_points->code }}</td>
                    <td>{{ $flight->destination_points->code }}</td>
                    <td>{{ $flight->price }}</td>
                    <td>
                        @switch( $flight->checked )
                            @case(true)
                            <span class="badge badge-pill badge-success">Yes</span>
                            @break
                            @case(false)
                            <span class="badge badge-pill badge-danger">No</span>
                            @break
                            @default
                            @break
                        @endswitch
                    </td>
                    <td>
                        @switch( $flight->invalid )
                            @case(true)
                            <span class="badge badge-pill badge-success">Yes</span>
                            @break
                            @case(false)
                            <span class="badge badge-pill badge-danger">No</span>
                            @break
                            @default
                            @break
                        @endswitch
                    </td>
                    <td>
                        @switch( $flight->price_change )
                            @case(true)
                            <span class="badge badge-pill badge-success">Yes</span>
                            @break
                            @case(false)
                            <span class="badge badge-pill badge-danger">No</span>
                            @break
                            @default
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
