@extends('admin.layouts.admin')

@section('title', 'Livestreams')

@section('content')
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>UserName</th>
                                <th>Stream ID</th>
                                <th>Status</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($livestreams as $index => $livestream)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>({{ $livestream->user->FirstName }} {{ $livestream->user->LastName }}
                                        ) {{ $livestream->user->Email }}</td>
                                    <td>{{ $livestream->user->Username }}</td>
                                    <td class="text-muted">
                                        {{ $livestream->stream_id }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $livestream->status }}
                                    </td>
                                    <td>
                                        <a href="{{ route('stream.live', [$livestream->stream_id]) }}" target="_blank">Visit</a>
                                    </td>
                                </tr>
                            @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
