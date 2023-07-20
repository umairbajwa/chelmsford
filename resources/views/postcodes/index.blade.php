@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('inc.internalNav')
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Postcodes</h2>
                    </div>

                    @if (checkPermissions('postcodes', 2))
                        <div class="col-auto">
                            <a href="{{ url('postcodes/create') }}" class="btn btn-primary">Create</a>
                        </div>
                    @endif
                </div>

                @if (count($postcodes) > 0)
                    <table class="table">
                        <thead>
                            <th scope="col">Sr #</th>
                            <th scope="col">Postcode</th>
                            <th scope="col">Quotes</th>
                            <th scope="col">Boiler</th>
                            @if (checkPermissions('postcodes', 2))
                                <th scope="col">Actions</th>
                            @endif
                        </thead>
                        <tbody>
                            @foreach ($postcodes as $key => $p)
                                <tr>
                                    <td>{!! $key + 1 !!}</td>
                                    <td>{!! $p->name !!}</td>
                                    <td>
                                        @if ($p->quotes)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->boiler)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    @if (checkPermissions('postcodes', 2))
                                        <td>
                                            <form action="{{ url('/postcodes', ['id' => $p->id]) }}" method="post">
                                                <input class="btn btn-danger ml-1" type="submit" value="Delete" />
                                                @method('delete')
                                                @csrf
                                                <a class="btn btn-primary float-left ml-1" href="{{ url('postcodes/' . $p->id . '/edit') }}">Edit</a>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="alert alert-danger">No Products Found</p>
                @endif

            </div>
        </div>
    </div>
@endsection
