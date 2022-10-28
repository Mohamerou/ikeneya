



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

<style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  color: #5D6063;
  background-color: #f2f2f2;
  font-family: "Helvetica", "Arial", sans-serif;
  font-size: 16px;
  line-height: 1.3;

  display: flex;
  flex-direction: column;
  align-items: center;
}

.speaker-form-header {
  text-align: center;
  background-color: #F6F7F8;
  border: 1px solid #D6D9DC;
  border-radius: 3px;

  width: 80%;
  margin: 40px auto;
  padding: 50px;
}

.speaker-form-header h1 {
  font-size: 30px;
  margin-bottom: 20px;
}

.speaker-form {
  background-color: #F6F7F8;
  border: 1px solid #D6D9DC;
  border-radius: 3px;

  width: 80%;
  padding: 50px;
  margin: 40px auto;
}

</style>
    <title>Fiche médicale patient</title>
</head>
<body>


        <header class='speaker-form-header'>
            <h1>Fiche médicale</h1>
            <p>Patient: <em>{{ $patient->first_name }} {{ $patient->last_name }}</em></p>
        </header>


      <section class="section">
        <div class="row">



            <div class="card">
                <div class="card-body">
                    <div class="modal fade" id="medicalCardModal">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                          </div>

                          <div class="">
                            <div class="">
                              <h5 style="margin: 20px 40%" class="">Informations réquises</h5>

                              <!-- Multi Columns Form -->
                              <form class="speaker-form">
                                <div class="col-md-6">
                                  <label for="urgency_contact1_full_name" class="form-label">Nom du contact d'urgence 1</label>
                                  <input type="text" class="form-control" id="urgency_contact1_full_name" value="{{ $patient->medicalCard->urgency_contact1_full_name }}">
                                </div>
                                <div class="col-md-6">
                                  <label for="urgency_contact1_address" class="form-label">Adresse du contact d'urgence 1</label>
                                  <input type="text" class="form-control" id="urgency_contact1_address" value="{{ $patient->medicalCard->urgency_contact1_address }}">
                                </div>
                                <div class="col-12">
                                    <div class="col-6 mx-auto">
                                        <label for="urgency_contact1_phone" class="form-label">Téléphone du contact d'urgence 1</label>
                                        <input type="number" class="form-control" id="urgency_contact1_phone" value="{{ $patient->medicalCard->urgency_contact1_phone }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <label for="urgency_contact2_full_name" class="form-label">Nom du contact d'urgence 2</label>
                                  <input type="text" class="form-control" id="urgency_contact2_full_name" value="{{ $patient->medicalCard->urgency_contact2_full_name }}">
                                </div>
                                <div class="col-md-6">
                                  <label for="urgency_contact2_address" class="form-label">Adresse du contact d'urgence 2</label>
                                  <input type="text" class="form-control" id="urgency_contact2_address" value="{{ $patient->medicalCard->urgency_contact2_address }}">
                                </div>
                                <div class="col-12">
                                    <div class="col-6 mx-auto">
                                        <label for="urgency_contact2_phone" class="form-label">Téléphone du contact d'urgence 2</label>
                                        <input type="number" class="form-control" id="urgency_contact2_phone" value="{{ $patient->medicalCard->urgency_contact2_phone }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                  <label for="treating_doctor_name" class="form-label">Docteur traitant</label>
                                  <input type="text" class="form-control" id="treating_doctor_name" value="{{ $patient->medicalCard->treating_doctor_name }}" placeholder="1234 Main St">
                                </div>
                                <div class="col-12">
                                  <label for="treating_doctor_address" class="form-label">Adresse du docteur traitant</label>
                                  <input type="text" class="form-control" id="treating_doctor_address" value="{{ $patient->medicalCard->treating_doctor_address }}" placeholder="">
                                </div>
                                <div class="col-12">
                                    <div class="col-6 mx-auto">
                                        <label for="treating_doctor_phone" class="form-label">Télephone du docteur traitant</label>
                                        <input type="number" class="form-control" id="treating_doctor_phone" value="{{ $patient->medicalCard->treating_doctor_phone }}">
                                    </div>
                                </div>
                                <div class="col-12 border border-2 rounded p-4 my-4">
                                    <h4 class="mb-5">Informations médicales confidentielles</h4>
                                    <div class="col-12">
                                        <div class="col-12">
                                            <h5 class="mb-2">Êtes vous atteint de:</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="diabetes"
                                                    @if ($patient->medicalCard->diabetes)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="diabetes">
                                                  Diabète
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="asthma"
                                                    @if ($patient->medicalCard->asthma)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="asthma">
                                                  Asthme
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="heart_condition"
                                                    @if ($patient->medicalCard->heart_condition)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="heart_condition">
                                                    Affection cardiaque
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="skin_condition"
                                                    @if ($patient->medicalCard->skin_condition)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="skin_condition">
                                                  Affection cutanée
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="physical_disability"
                                                    @if ($patient->medicalCard->physical_disability)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="physical_disability">
                                                    Handicape moteur
                                                </label>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="others"
                                                    @if ($patient->medicalCard->skin_condition)
                                                        @checked(true)
                                                    @endif>
                                                <label class="form-check-label" for="others">
                                                   Autre
                                                </label>
                                              </div>
                                            </div>

                                            @if ($patient->medicalCard->others)
                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2"></h6>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Précisez" id="others_precision" style="height: 100px;">
                                                        {{ $patient->medicalCard->others_precision }}
                                                    </textarea>
                                                    <label for="others_precision">Précisez si autres</label>
                                                </div>
                                                </div>

                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2"></h6>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Fréquence de gravité" id="gravity_frequency" style="height: 100px;">
                                                        {{ $patient->medicalCard->gravity_frequency }}
                                                    </textarea>
                                                    <label for="gravity_frequency">Fréquence de gravité</label>
                                                </div>
                                                </div>
                                            @endif

                                            <hr/>


                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="alergic">
                                                      Etes vous allergique à certaines matières, aliments, insectes, médicaments etc ? Oui / Non
                                                    </label>
                                                  <input class="form-check-input" type="checkbox"  id="alergic"
                                                    @if ($patient->medicalCard->alergic)
                                                        @checked(true)
                                                    @endif>
                                                </div>
                                              </div>
                                            @if($patient->medicalCard->alergic)
                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2"></h6>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="alergy_precision" style="height: 100px;">
                                                        {{ $patient->medicalCard->alergy_precision }}
                                                    </textarea>
                                                    <label for="alergy_precision">Si oui, lesquelles ?</label>
                                                </div>
                                                </div>
                                            @endif

                                            <hr/>


                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="special_diet">
                                                        Avez-vous un régime alimentaire particulier ? Oui / Non
                                                    </label>
                                                  <input class="form-check-input" type="checkbox"  id="special_diet"
                                                  @if ($patient->medicalCard->special_diet)
                                                      @checked(true)
                                                  @endif>
                                                </div>
                                              </div>

                                            @if($patient->medicalCard->special_diet)
                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2">Précisez le régime</h6>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="special_diet_precision" style="height: 100px;">
                                                        {{ $patient->medicalCard->special_diet_precision }}
                                                    </textarea>
                                                    <label for="special_diet_precision">Si oui, lesquel ?</label>
                                                </div>
                                                </div>
                                            @endif

                                            <hr/>



                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="special_treatment">
                                                        Êtes-vous sous traitement médicamenteux ? (Allopathie, médecine naturelle, pilule contraceptive, etc) Oui / Non
                                                    </label>
                                                  <input class="form-check-input" type="checkbox"
                                                  @if ($patient->medicalCard->special_treatment)
                                                      @checked(true)
                                                  @endif>
                                                </div>
                                              </div>

                                            @if($patient->medicalCard->special_treatment)
                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2">Précisez les traitements</h6>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="special_medical_treatment" style="height: 100px;">
                                                            {{ $patient->medicalCard->special_medical_treatment }}
                                                        </textarea>
                                                        <label for="special_medical_treatment">Si oui, lesquels ?</label>
                                                    </div>
                                                </div>
                                            @endif

                                            <hr/>


                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="tetanus_vaccine">
                                                        Avez-vous été vacciné contre le tétanos ? Oui / Non (Date du dernier rappel)
                                                    </label>
                                                  <input class="form-check-input" type="checkbox"  id="tetanus_vaccine"
                                                  @if ($patient->medicalCard->tetanus_vaccine)
                                                      @checked(true)
                                                  @endif>
                                                </div>
                                              </div>

                                            @if($patient->medicalCard->tetanus_vaccine)
                                                <div class="col-12 mt-3">
                                                    <label for="tetanus_vaccine_date" class="form-label">Date du dernier rappel de vaccination tétanos</label>
                                                    <span class="form-control" id="tetanus_vaccine_date">{{ date('Y-m-d',strtotime($patient->medicalCard->tetanus_vaccine_date)) }}</span>
                                                </div>
                                            @endif

                                            <hr/>

                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <label class="form-check-label" for="tetanus_serum">
                                                        Avez-vous récu le sérum antitétanique ? Oui / Non (en quelle année)
                                                    </label>
                                                  <input class="form-check-input" type="checkbox"  id="tetanus_serum"
                                                  @if ($patient->medicalCard->tetanus_serum)
                                                      @checked(true)
                                                  @endif>
                                                </div>
                                            </div>

                                            @if($patient->medicalCard->tetanus_serum)
                                                <div class="col-12 mt-3">
                                                    <label for="tetanus_serum_date" class="form-label">Année / Date</label>
                                                    <span class="form-control" id="tetanus_serum_date">{{ date('Y-m-d',strtotime($patient->medicalCard->tetanus_serum_date)) }}</span>
                                                </div>
                                            @endif

                                            <hr/>

                                            <div class="col-12 mt-3">
                                                <label for="blood_group" class="form-label">Groupe sangin</label>
                                                <input type="text" class="form-control" id="blood_group" value="{{ $patient->medicalCard->blood_group }}" placeholder="">
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label for="Rhesus" class="form-label">Rhésus</label>
                                                <input type="text" class="form-control" id="Rhesus" value="{{ $patient->medicalCard->Rhesus }}" placeholder="">
                                            </div>
                                            <div class="col-12">
                                                <h6 class="mt-3 mb-2">Remarques éventuelles</h6>
                                              <div class="form-floating">
                                                <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="possible_remarks" style="height: 100px;">
                                                    {{ $patient->medicalCard->possible_remarks }}
                                                </textarea>
                                                <label for="possible_remarks">Remarques...</label>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </form><!-- End Multi Columns Form -->
                            </div>
                          </div>

                        </div>
                      </div>
                    </div><!-- End Large Modal-->


                </div>
            </div>
          </div>
      </section>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
