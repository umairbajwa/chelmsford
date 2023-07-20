<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use Auth;
use Image;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Questions::orderBy('order', 'ASC')->orderBy('id', 'ASC')->get();
        return view('questions.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
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
            'question' => 'required',
            'option' => 'required'
        ]);
        $image = NULL;
        $option = $request->input('option');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //Get file with extension
            $fileNameWithExt = $image->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $image->getClientOriginalExtension();
            //FileName to store
            $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

            $img = Image::make($image)->orientate();
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/options/sales-images/' . $imageFileToStore, 80, 'png');
            $image = $imageFileToStore;
        }
        foreach ($option as $k => $o) {

            $imageFileToStore = '';
            if ($request->hasFile('option.' . $k . '.image')) {
                $image = $request->file('option.' . $k . '.image');
                //Get file with extension
                $fileNameWithExt = $image->getClientOriginalName();
                //Get Just File Name
                $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $fileNameExt = $image->getClientOriginalExtension();
                //FileName to store
                $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
                $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

                $img = Image::make($image)->orientate();
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('storage/options/zoom-images/' . $imageFileToStore, 80, 'png');
            }

            $option[$k]['zoom-image'] = $imageFileToStore;
        }

        $q = new Questions;
        $q->account_id = Auth::user()->account_id;
        $q->user_id = Auth::user()->id;
        $q->question = $request->input('question');
        $q->options = serialize($option);
        $q->image = $image;
        $q->selling_point = $request->input('sales');
        $q->save();


        return redirect('/questions')->with("success", "Question added successfully !");
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Questions::find($id);
        return view('questions.edit')->with('question', $question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question' => 'required',
            'option' => 'required'
        ]);
        $q = Questions::find($id);
        $option = $request->input('option');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            //Get file with extension
            $fileNameWithExt = $image->getClientOriginalName();
            //Get Just File Name
            $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $fileNameExt = $image->getClientOriginalExtension();
            //FileName to store
            $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
            $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

            $img = Image::make($image)->orientate();
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save('storage/options/sales-images/' . $imageFileToStore, 80, 'png');
            $q->image = $imageFileToStore;
        }
        foreach ($option as $k => $o) {

            $imageFileToStore = '';
            if ($request->hasFile('option.' . $k . '.image')) {
                $image = $request->file('option.' . $k . '.image');
                //Get file with extension
                $fileNameWithExt = $image->getClientOriginalName();
                //Get Just File Name
                $fileName =  pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //Get just extension
                $fileNameExt = $image->getClientOriginalExtension();
                //FileName to store
                $imageFileToStore = $fileName . '_' . time() . '.' . $fileNameExt;
                $imageFileToStore = str_replace(' ', '_', $imageFileToStore);

                $img = Image::make($image)->orientate();
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save('storage/options/zoom-images/' . $imageFileToStore, 80, 'png');
                $option[$k]['zoom-image'] = $imageFileToStore;
            } else {
                $option[$k]['zoom-image'] = isset(unserialize($q->options)[$k]['zoom-image']) ? unserialize($q->options)[$k]['zoom-image'] : NULL;
            }
        }

        $q->question = $request->input('question');
        $q->selling_point = $request->input('sales');
        $q->options = serialize($option);
        $q->save();

        if ($request->next == '1' && Questions::whereId($q->id + 1)->exists()) {
            return redirect("/questions/" . ($q->id + 1) . "/edit")->with("success", "Question updated successfully !");
        }
        return redirect('/questions')->with("success", "Question updated successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function newOption($x)
    {
        return view('questions.formoption')->with('x', $x);
    }
}
