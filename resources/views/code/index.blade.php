@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Code list</h1>
        <br>
        <a href="{{route("create_code")}}" class="btn btn-success"> Create code</a><br><br>

        <table id="myTable" class="table text-center">
            <thead class="table-dark">
            <td> Nom</td>
            <td class="not-searchable"> Edit</td>
            <td class="not-searchable"> Delete</td>

            </thead>
            <tbody>
            @foreach( $listCode as $code)
                <tr>
                    <td>{{$code->name}}</td>
                    <td><a href="{{route('edit_code',  [$code->id])}}" class="btn btn-warning">Edit</a></td>
                    <td><!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{$code->id}}">
                            Delete
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$code->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to whant delete the code {{$code->name}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                        </button>
                                        <form method="post" action="{{route('destroy_code',[$code->id])}}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
