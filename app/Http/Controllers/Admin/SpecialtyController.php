<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Specialty;

use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    public function index(){
        $specialties = Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create(){
        return view('specialties.create');
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required|min:3',
        ];

        $this->validate($request, $rules);

        $specialty = new Specialty();
        $specialty->name = $request->get('name');
        $specialty->description = $request->get('description');
        $specialty->save();

        $notification = 'La especialidad se registro correctamente.';
        return redirect('/specialty')->with(compact('notification'));
    }

    /* public function edit($id){
        $specialty = Specialty::findOrFail($id);
        return view('specialties.edit', compact('specialty'));
    } */
    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, $id){
        $rules = [
            'name' => 'required|min:3',
        ];

        $this->validate($request, $rules);

        $specialty = Specialty::findOrFail($id);
        $specialty->name = $request->get('name');
        $specialty->description = $request->get('description');
        $specialty->save();

        $notification = 'La especialidad se actualizo correctamente.';
        return redirect('/specialty')->with(compact('notification'));
    }

    /* public function destroy($id){
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();

        return redirect('/specialty');
    } */
    public function destroy(Specialty $specialty){
        $deleteSpecialty = $specialty->name;
        $specialty->delete();

        $notification = 'La especialidad '.$deleteSpecialty.' se elimino correctamente.';
        return redirect('/specialty')->with(compact('notification'));
    }
}
