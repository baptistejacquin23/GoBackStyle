@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Modification du code " {{$code_to_edit->name}} "</h1>
        <br>
        <form class="form-horizontal" method="post" action="{{route('update_code',  [$code_to_edit->id])}}">
            {{ csrf_field() }}
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="name">Nom du Code </label>
                    <div>
                        <input id="name" name="name" type="text" placeholder="Nom"
                               class="form-control input-md" required="" value="{{$code_to_edit->name}}">
                    </div>
                </div>
                <div class="container text-center">
                    <button type="submit" class="btn btn-success ">Valider</button>
                    <a href="{{route("list_code")}}" class="btn btn-warning">Annuler</a>
                </div>
            </fieldset>
        </form>
    </div>

@endsection
