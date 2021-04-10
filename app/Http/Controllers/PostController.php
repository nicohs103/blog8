<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\DataTableBase;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables as DataTables;
use Carbon\Carbon;
use Laracasts\Flash\Flash as Flash;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index');
    }

    public function getPostsDatatable(Request $request)
    {
        $posts = Post::where('created_by', Auth::id())->get();

        $dataTable = DataTables::of($posts);

        $dataTable->editColumn('description', function ($post) {
            $max = 50;
            $string = substr($post['description'], 0, $max);

            return $string . '...';
        });

        $dataTable->editColumn('publication_date', function ($post) {
            if ($post->publication_date) {
                return Carbon::create($post->publication_date)->format('d-m-Y H:m:s');
            }

            return '';
        });

        return $dataTable->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = new Post;
        $post->title = ucfirst($request->title);
        $post->description = $request->description;
        $post->publication_date = Carbon::now();
        $post->created_by = Auth::id();
        $post->save();

        Flash::success(trans('app.created_successfully'));

        return redirect(url('admin/post'));
    }
}
