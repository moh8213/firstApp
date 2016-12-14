<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\User;

class UserController extends Controller
{
    
    protected $userRepository;
    protected $nbrPerPage = 3;
 
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getPaginate($this->nbrPerPage); 
        return view('index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->userRepository->store($request->all()); 
        return redirect()->route('user.index')->withOk("L'utilisateur " . $user->name . " a été créé.");    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$user=User::where('id',$id)->first();
        //return view('show',  compact('user'));        
        $user=User::FindOrFail($id);
        return view('show',  ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$user=User::where('id',$id)->first();
        $user=User::FindOrFail($id);
        return view('edit',  compact('user'));
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
        //$user=User::where('id',$id)->first();
        $user=User::FindOrFail($id);
        $this->userRepository->update($user, $request->all());         
        return redirect()->route('user.index')->withOk("L'utilisateur " . $request->name . " a été modifié.");    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy($id)
    {
        //$user=User::where('id',$id)->first();
        $user=User::FindOrFail($id);
        $this->userRepository->destroy($user); 
        return back();
    }
}
