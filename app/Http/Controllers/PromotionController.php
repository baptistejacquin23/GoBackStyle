<?php

namespace App\Http\Controllers;

use App\Code;
use App\Promotion;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $list_promotion = Promotion::all();

        return view('promotion.index', compact('list_promotion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $list_code = Code::all();
        return \view('promotion.create',compact('list_code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $promotion_to_store = new Promotion();

        $promotion_to_store->discount = $request->input('discount');
        $promotion_to_store->description = $request->input('description');
        $promotion_to_store->link = $request->input('link');

        $file = $request->file('imagePath');
        $originalName = $file->getClientOriginalName();
        $img = Image::make($file->getRealPath())->resize(500,200);
        $img->stream();
        Storage::disk('public')->put('/'.$originalName, $img);

        $promotion_to_store->image_path = $originalName;
        $promotion_to_store->validate_start_date = $request->input('start_date');
        $promotion_to_store->validate_end_date = $request->input('end_date');
        $promotion_to_store->code_id = $request->input('code');
        $promotion_to_store->created_at = Carbon::now();
        $promotion_to_store->updated_at = Carbon::now();

        $promotion_to_store->save();

        return redirect(route('list_promotion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $promotion_to_edit = Promotion::find($id);
        $list_code = Code::all();

        return \view("promotion.edit",compact("promotion_to_edit","list_code"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $promotion_to_update = Promotion::find($id);

        $promotion_to_update->discount = $request->input('discount');
        $promotion_to_update->description = $request->input('description');
        $promotion_to_update->link = $request->input('link');

        if ($request->file('imagePath') != null ){
            $file = $request->file('imagePath');
            $originalName = $file->getClientOriginalName();
            $img = Image::make($file->getRealPath())->resize(500,200);
            $img->stream();
            Storage::disk('public')->put('/'.$originalName, $img);

            $promotion_to_update->image_path = $originalName;
        }

        $promotion_to_update->validate_start_date = $request->input('start_date');
        $promotion_to_update->validate_end_date = $request->input('end_date');
        $promotion_to_update->code_id = $request->input('code');
        $promotion_to_update->updated_at = Carbon::now();

        $promotion_to_update->save();

        return redirect(route('list_promotion'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        Promotion::destroy($id);

        return redirect(route('list_promotion'));
    }
}
