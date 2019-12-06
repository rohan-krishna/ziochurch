<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $entries = Entry::paginate();
        return view('entries.index', compact('entries'));
    }


    public function search(Request $request)
    {
        $message = "UID Search";
        $entries = Entry::all();
        # code...
        if(!$request->filled('search_query')) {
            return $entries;
        }

        if($request->entry_type == "uid") {

            $entries = Entry::where("uid","like", $request->search_query."%")->get();
            return $entries;
        }

        if($request->entry_type == "title") {
            $entries = Entry::where("title", "like", "%".$request->search_query."%")->get();
            return $entries;
        }

        return $entries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::transaction(function() use($request) {

            $entry = Entry::create(array_merge($request->except('files'), ['created_by' => auth()->user()->id]));
    
            if($request->hasFile('files')) {
                // dd($request->files);
                $files = $request->file('files');

                foreach($files as $file) {
                    $entry->addMedia($file)->toMediaCollection();
                }
            }

        });
        

        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
        return view('entries.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
