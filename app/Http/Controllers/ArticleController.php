<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ArticleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view Articles', only: ['index']),
            new Middleware('permission:edit Articles', only: ['edit']),
            new Middleware('permission:create Articles', only: ['create']),
            new Middleware('permission:delete Articles', only: ['destroy']),
        ];
    }
    public function index()
    {
        $articles = Article::latest()->paginate(5);
        return view('role-permission.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:articles,title',

            'author' => 'required|string|max:255', // Author validation
        ]);

        // Check if validation passed and data is being handled properly
        if ($validator->passes()) {
            $article =  new Article();
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

            return redirect()->route('articles.index')->with('success', 'Article created successfully.');
        } else {
            return redirect()->route('articles.create')->withInput()->withErrors($validator);
        }
    }


    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('role-permission.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:articles,title',
            'author' => 'required|string|max:255', // Author validation
        ]);

        // Check if validation passed and data is being handled properly
        if ($validator->passes()) {
            $article->title = $request->title;
            $article->text = $request->text;
            $article->author = $request->author;
            $article->save();

            return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
        } else {
            return redirect()->route('articles.edit', $id)->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the article by id
        $article = Article::findOrFail($id);

        // Delete the article
        $article->delete();

        // Redirect back with a success message
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }
}