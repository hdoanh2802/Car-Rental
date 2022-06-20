@extends('layouts.admin')
@section('title')
    <title>Import-user</title>
@endsection
@section('content')
    <div class="content-wrapper">

        @include('partials.content-header', ['name' => 'User', 'key' => 'Import'])
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if (session()->has('failures'))
            <table class="alert alert-danger">
                <thead>
                    <tr>
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Error</th>
                        <th>Value</th>
                    </tr>
                </thead>
                @foreach (session()->get('failures') as $failures)
                    <tr>
                        <td>{{ $failures->row() }} </td>
                        <td>{{ $failures->attribute() }} </td>
                        <td>
                            @foreach ($failures->errors() as $e)
                                {{ $e }}
                            @endforeach
                        </td>
                        <td>{{ $failures->values()[$failures->attribute()] }} </td>
                    </tr>
                @endforeach
            </table>
        @endif

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('user.import') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="file" name="file">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
