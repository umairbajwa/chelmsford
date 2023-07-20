@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Questions</h2>
                    </div>

                    @if (checkPermissions('questions', 2))
                        <div class="col-auto">
                            <a href="{{ url('questions/create') }}" class="btn btn-primary">Create</a>
                        </div>
                    @endif
                </div>

                @if (count($questions) > 0)
                    <table class="table">
                        <thead>
                            <th scope="col">Sr #</th>
                            <th scope="col">Question</th>
                            @if (checkPermissions('questions', 2))
                                <th scope="col">Actions</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($questions as $q)
                                <tr>
                                    <td>{!! $q->id !!}</td>
                                    <td>{!! $q->question !!}</td>

                                    @if (checkPermissions('questions', 2))
                                        <td>
                                            <a class="btn btn-primary float-left ml-1" href="{{ url('questions/' . $q->id) }}/edit">Edit</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">No Questions Found</p>
                @endif

            </div>
        </div>
    </div>
@endsection
