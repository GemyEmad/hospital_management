<?php

namespace App\View\Components\Appointments;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Section;
use Illuminate\View\Component;

class Create extends Component
{
    public $doctors;
    public $sections;
    public $doctor;
    public $section;
    public $name;
    public $email;
    public $phone;
    public $notes;
    public $message= false;

    public function mount(){

      $this->sections = Section::get();
      $this->doctors = collect();

    }

    public function render()
    {
        return view('components.appointments.create',
            [
                'sections' => Section::get()
            ]);
    }

    public function updatedSection($section_id){

       $this->doctors = Doctor::where('section_id',$section_id)->get();
    }

    public function store(){

        $appointments = new Appointment();
        $appointments->doctor_id = $this->doctor;
        $appointments->section_id = $this->section;
        $appointments->name = $this->name;
        $appointments->email = $this->email;
        $appointments->phone = $this->phone;
        $appointments->notes = $this->notes;
        $appointments->save();
        $this->message =true;

    }



}