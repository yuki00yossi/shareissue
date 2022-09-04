<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::all();
        return view('projects.index', ['projects'=> $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
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
        $request->validate([
            'name'=> ['required', 'max:255'],
        ]);

        $result = Project::create([
            'name'=> $request->name,
        ]);
        return redirect(route('projects.index'))->with('added', sprintf('プロジェクト：%s を追加しました。', $result->name));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        return view('projects.show', ['project'=> $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        return view('projects.edit', ['project'=> $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $request->validate([
            'name'=> ['required',],
        ]);
        $project->name = $request->name;
        $project->save();
        return redirect(route('projects.show', $project->id))->with('nameEdited', 'プロジェクト名を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function addMember(Project $project) {
        $users = User::all();
        return view('projects.add-member', ['project'=> $project, 'users'=> $users]);
    }

    public function storeMember(Request $request, Project $project) {
        $request->validate([
            'user'=> ['required'],
        ]);

        $member = ProjectUser::where('user_id', $request->user)->where('project_id', $project->id)->get();
        $adduser = User::find($request->user);
        if ($member->isEmpty()) {
            // 未登録の場合は登録する
            $result = ProjectUser::create([
                'user_id'=> $adduser->id,
                'project_id'=> $project->id,
            ]);
            return redirect(route('projects.show', $project->id))->with('memberAdded', sprintf('%sさんをメンバー追加しました。', $adduser->name));
        }
        else {
            return redirect(route('projects.addMember', $project->id))->with('alreadyStored', sprintf('%sさんは既に%sに登録されています。', $adduser->name, $project->name));
        }
    }
}
