<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('create-class')) {
            return Inertia::render('ClassList', ['subjects' => fn () => Subject::with('users')->latest()->paginate(2)]);
        } else {
            return Inertia::render('ClassList', ['subjects' => fn () => Subject::latest()->paginate(2)]);
        }
    }

    public function index_cr()
    {
        auth()->user()->load('subjects.users');

        return Inertia::render('ClassesRegistered', ['subjects' => fn () => auth()->user()->subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('CreateClass', ['dusk' => 'create-class']);
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

        if (!Gate::allows('create-class')) {   // Illuminate/Support/Facades/Gate
            abort(403);
        }

        $request->validate(['name' => 'required', 'description' => 'required', 'credit' => 'required|numeric']);
        // dd($request->description);
        // Subject::create(
        //                 [
        //                     'name' => $request->name,
        //                     'description'=>$request->description,
        //                     'credit' =>$request->credit,
        //                 ]);

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->credit = $request->credit;
        $subject->save();
        // dd('hi3');
        return Redirect::route('classes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $subject = Subject::find($id);
        // return Inertia::render('ShowClass', ['subject' => $subject]);

        // Partial reloads를 고려해 아래와 같이 수정한다. 
        // 로그인한 사용자가 $id에 해당하는 과목을 이미 수강신청했는지 여부도 함께 전달한다.
        return Inertia::render(
            'ShowClass',
            [
                'subject' => fn () => Subject::find($id),
                'registeredClass' => fn () => auth()->user()->subjects->contains($id),
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate(['name' => 'required', 'description' => 'required', 'credit' => 'required|numeric']);
        $subject = Subject::find($id);

        $subject->name = $request->name;
        $subject->credit = $request->credit;
        $subject->description = $request->description;

        $subject->save();

        return Redirect::route('classes.show', ['classId' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);

        $subject->delete();

        return Redirect::route('classes');
    }

    public function register($id)
    {
        // subject_user 테이블에 [auth()->user()->id, $id] 레코드가 있으면 삭제, 없으면 삽입.
        auth()->user()->subjects()->toggle($id);

        return Redirect::route('classes.show', ['classId' => $id]);
    }

    public function users($id)
    {
        // $subject = Subject::find($id);

        // dd(Subject::find($id)->users()->paginate(2));

        if (!Gate::allows('view-registerred-users')) {
            abort(403);
        }

        return Inertia::render(
            'ClassUsers',
            ['users' => fn () => Subject::find($id)->users()->paginate(2)]
        );
    }
}
