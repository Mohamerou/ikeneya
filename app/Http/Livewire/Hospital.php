<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Hospital as ModelsHospital;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Hospital extends Component
{
    use WithPagination;

    public $search = '';



    public function updatingSearch()

    {

        $this->resetPage();

    }

    protected $paginationTheme = 'bootstrap';

    public $name, $address, $type, $contact, $hospital_id;
    // public $hospitals;

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'address' => 'required|string',
            'type' => 'required|string',
            'contact' => 'required|string'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveHospital()
    {
        $validatedData = $this->validate();
        ModelsHospital::create([
            "name" => $validatedData['name'],
            "address" => $validatedData['address'],
            "type" => $validatedData['type'],
            "contact" => $validatedData['contact']
        ]);

        Session::flash('message', 'Hopital ajouté avec succès');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateHospital()
    {
        $validatedData = $this->validate();
        ModelsHospital::where('id', $this->hospital_id)->update([
            "name" => $validatedData['name'],
            "address" => $validatedData['address'],
            "type" => $validatedData['type'],
            "contact" => $validatedData['contact']
        ]);

        Session::flash('message', 'Hopital mise à jour avec succès');
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editHospital(int $hospital_id)
    {
        // dd($hospital_id);

        $hospital = ModelsHospital::find($hospital_id);

        // dd($hospital);

        if ($hospital) {
            $this->hospital_id = $hospital->id;
            $this->name = $hospital->name;
            $this->type = $hospital->type;
            $this->address = $hospital->address;
            $this->contact = $hospital->contact;
            // dd($this->type);
        } else {
            return redirect()->to("/hospital");
        }

    }

    public function destroyHospital()
    {

        $hospital = ModelsHospital::find($this->hospital_id)->delete();

        // dd($hospital);
        Session::flash('message', 'Hopital supprimé avec succès');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteHospital(int $hospital_id)
    {
        $this->hospital_id = $hospital_id;
    }

    public function resetInputs()
    {
        $this->name = "";
        $this->address = "";
        $this->type = "";
        $this->contact = "";
    }


    public function render()
    {
        $hospitals = ModelsHospital::where('name', 'like', '%'.$this->search.'%')
                                     ->orderBy("id", "DESC")->paginate(3);
        // dd(gettype($hospitals));
        return view('livewire.hospital',["hospitals"=>$hospitals]);
    }
}
