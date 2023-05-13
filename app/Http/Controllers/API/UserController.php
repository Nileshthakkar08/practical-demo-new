<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hobbies;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponseTrait;
use Validator;
use App\Http\Traits\ImageUploadTrait;

class UserController extends Controller
{
    use ApiResponseTrait,ImageUploadTrait;

    public function index()
    {

        $usersList = User::getUsersList();

        if ($usersList) {
            return $this->sendResponse($usersList, 'Users List');
        } else {
            return $this->sendError('Product Data Not Found', $this->notFoundStatus);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'profile_photo' => 'required',
            'hobbies' => 'required',
            'gender' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->all()[0], $this->validationStatus);
        }
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

        return $this->sendResponse($user, 'User Created Successfully.');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'profile_photo' => 'required',
            'hobbies' => 'required',
            'gender' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->all()[0], $this->validationStatus);
        }
        $data = $request->except(['_method','hobbies']);
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

        return $this->sendResponse($user, 'User Updated Successfully.');
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
            return $this->sendResponse($user, 'User Deleted Successfully.');
        }
        return $this->sendResponse($user, 'Something went wrong');
    }
}
