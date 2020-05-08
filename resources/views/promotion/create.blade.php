@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Create Promotion</h1>
        <br>
        <form class="form-horizontal" method="post" action="{{route("store_promotion")}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="discount">Discount</label>
                    <div>
                        <input id="discount" name="discount" type="text" placeholder="discount"
                               class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="description">Description</label>
                    <div>
                        <input id="description" name="description" type="text" placeholder="description"
                               class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="link">Website Link</label>
                    <div>
                        <input id="link" name="link" type="text" placeholder="link"
                               class="form-control input-md" required="">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="imagePath">Image</label>
                    <div>
                        <input type="file"
                               id="imagePath" name="imagePath"
                               accept="image/png, image/jpeg" data-input="false" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="start_date">Date Begin promotion</label>
                    <div>
                        <input class="form-control input-md" id="start_date" type="date" name="start_date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="end_date">Date End promotion</label>
                    <div>
                        <input class="form-control input-md" id="end_date" type="date" name="end_date" required>
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="control-label" for="code">belongs to code</label>
                    <div>
                        <select id="code" name="code" class="form-control smartSelect" required>
                            <option selected disabled>Choose a code</option>
                            @foreach($list_code as $code)
                                <option value="{{$code->id}}">{{$code->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="container text-center">
                    <button type="submit" class="btn btn-success ">Submit</button>
                    <a href="{{route('list_promotion')}}" class="btn btn-warning">Cancel</a>
                </div>

            </fieldset>
        </form>
    </div>

@endsection
