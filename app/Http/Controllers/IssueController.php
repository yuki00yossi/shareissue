<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    const STATUS = [
        0=> '未検討',
        1=> '検討中',
        2=> '対応中',
        3=> '対応済み',
        4=> '対応なし',
        5=> '連携済み',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usre = Auth::user();
        $belong_projects = array();
        foreach (Auth::user()->projects as $project) {
            $belong_projects[] = $project->id;
        }
        $issues = Issue::whereIn('project_id', $belong_projects)
            ->where('status', '<>', 4)
            ->where('status', '<>', 5)->get();

        return view('dashboard', ['issues'=> $issues, 'status'=> $this::STATUS]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $projects = Project::whereRelation('users', 'user_id', Auth::id())->get();
        $param = [
            'users'=> $users,
            'status'=> $this::STATUS,
            'projects'=> $projects,
        ];
        return view('issues.create', $param);
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
            'title'=> ['required'],
        ]);

        if ($request->responsible_user == "null") {
            $resopnsible_user = null;
        }
        else {
            $resopnsible_user = $request->responsible_user;
        }
        

        $result = Issue::create([
            'title'=> $request->title,
            'detail'=> $request->detail,
            'assign_user_id'=> Auth::id(),
            'responsible_user_id'=> $resopnsible_user,
            'timelimit'=> $request->timelimit,
            'status'=> $request->status,
            'project_id'=> $request->project,
        ]);
        return redirect(route('dashboard'))->with('added', 'Issueを登録しました。');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
        return view('issues.show', ['issue'=> $issue, 'status'=> $this::STATUS[$issue->status]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
