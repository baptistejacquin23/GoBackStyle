@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Promotions list</h1>
        <br>
        <a href="{{route("create_promotion")}}" class="btn btn-success"> Create promotion</a><br><br>

        <table id="myTable" class="table text-center">
            <thead class="table-dark">
            <td>Discount</td>
            <td>Description</td>
            <td>Link</td>
            <td>image path</td>
            <td>Validate_start_date</td>
            <td>Validate_end_date</td>
            <td>Code</td>
            <td class="not-searchable"> Modiffy</td>
            <td class="not-searchable"> Delete</td>

            </thead>
            <tbody>
            @foreach( $list_promotion as $promotion)
                <tr>
                    <td>{{$promotion->discount}}</td>
                    <td>{{$promotion->description}}</td>
                    <td>{{$promotion->link}}</td>
                    <td>{{$promotion->image_path}}</td>
                    <td>{{$promotion->validate_start_date}}</td>
                    <td>{{$promotion->validate_end_date}}</td>
                    <td>{{$promotion->code->name}}</td>
                    <td>
                        <a href="{{route('edit_promotion',[$promotion->id])}}" class="btn btn-warning">Modifier</a></td>
                    <td><!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#exampleModal{{$promotion->id}}">
                            Supprimer
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$promotion->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to want delete promotion " {{$promotion->discount}} " ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                        </button>
                                        <form method="post" action="{{route('destroy_promotion',[$promotion->id])}}">
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
