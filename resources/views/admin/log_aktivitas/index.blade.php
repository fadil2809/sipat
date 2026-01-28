@extends('layouts.dashboard')

@section('title', 'Log Aktivitas')

@section('content')
    <h2>Log Aktivitas</h2>

    <table border="1" cellpadding="10" width="100%">
        <tr>
            <th>No</th>
            <th>Nama User</th>
            <th>Aktivitas</th>
            <th>Waktu</th>
        </tr>

        @foreach ($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->aktivitas }}</td>
                <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
    </table>
@endsection
