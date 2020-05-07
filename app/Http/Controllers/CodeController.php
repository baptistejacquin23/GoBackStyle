<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use League\CommonMark\Inline\Element\Code;

class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $listCode = \App\Code::all();

        return view('code.index', compact('listCode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return \view('code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $CodeToCreate = new \App\Code();
        $CodeToCreate->name = $request->input('name');
        $CodeToCreate->created_at = Carbon::now();
        $CodeToCreate->updated_at = Carbon::now();
        $CodeToCreate->save();
        return redirect()->route('list_code');
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
        $code_to_edit = \App\Code::find($id);

        return view("code.edit",compact("code_to_edit"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $code_to_update = \App\Code::find($id);
        $code_to_update->name = $request->input("name");
        $code_to_update->updated_at = Carbon::now();
        $code_to_update->save();

        return redirect()->route('list_code');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        \App\Code::destroy($id);

        return redirect()->route('list_code');
    }
}
