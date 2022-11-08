<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use Livewire\WithFileUploads;

use App\Models\Doctor as ModelsDoctor;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Livewire\Component;

class Doctor extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';

    protected $listeners = [
                                "profil_pic_uploaded"  => "handleProfilPicUploaded",
                                "id_card_uploaded"     => "handleIdCardUploaded",
                                "doctor_card_uploaded" => "handleDoctorCardUploaded",
                           ];

    public function updatingSearch()

    {

        $this->resetPage();

    }

    protected $paginationTheme = 'bootstrap';

    public $first_name, $last_name, $phone, $email, $address, $type, $job_title, $id_card, $profil_pic, $doctor_card, $gender, $doctor_id, $hospital, $doctor_users;
    public $old_id_card_frame = null;
    public $old_profil_pic_frame = null;
    public $old_doctor_card_frame = null;

    // public $hospitals;

    public function rules()
    {
        return [
            'first_name' =>  "required|string",
            'last_name' =>  "required|string",
            'address' =>  "required|string",
            'hospital' =>  "required|string",
            'type' =>  "required|string",
            'job_title' =>  "required|string",
            'gender' =>  "required|string|min:1|max:1",
            'email' =>  "required|email",
            'phone' =>  "required|digits:8",
        ];
    }


    public function storeProfilPic()
    {
        if(!is_null($this->profil_pic))
        {

            $img    = Image::make($this->profil_pic)->encode('jpg');


            $img->resize(200, 200);
            $name   = Str::random().'.jpg';
            Storage::disk('public')->put($name, $img);

            return $name;
        } else {
            return null;
        }
    }


    public function storeIdCard()
    {
        if(!is_null($this->id_card))
        {

            $img = Image::make($this->id_card)->encode('jpg');


            $img->resize(200, 200);

            $name   = Str::random().'.jpg';
            Storage::disk('public')->put($name, $img);

            return $name;
        } else {
            return null;
        }
    }


    public function storeDoctorCard()
    {
        if(!is_null($this->doctor_card))
        {

            $img = Image::make($this->doctor_card)->encode('jpg');


            $img->resize(200, 200);

            $name   = Str::random().'.jpg';
            Storage::disk('public')->put($name, $img);

            return $name;
        } else{
            return null;
        }

    }

    public function generateDoctorCode(ModelsUser $doctor)
    {
        $random_doctor_code = rand(100000,999999);
        $doctor_code = "DOC-".substr($doctor->first_name,0,1)
        .substr($doctor->last_name,0,1)
        .substr($doctor->first_name,0,1)
        .$random_doctor_code
        .substr($doctor->gender,0,1);

        $doctor_code = strtoupper($doctor_code);

        return $doctor_code;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveDoctor()
    {
        $validatedData      = $this->validate();
        // $random_password    = Str::random(9);
        $random_password    = "password";


        $doctor_user = ModelsUser::create([
            "first_name" => $validatedData['first_name'],
            "last_name" => $validatedData['last_name'],
            "email" => $validatedData['email'],
            "phone" => $validatedData['phone'],
            "password" => Hash::make($random_password),
            "address" => $validatedData['address'],
        ]);

        if (!is_null($doctor_user)) {

            $code = $this->generateDoctorCode($doctor_user);

            $id_card = $this->storeIdCard();
            $profil_pic = $this->storeProfilPic();
            $doctor_card = $this->storeDoctorCard();

            $doctor_info = ModelsDoctor::create([
                "user_id" => $doctor_user->id,
                "type" => $validatedData['type'],
                'job_title' => $validatedData['job_title'],
                'code' => $code,
                'gender' => $validatedData['gender'],
                'hospital' => $validatedData['hospital'],
                'id_card' => $id_card,
                'profil_pic' => $profil_pic,
                'doctor_card' => $doctor_card,
            ]);

            Session::flash('message', 'Hopital ajouté avec succès');
            $this->resetInputs();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function updateDoctor()
    {
        $validatedData = $this->validate();
        $updated_doctor_user = ModelsUser::where('id', $this->doctor_id)->update([
            "first_name" => $validatedData['first_name'],
            "last_name" => $validatedData['last_name'],
            "email" => $validatedData['email'],
            "phone" => $validatedData['phone'],
            "address" => $validatedData['address'],
        ]);

        $updated_doctor_user_info = ModelsDoctor::where('user_id', $this->doctor_id)->update([
            "type" => $validatedData['type'],
            "job_title" => $validatedData['job_title'],
            "gender" => $validatedData['gender'],
            "hospital" => $validatedData['hospital'],
        ]);



        $id_card = $this->storeIdCard();
        $profil_pic = $this->storeProfilPic();
        $doctor_card = $this->storeDoctorCard();



        if($id_card != null) {
            $updated_patient_user_info = ModelsDoctor::where('user_id', $this->doctor_id)->update([
                'id_card' => $id_card,
            ]);
        }

        if($profil_pic != null) {
            $updated_patient_user_info = ModelsDoctor::where('user_id', $this->doctor_id)->update([
                'profil_pic' => $profil_pic,
            ]);
        }

        if($doctor_card != null) {
            $updated_patient_user_info = ModelsDoctor::where('user_id', $this->doctor_id)->update([
                'doctor_$doctor_card' => $doctor_card,
            ]);
        }



        Session::flash('message', 'Hopital mise à jour avec succès');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editDoctor(int $doctor_id)
    {
        // dd($doctor_id);

        $doctor = ModelsUser::find($doctor_id);

        // dd($hospital);

        if ($doctor) {
            $this->doctor_id = $doctor->id;
            $this->first_name = $doctor->first_name;
            $this->last_name = $doctor->last_name;
            $this->type = $doctor->doctor->type;
            $this->address = $doctor->address;
            $this->phone = $doctor->phone;
            $this->email = $doctor->email;
            $this->job_title = $doctor->doctor->job_title;
            $this->gender = $doctor->doctor->gender;
            $this->hospital = $doctor->doctor->hospital;



            if($doctor->doctor->id_card != null)
            {
                $this->old_id_card_frame = $doctor->doctor->id_card;
            }

            if($doctor->doctor->profil_pic != null)
            {
                $this->old_profil_pic_frame = $doctor->doctor->profil_pic;
            }

            if($doctor->doctor->doctor_card != null)
            {
                $this->old_doctor_card_frame = $doctor->doctor->doctor_card;
            }


        } else {
            return redirect()->to("/doctor");
        }

    }

    public function destroyDoctor()
    {

        $doctor = ModelsDoctor::find($this->doctor_id)->delete();

        // dd($doctor);
        Session::flash('message', 'Médécin supprimé avec succès');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteDoctor(int $doctor_id)
    {
        $this->doctor_id = $doctor_id;
    }

    public function resetInputs()
    {
        $this->first_name = "";
        $this->last_name = "";
        $this->address = "";
        $this->email = "";
        $this->gender = "";
        $this->type = "";
        $this->hospital = "";
        $this->job_title = "";
        $this->id_card = null;
        $this->profil_pic = null;
        $this->doctor_card = null;
        $this->phone = "";
        $this->doctor_id = "";
        $this->old_id_card_frame = "";
        $this->old_profil_pic_frame = "";
        $this->old_doctor_card_frame = "";
    }

    public function handleProfilPicUploaded($imageData)
    {
        $this->profil_pic = $imageData;
    }

    public function handleIdCardUploaded($imageData)
    {
        $this->id_card = $imageData;
    }

    public function handleDoctorCardUploaded($imageData)
    {
        $this->doctor_card = $imageData;
    }


    public function render()
    {
        $users = ModelsUser::where('first_name', 'like', '%'.$this->search.'%')
                             ->orderBy("id", "DESC")->paginate(3);
        // dd($users);
        return view('livewire.doctor', ['users' => $users]);
    }
}
