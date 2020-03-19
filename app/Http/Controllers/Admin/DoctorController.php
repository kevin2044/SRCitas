<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = User::doctor()->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'digits:8|nullable',
            'address' => 'min:5|nullable',
            'phone' => 'min:6|nullable',
        ];
        $this->validate($request, $rules);
        /* $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->cedula = $request->get('cedula');
        $doctor->address = $request->get('address');
        $doctor->phone = $request->get('phone');
        $doctor->save(); */
        User::create(
            $request->only('name','email','cedula','address','phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->get('password'))
            ]
        );

        $notification = 'El médico se ha registrado correctamente';
        return redirect('/doctor')->with(compact('notification'));
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
        $doctor = User::doctor()->findOrFail($id);
        return view('doctors.edit', compact('doctor'));
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
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'digits:8|nullable',
            'address' => 'min:5|nullable',
            'phone' => 'min:6|nullable',
        ];
        $this->validate($request, $rules);
        /* $doctor = new Doctor();
        $doctor->name = $request->get('name');
        $doctor->email = $request->get('email');
        $doctor->cedula = $request->get('cedula');
        $doctor->address = $request->get('address');
        $doctor->phone = $request->get('phone');
        $doctor->save(); */
        $user = User::doctor()->findOrFail($id);
        $data = $request->only('name','email','cedula','address','phone');
        $password = $request->get('password');
        if($password){
           $data['password'] = bcrypt($password);
        }
        $user->fill($data);
        $user->save();

        $notification = 'El médico se ha actualizado correctamente';
        return redirect('/doctor')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();

        $notification = "El médico $doctorName se ha eliminado correctamente";
        return redirect('/doctor')->with(compact('notification'));
    }
}
