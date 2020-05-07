@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Create a code </h1>
        <br>
        <form class="form-horizontal" method="post" action="{{route('store_code')}}">
            {{ csrf_field() }}
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="name">Code name</label>
                    <div>
                        <input id="name" name="name" type="text" placeholder="Name"
                               class="form-control input-md" required="">
                    </div>
                </div>
                <div class="container text-center">
                    <button type="submit" class="btn btn-success ">Submit</button>
                    <a href="{{route("list_code")}}" class="btn btn-warning">Cancel</a>
                </div>
            </fieldset>
        </form>
    </div>

@endsection
