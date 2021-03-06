<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::patient()->paginate(5);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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
                'role' => 'patient',
                'password' => bcrypt($request->get('password'))
            ]
        );

        $notification = 'El paciente se ha registrado correctamente';
        return redirect('/patient')->with(compact('notification'));
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
        $patient = User::patient()->findOrFail($id);
        return view('patients.edit', compact('patient'));
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
        $user = User::patient()->findOrFail($id);
        $data = $request->only('name','email','cedula','address','phone');
        $password = $request->get('password');
        if($password){
           $data['password'] = bcrypt($password);
        }
        $user->fill($data);
        $user->save();

        $notification = 'El paciente se ha actualizado correctamente';
        return redirect('/patient')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = "El médico $patientName se ha eliminado correctamente";
        return redirect('/patient')->with(compact('notification'));
    }
}
