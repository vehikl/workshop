<?php

namespace App\Http\Controllers;

use App\Models\TodoListItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TodoListItemController extends Controller
{

    public function index(): JsonResponse
    {
        return Response::json(TodoListItem::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        TodoListItem::query()->create(["description" => $request->description]);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TodoListItem $todoListItem
     * @return \Illuminate\Http\Response
     */
    public function show(TodoListItem $todoListItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TodoListItem $todoListItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoListItem $todoListItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TodoListItem $todoListItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoListItem $todoListItem)
    {
        //
    }
}
