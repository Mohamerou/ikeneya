<?php

namespace App\Http\Livewire;

use Livewire\Component;


use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Patient as ModelsPatient;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Patient extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    protected $listeners = [
                                "profil_pic_uploaded"  => "handleProfilPicUploaded",
                                "id_card_uploaded"     => "handleIdCardUploaded",
                           ];

    public function updatingSearch()

    {

        $this->resetPage();

    }

    protected $paginationTheme = 'bootstrap';

    public $first_name, $last_name, $phone, $address, $id_card, $profil_pic, $gender, $patient_id, $patients;
    public $id_card_frame, $profil_pic_frame;



    public function rules()
    {
        return [
            'first_name' =>  "required|string",
            'last_name' =>  "required|string",
            'address' =>  "required|string",
            'gender' =>  "required|string|min:1|max:1",
            'id_card' =>  "required|file|mimes:jpeg,png,jpg,gif|max:4024",
            'profil_pic' =>  "required|file|mimes:jpeg,png,jpg,gif|max:4024",
            'phone' =>  "required|digits:8",
        ];
    }




    public function storeProfilPic()
    {
        if(!$this->profil_pic_frame)
        {
             return null;
        }

        $img    = Image::make($this->profil_pic_frame)->encode('jpg');


        $img->resize(200, 200);
        $name   = Str::random().'.jpg';
        Storage::disk('public')->put($name, $img);

        return $name;
    }


    public function storeIdCard()
    {
        if(!$this->id_card_frame)
        {
             return null;
        }

        $img = Image::make($this->id_card_frame)->encode('jpg');


        $img->resize(200, 200);

        $name   = Str::random().'.jpg';
        Storage::disk('public')->put($name, $img);

        return $name;
    }


    public function generatePatientCode(ModelsUser $patient)
    {
        $random_patient_code = rand(100000,999999);
        $patient_code = "P-".substr($patient->first_name,0,1)
        .substr($patient->last_name,0,1)
        .substr($patient->first_name,0,1)
        .$random_patient_code
        .substr($patient->gender,0,1);

        $patient_code = strtoupper($patient_code);

        return $patient_code;
    }



    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function savePatient()
    {
        $validatedData      = $this->validate();
        // $random_password    = Str::random(9);
        $random_password    = "password";


        $patient_user = ModelsUser::create([
            "first_name" => $validatedData['first_name'],
            "last_name" => $validatedData['last_name'],
            "phone" => $validatedData['phone'],
            "password" => Hash::make($random_password),
            "address" => $validatedData['address'],
        ]);

        if (!is_null($patient_user)) {

            $code = $this->generatePatientCode($patient_user);

            $id_card = $this->storeIdCard();
            $profil_pic = $this->storeProfilPic();

            $patient_info = ModelsPatient::create([
                "user_id" => $patient_user->id,
                'patient_code' => $code,
                'gender' => $validatedData['gender'],
                'id_card' => $id_card,
                'profil_pic' => $profil_pic,
            ]);

            Session::flash('message', 'Patient ajouté avec succès');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function updatePatient()
    {
        $validatedData = $this->validate();
        $updated_patient_user = ModelsUser::where('id', $this->patient_id)->update([
            "first_name" => $validatedData['first_name'],
            "last_name" => $validatedData['last_name'],
            "phone" => $validatedData['phone'],
            "address" => $validatedData['address'],
        ]);

        $updated_patient_user_info = ModelsPatient::where('user_id', $this->patient_id)->update([
            "profil_pic" => $validatedData['profil_pic'],
            "id_card" => $validatedData['id_card'],
            "gender" => $validatedData['gender'],
        ]);

        Session::flash('message', 'Infos du patient mise à jour avec succès');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function editPatient(int $patient_id)
    {
        // dd($patient_id);

        $patient = ModelsUser::find($patient_id);

        // dd($hospital);

        if ($patient) {
            $this->patient_id = $patient->id;
            $this->first_name = $patient->first_name;
            $this->last_name = $patient->last_name;
            $this->address = $patient->address;
            $this->phone = $patient->phone;
            $this->id_card = $patient->patient->job_title;
            $this->profil_pic = $patient->patient->profil_pic;
            $this->gender = $patient->patient->gender;
            $this->profil_pic_frame = $patient->patient->profil_pic;
            $this->patient_card_frame = $patient->patient->patient_card;

        } else {
            return redirect()->to("/patient");
        }

    }

    public function destroyPatient()
    {

        $patient = ModelsPatient::find($this->patient_id)->delete();

        // dd($patient);
        Session::flash('message', 'Infos du patient supprimé avec succès');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deletePatient(int $patient_id)
    {
        $this->patient_id = $patient_id;
    }



    public function resetInputs()
    {
        $this->first_name = "";
        $this->last_name = "";
        $this->address = "";
        $this->id_card = "";
        $this->phone = "";
        $this->patient_id = "";
        $this->id_card_frame = "";
        $this->profil_pic_frame = "";
    }

    public function handleProfilPicUploaded($imageData)
    {
        $this->profil_pic_frame = $imageData;
    }

    public function handleIdCardUploaded($imageData)
    {
        $this->id_card_frame = $imageData;
    }




    public function render()
    {
        $patients = ModelsUser::where('first_name', 'like', '%'.$this->search.'%')
                             ->orderBy("id", "DESC")->paginate(3);
        // dd($patients);
        return view('livewire.patient',['users'=> $patients]);
    }
}
