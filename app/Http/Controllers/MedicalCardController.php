<?php

namespace App\Http\Controllers;

use App\Models\MedicalCard as ModelsMedicalCard;
use App\Models\User as ModelsUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use File;

class MedicalCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $patient_id)
    {
        //
        $patient = ModelsUser::find($patient_id);

        // if(!is_null($patient->patient))
        // {
            return view("admin.medicalCard.index")->with("patient", $patient);
        // }

        // return redirect('/patients');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPDF($patient_id)
    {

        $patient = ModelsUser::find($patient_id);
        $data = [
            "patient" => $patient
        ];

        $unique_token   = md5(rand(1, 33) . microtime()); // Medical card identifier token""

        // Token to qr code
        $qr_code        = QrCode::eye('circle')
                            ->style('round')
                            ->margin(3)
                            ->format('png')
                            ->encoding('UTF-8')
                            ->size(250)
                            ->generate($unique_token);

        // dd($data);
        $file_name = $patient->phone." ".$patient->first_name." ".$patient->last_name;
        $qr_file_name = $patient->phone." ".$patient->first_name." ".$patient->last_name."qr_code";


        $medicalCard_storage_path       = 'medicalCards/'.$file_name.'.pdf';
        $medicalCard_qr_storage_path    = 'medicalCards/qr/'.$qr_file_name.'.png';



        view()->share('patient',$data);
        $pdf = Pdf::loadView('admin.medicalCard.pdfVersion', $data)
        ->setOptions(['defaultFont' => 'sans-serif']);
        // download PDF file with download method


        $medicalCard_storage = Storage::disk('public')
                    ->put($medicalCard_storage_path, $pdf->output());

        $medicalCard_qr_storage = Storage::disk('public')
                    ->put($medicalCard_qr_storage_path, $qr_code);

        $patient->medicalCard->medical_card_pdf = $medicalCard_storage_path;
        $patient->medicalCard->qr_code          = $medicalCard_qr_storage_path;
        $patient->medicalCard->save();

        return $pdf->stream($file_name.'.pdf');


    }

    public function displayMedicalCard($patient_id)
    {

        $patient    = ModelsUser::find($patient_id);
        $filename   = $patient->phone."-".$patient->first_name."-".$patient->last_name.".pdf";
        $path       = storage_path('app/public/'.$patient->medicalCard->medical_card_pdf);

        // dd(storage_path('app/public/'.$patient->medicalCard->medical_card_pdf));
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'name' => "required|string",
            'address' => "required|string",
            'contact' => "required|string",
            'type' => "required|string"
        ]);

        $new_medical_card = ModelsMedicalCard::create([
            'name' => $validated_data["name"],
            'address' => $validated_data["address"],
            'contact' => $validated_data["contact"],
            'type' => $validated_data["type"]
        ]);

        if(!is_null($new_medical_card)) {
            return response([
                'status' => 'success',
                "new_medical_card" => $new_medical_card
            ], 200);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelsMedicalCard  $ModelsmedicalCard
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsMedicalCard $ModelsmedicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $ModelsmedicalCard->id]); //add request
        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $medical_card = ModelsMedicalCard::find($validated_data['id']);
        if(!is_null($medical_card))
        {
            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
            ], 200);
        }

        return response()->json(null, 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelsMedicalCard  $ModelsmedicalCard
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsMedicalCard $ModelsmedicalCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelsMedicalCard  $ModelsmedicalCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsMedicalCard $ModelsmedicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $ModelsmedicalCard->id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric",
            'name' => "required|string",
            'address' => "required|string",
            'type' => "required|string",
        ]);


        $medical_card = ModelsMedicalCard::find($validated_data['id']);

        if(!is_null($medical_card)) {

            $medical_card->update([
                    'name'      => $validated_data['name'],
                    'address'   => $validated_data['address'],
                    'type'      => $validated_data['type']
                ]);

            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelsMedicalCard  $ModelsmedicalCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsMedicalCard $ModelsmedicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $ModelsmedicalCard->id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $medical_card = ModelsMedicalCard::find($validated_data['id']);
        if(!is_null($medical_card))
        {
            $medical_card->status = false;
            $medical_card->save();

            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
                ], 204);
        }
        return response()->json(["message" => "Un problème est survenu"], 404);
    }
}
