<?php

namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Document::all();
    }

    /**
     * Store new document
     */
    public function store (Request $request) {

        $path = "demo path"; //custom path
        $data = [
            "title" => $request->title,
            "path"  => $path,
            "content" => $request->content
        ];

        $document = Document::create($data);

        return response()->json(["data" => $document], 201);
    }

    public function show (Document $document) {
        return response(['data' => $document], 200);
    }

    public function update (Request $request, Document $document) {
        $document->update([
            "title" => $request->title,
            "content" => $request->content
        ]);
        return response(['data' => $document], 200);
    }
  
}
