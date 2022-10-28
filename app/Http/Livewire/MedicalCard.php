<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Models\User as ModelsUser;
use Livewire\WithPagination;
use App\Models\MedicalCard as ModelsMedicalCard;
use Illuminate\Support\Facades\Session;

class MedicalCard extends Component
{
    use WithPagination;

    public $patient;
    public $patient_id;
    public $others = false;
    public $diabetes = false;
    public $asthma = false;
    public $physical_disability = false;
    public $alergic = false;
    public $special_diet = false;
    public $skin_condition = false;
    public $heart_condition = false;
    public $tetanus_serum = false;
    public $tetanus_vaccine = false;
    public $special_treatment = false;

    public $urgency_contact1_full_name, $urgency_contact1_address, $urgency_contact1_phone;
    public $urgency_contact2_full_name, $urgency_contact2_address, $urgency_contact2_phone;
    public $treating_doctor_name, $treating_doctor_address, $treating_doctor_phone;
    public $others_precision, $gravity_frequency, $alergy_precision;
    public $special_diet_precision, $special_medical_treatment;
    public $tetanus_vaccine_date, $tetanus_serum_date, $blood_group, $Rhesus, $possible_remarks;

    protected $paginationTheme = 'bootstrap';

       public function mount()
    {
        $patient_id = Route::current()->parameter('patient_id');
        $this->patient_id = $patient_id;
    }


    public function updatingSearch()

    {
        $this->resetPage();
    }

    // public $hospitals;
    public function toggleProperties($property)
    {
        if($property == 'diabetes')
        {
            $this->diabetes = !$this->diabetes;
        }
        elseif($property == 'asthma')
        {
            $this->asthma = !$this->asthma;
        }
        elseif($property == 'alergic')
        {
            $this->alergic = !$this->alergic;
        }
        elseif($property == 'heart_condition')
        {
            $this->heart_condition = !$this->heart_condition;
        }
        elseif($property == 'skin_condition')
        {
            $this->skin_condition = !$this->skin_condition;
        }
        elseif($property == 'others')
        {
            $this->others = !$this->others;
        }
        elseif($property == 'tetanus_vaccine')
        {
            $this->tetanus_vaccine = !$this->tetanus_vaccine;
        }
        elseif($property == 'tetanus_serum')
        {
            $this->tetanus_serum = !$this->tetanus_serum;
        }
        elseif($property == 'special_diet')
        {
            $this->special_diet = !$this->special_diet;
        }
        elseif($property == 'special_treatment')
        {
            $this->special_treatment = !$this->special_treatment;
        }
        elseif($property == 'physical_disability')
        {
            $this->physical_disability = !$this->physical_disability;
        }
    }

    public function rules()
    {
        return [
            'urgency_contact1_full_name' => 'required|string',
            'urgency_contact1_address'  => 'required|string',
            'urgency_contact1_phone'    => 'required|digits:8',
            'urgency_contact2_full_name' => 'string',
            'urgency_contact2_address'  => 'string',
            'urgency_contact2_phone'    => 'digits:8',
            'treating_doctor_name'      => 'required|string',
            'treating_doctor_address'   => 'required|string',
            'treating_doctor_phone'     => 'required|digits:8',
            'others_precision'          => 'string',
            'gravity_frequency'         => 'string',
            'alergy_precision'          => 'string',
            'special_diet_precision'    => 'string',
            'special_medical_treatment' => 'string',
            'tetanus_vaccine_date'      => 'date',
            'tetanus_serum_date'        => 'date',
            'blood_group'               => 'string',
            'Rhesus'                    => 'string',
            'possible_remarks'          => 'string',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveMedicalCard()
    {
        $validatedData  = $this->validate();

        // dd($validatedData);
        $medicalCard    = ModelsMedicalCard::create([
            'user_id'                       => $this->patient_id,
            'urgency_contact1_full_name' => $validatedData['urgency_contact1_full_name'],
            'urgency_contact1_address'  => $validatedData['urgency_contact1_address'],
            'urgency_contact1_phone'    => $validatedData['urgency_contact1_phone'],
            'urgency_contact2_full_name' => $validatedData['urgency_contact2_full_name'],
            'urgency_contact2_address'  => $validatedData['urgency_contact2_address'],
            'urgency_contact2_phone'    => $validatedData['urgency_contact2_phone'],
            'treating_doctor_name'      => $validatedData['treating_doctor_name'],
            'treating_doctor_address'   => $validatedData['treating_doctor_address'],
            'treating_doctor_phone'     => $validatedData['treating_doctor_phone'],
            'diabetes'                  => $this->diabetes,
            'asthma'                    => $this->asthma,
            'heart_condition'           => $this->heart_condition,
            'alergic'                   => $this->alergic,
            'special_diet'              => $this->special_diet,
            'skin_condition'            => $this->skin_condition,
            'physical_disability'       => $this->physical_disability,
            'others'                    => $this->others,
            'tetanus_vaccine'           => $this->tetanus_vaccine,
            'tetanus_serum'             => $this->tetanus_serum,
            'special_treatment'         => $this->special_treatment,
            'blood_group'               => $validatedData['blood_group'],
            'Rhesus'                    => $validatedData['Rhesus'],
            'possible_remarks'          => $validatedData['possible_remarks'],
        ]);


        if($medicalCard) {
            if($this->others == true){
                $medicalCard->others_precision              = $validatedData['others_precision'];
                $medicalCard->gravity_frequency             = $validatedData['gravity_frequency'];
            }
            if($this->tetanus_serum == true){
                $medicalCard->tetanus_serum_date            = $validatedData['tetanus_serum_date'];
            }
            if($this->tetanus_vaccine == true){
                $medicalCard->tetanus_vaccine_date          = $validatedData['tetanus_vaccine_date'];
            }
            if($this->alergic == true){
                $medicalCard->alergy_precision              = $validatedData['alergy_precision'];
            }
            if($this->special_diet == true){
                $medicalCard->special_diet_precision        = $validatedData['special_diet_precision'];
            }
            if($this->special_treatment == true){
                $medicalCard->special_medical_treatment     = $validatedData['special_medical_treatment'];
            }

            $medicalCard->save();



            Session::flash('message', 'Fiche médicale archivée avec succès');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function updateMedicalCard()
    {
        $validatedData = $this->validate();

        $patient = ModelsUser::find($this->patient_id);

        $medicalCard = $patient->medicalCard->update([
            'urgency_contact1_full_name' => $validatedData['urgency_contact1_full_name'],
            'urgency_contact1_address'  => $validatedData['urgency_contact1_address'],
            'urgency_contact1_phone'    => $validatedData['urgency_contact1_phone'],
            'urgency_contact2_full_name' => $validatedData['urgency_contact2_full_name'],
            'urgency_contact2_address'  => $validatedData['urgency_contact2_address'],
            'urgency_contact2_phone'    => $validatedData['urgency_contact2_phone'],
            'treating_doctor_name'      => $validatedData['treating_doctor_name'],
            'treating_doctor_address'   => $validatedData['treating_doctor_address'],
            'treating_doctor_phone'     => $validatedData['treating_doctor_phone'],
            'diabetes'                  => $this->diabetes,
            'asthma'                    => $this->asthma,
            'heart_condition'           => $this->heart_condition,
            'skin_condition'            => $this->skin_condition,
            'physical_disability'       => $this->physical_disability,
            'others'                    => $this->others,
            'tetanus_vaccine'           => $this->tetanus_vaccine,
            'tetanus_serum'             => $this->tetanus_serum,
            'blood_group'               => $validatedData['blood_group'],
            'Rhesus'                    => $validatedData['Rhesus'],
            'possible_remarks'          => $validatedData['possible_remarks'],
        ]);


        if($medicalCard) {
            if($this->others == true){
                $medicalCard->others_precision      = $validatedData['others_precision'];
            }
            if($this->tetanus_serum == true){
                $medicalCard->tetanus_serum_date      = $validatedData['tetanus_serum_date'];
            }
            if($this->tetanus_vaccine == true){
                $medicalCard->tetanus_vaccine_date      = $validatedData['tetanus_vaccine_date'];
            }
            if($this->alergic == true){
                $medicalCard->alergy_precision      = $validatedData['alergy_precision'];
            }
            if($this->special_diet == true){
                $medicalCard->special_diet_precision      = $validatedData['special_diet_precision'];
            }
            if($this->special_treatment == true){
                $medicalCard->special_medical_treatment      = $validatedData['special_medical_treatment'];
            }



            $medicalCard->save();
        }

        Session::flash('message', 'Hopital mise à jour avec succès');
        $this->resetInputs();
    }

    public function editMedicalCard(int $patient_id)
    {
        // dd($hospital_id);

        $patient = ModelsUser::find($this->patient_id);
        $medicalCard = $patient->medicalCard->delete();

        // dd($hospital);

        if ($medicalCard) {
            $this->urgency_contact1_full_name = $medicalCard->urgency_contact1_full_name;
            $this->urgency_contact1_address = $medicalCard->urgency_contact1_address;
            $this->urgency_contact1_phone = $medicalCard->urgency_contact1_phone;
            $this->urgency_contact2_full_name = $medicalCard->urgency_contact2_full_name;
            $this->urgency_contact2_address = $medicalCard->urgency_contact2_address;
            $this->urgency_contact2_phone = $medicalCard->urgency_contact2_phone;
            $this->treating_doctor_name = $medicalCard->treating_doctor_name;
            $this->treating_doctor_address = $medicalCard->treating_doctor_address;
            $this->treating_doctor_phone = $medicalCard->treating_doctor_phone;
            $this->diabetes = $medicalCard->diabetes;
            $this->asthma = $medicalCard->asthma;
            $this->heart_condition = $medicalCard->heart_condition;
            $this->skin_condition = $medicalCard->skin_condition;
            $this->physical_disability = $medicalCard->physical_disability;
            $this->others = $medicalCard->others;
            $this->others_precision = $medicalCard->others_precision;
            $this->gravity_frequency = $medicalCard->gravity_frequency;
            $this->alergic = $medicalCard->alergic;
            $this->alergy_precision = $medicalCard->alergy_precision;
            $this->special_diet = $medicalCard->special_diet;
            $this->special_diet_precision = $medicalCard->special_diet_precision;
            $this->special_medical_treatment = $medicalCard->special_medical_treatment;
            $this->tetanus_vaccine = $medicalCard->tetanus_vaccinelse;
            $this->tetanus_vaccine_date = $medicalCard->tetanus_vaccine_date;
            $this->tetanus_serum = $medicalCard->tetanus_serum;
            $this->tetanus_serum_date = $medicalCard->tetanus_serum_date;
            $this->blood_group = $medicalCard->blood_group;
            $this->Rhesus = $medicalCard->Rhesus;
            $this->possible_remarks = $medicalCard->possible_remarks;

        } else {
            return redirect()->to("/patients/fichemedicale/".$patient_id);
        }

    }

    public function destroyMedicalCard()
    {

        $patient = ModelsUser::find($this->patient_id);
        $medicalCard = $patient->medicalCard->delete();

        // dd($hospital);
        Session::flash('message', 'Fiche médicale supprimé avec succès');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteMedicalCard(int $patient_id)
    {
        $this->patient_id = $patient_id;
    }

    public function resetInputs()
    {
        $this->urgency_contact1_full_name = "";
        $this->urgency_contact1_address = "";
        $this->urgency_contact1_phone = "";
        $this->urgency_contact2_full_name = "";
        $this->urgency_contact2_address = "";
        $this->urgency_contact2_phone = "";
        $this->treating_doctor_name = "";
        $this->treating_doctor_address = "";
        $this->treating_doctor_phone = "";
        $this->diabetes = false;
        $this->asthma = false;
        $this->heart_condition = false;
        $this->skin_condition = false;
        $this->physical_disability = false;
        $this->others = false;
        $this->others_precision = "";
        $this->gravity_frequency = "";
        $this->alergic = false;
        $this->alergy_precision = "";
        $this->special_diet = false;
        $this->special_diet_precision = "";
        $this->special_medical_treatment = "";
        $this->special_treatment = false;
        $this->special_treatment = false;
        $this->tetanus_vaccine = false;
        $this->tetanus_vaccine_date = "";
        $this->tetanus_serum = false;
        $this->tetanus_serum_date = "";
        $this->blood_group = "";
        $this->Rhesus = "";
        $this->possible_remarks = "";
    }


    public function render()
    {
        $this->patient = ModelsUser::find($this->patient_id);

        // dd($this->patient);
        return view('livewire.medical-card', ["patient" => $this->patient]);
    }
}
