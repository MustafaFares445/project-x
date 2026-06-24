<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;

class ContentController extends Controller
{
    public function index()
    {
        return ContentResource::collection(Content::with('media')->get());
    }

    public function store(ContentRequest $request)
    {
        $content = Content::create($request->validated());

        foreach ($request->file('files') as $file) {
            $content->addMedia($file)->toMediaCollection('files');
        }

        return ContentResource::make($content->load('media'))->response();
    }

    public function show(Content $content)
    {
        return new ContentResource($content->load('media'));
    }

    public function update(ContentRequest $request, Content $content)
    {
        $content->update($request->validated());

        if ($request->hasFile('files')) {
            $content->deleteCollection('files');
            foreach ($request->file('files') as $file) {
                $content->addMedia($file)->toMediaCollection('files');
            }
        }

        return new ContentResource($content->load('media'))->response();
    }

    public function destroy(Content $content)
    {
        $content->delete();

        return response()->json();
    }
}
