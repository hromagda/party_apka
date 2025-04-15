@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Správa uživatelů</h1>

        <!-- Seznam uživatelů -->
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Jméno</th>
                <th>Email</th>
                <th>Role</th>
                <th>Akce</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Možnosti pro editaci nebo smazání uživatele -->
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.delete', $user->id) }}" class="btn btn-danger">Smazat</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
