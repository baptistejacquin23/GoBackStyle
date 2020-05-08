@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Edit promotion " {{$promotion_to_edit->discount}} "</h1>
        <br>
        <form class="form-horizontal" method="post" action="{{route("update_promotion", [$promotion_to_edit->id])}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset>

                <!-- Text input-->
                <div class="form-group">
                    <label class=" control-label" for="discount">Discount</label>
                    <div>
                        <input id="discount" name="discount" type="text" placeholder="discount"
                               class="form-control input-md" required="" value="{{$promotion_to_edit->discount}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="description">Description</label>
                    <div>
                        <input id="description" name="description" type="text" placeholder="description"
                               class="form-control input-md" required="" value="{{$promotion_to_edit->description}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="link">Website Link</label>
                    <div>
                        <input id="link" name="link" type="text" placeholder="link"
                               class="form-control input-md" required="" value="{{$promotion_to_edit->link}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="imagePath">Image</label>
                    <div>
                        <input type="file"
                               id="imagePath" name="imagePath"
                               accept="image/png, image/jpeg" data-input="false" value="{{URL::asset('/images/'.$promotion_to_edit->image_path)}}">
                        <img src="{{URL::asset('/images/'.$promotion_to_edit->image_path)}}" width="100px" height="50px">

                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="start_date">Date Begin promotion</label>
                    <div>
                        <input class="form-control input-md" id="start_date" type="date" name="start_date" required
                               value="{{$promotion_to_edit->validate_start_date}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class=" control-label" for="end_date">Date End promotion</label>
                    <div>
                        <input class="form-control input-md" id="end_date" type="date" name="end_date" required
                               value="{{$promotion_to_edit->validate_end_date}}">
                    </div>
                </div>
                <!-- Select Basic -->
                <div class="form-group">
                    <label class="control-label" for="code">belongs to code</label>
                    <div>
                        <select id="code" name="code" class="form-control smartSelect" required>
                            <option selected disabled>Choose a code</option>
                            @foreach($list_code as $code)
                                @if($code->id == $promotion_to_edit->code_id)
                                    <option value="{{$code->id}}" selected>{{$code->name}}</option>
                                @else
                                    <option value="{{$code->id}}">{{$code->name}}</option>
                                @endif
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
