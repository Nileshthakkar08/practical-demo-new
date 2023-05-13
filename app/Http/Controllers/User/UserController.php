<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Cities;
use App\Models\Hobbies;
use App\Models\States;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        $users = User::getUsersList();
        // dd($users);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = States::getStates();
        return view('user.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $data = $request->except('hobbies');
        if ($request->profile_photo) {
            $file = $request->file('profile_photo');

            $image = $this->uploadImage($file, 'users');
        }
        $data['profile_photo'] = $image;
        $user = User::create($data);

        if ($request->hobbies) {
            foreach ($request->hobbies as $hobbies) {
                $hobbiesArr = [
                    'user_id' => $user->id,
                    'name' => $hobbies,
                ];
                Hobbies::create($hobbiesArr);
            }
        }
        return to_route('user.index');
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
        $user = User::getById($id);
        $states = States::getStates();
        return view('user.edit', compact('user', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $data = $request->except('hobbies');
        $user = User::getById($id);
        $image = $user->profile_photo ?? '';
        if ($request->profile_photo) {
            $file = $request->file('profile_photo');
            $image = $this->uploadImage($file, 'users');
        }

        $data['profile_photo'] = $image;
        $user->update($data);

        if ($request->hobbies) {
            Hobbies::where('user_id', $id)->delete();
            foreach ($request->hobbies as $hobbies) {
                $hobbiesArr = [
                    'user_id' => $user->id,
                    'name' => $hobbies,
                ];
                Hobbies::create($hobbiesArr);
            }
        }
        return to_route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::getById($id);
        if ($user != null) {
            $user->delete();
        }
        return to_route('user.index');
    }

    public function getCities(Request $request)
    {
        $cities = Cities::getCities($request->state_id);
        return response()->json(['cities' => $cities]);
    }
}
