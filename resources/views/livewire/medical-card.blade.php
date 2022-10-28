<div>
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Fiche médical</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
            <li class="breadcrumb-item">Fiche Médicale</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <div class="col-6 mx-auto">
        @if (session()->has('message'))
            <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
        @endif
      </div>

      @if(empty($patient->medicalCard))
        <section class="section">
            <div class="row">



                <div class="card">
                    <div class="card-body">



                    <!-- Large Modal -->
                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" wire:click="resetInputs" data-bs-target="#medicalCardModal">
                            Fiche médicale
                        </button>

                        <div wire:ignore.self class="modal fade" id="medicalCardModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Fiche médicale du patient | <span style="color: green">{{ $patient->first_name }} {{ $patient->last_name }}</span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Informations réquises</h5>

                                <!-- Multi Columns Form -->
                                <form wire:submit.prevent="saveMedicalCard" class="row g-3">
                                    <div class="col-md-6">
                                    <label for="urgency_contact1_full_name" class="form-label">Nom du contact d'urgence 1</label>
                                    <input type="text" class="form-control" id="urgency_contact1_full_name" wire:model="urgency_contact1_full_name">
                                    </div>
                                    <div class="col-md-6">
                                    <label for="urgency_contact1_address" class="form-label">Adresse du contact d'urgence 1</label>
                                    <input type="text" class="form-control" id="urgency_contact1_address" wire:model="urgency_contact1_address">
                                    </div>
                                    <div class="col-12">
                                        <div class="col-6 mx-auto">
                                            <label for="urgency_contact1_phone" class="form-label">Téléphone du contact d'urgence 1</label>
                                            <input type="number" class="form-control" id="urgency_contact1_phone" wire:model="urgency_contact1_phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <label for="urgency_contact2_full_name" class="form-label">Nom du contact d'urgence 2</label>
                                    <input type="text" class="form-control" id="urgency_contact2_full_name" wire:model="urgency_contact2_full_name">
                                    </div>
                                    <div class="col-md-6">
                                    <label for="urgency_contact2_address" class="form-label">Adresse du contact d'urgence 2</label>
                                    <input type="text" class="form-control" id="urgency_contact2_address" wire:model="urgency_contact2_address">
                                    </div>
                                    <div class="col-12">
                                        <div class="col-6 mx-auto">
                                            <label for="urgency_contact2_phone" class="form-label">Téléphone du contact d'urgence 2</label>
                                            <input type="number" class="form-control" id="urgency_contact2_phone" wire:model="urgency_contact2_phone">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <label for="treating_doctor_name" class="form-label">Docteur traitant</label>
                                    <input type="text" class="form-control" id="treating_doctor_name" wire:model="treating_doctor_name" placeholder="1234 Main St">
                                    </div>
                                    <div class="col-12">
                                    <label for="treating_doctor_address" class="form-label">Adresse du docteur traitant</label>
                                    <input type="text" class="form-control" id="treating_doctor_address" wire:model="treating_doctor_address" placeholder="">
                                    </div>
                                    <div class="col-12">
                                        <div class="col-6 mx-auto">
                                            <label for="treating_doctor_phone" class="form-label">Télephone du docteur traitant</label>
                                            <input type="number" class="form-control" id="treating_doctor_phone" wire:model="treating_doctor_phone">
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
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('diabetes')" id="diabetes">
                                                    <label class="form-check-label" for="diabetes">
                                                    Diabète
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('asthma')" id="asthma">
                                                    <label class="form-check-label" for="asthma">
                                                    Asthme
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('heart_condition')" id="heart_condition">
                                                    <label class="form-check-label" for="heart_condition">
                                                        Affection cardiaque
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('skin_condition')" id="skin_condition">
                                                    <label class="form-check-label" for="skin_condition">
                                                    Affection cutanée
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('physical_disability')" id="physical_disability">
                                                    <label class="form-check-label" for="physical_disability">
                                                        Handicape moteur
                                                    </label>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('others')" id="others">
                                                    <label class="form-check-label" for="others">
                                                    Autre
                                                    </label>
                                                </div>
                                                </div>

                                                @if ($others)
                                                    <div class="col-12">
                                                        <h6 class="mt-3 mb-2"></h6>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Précisez" id="others_precision" wire:model="others_precision" style="height: 100px;"></textarea>
                                                        <label for="others_precision">Précisez si autres</label>
                                                    </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <h6 class="mt-3 mb-2"></h6>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Fréquence de gravité" id="gravity_frequency" wire:model="gravity_frequency" style="height: 100px;"></textarea>
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
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('alergic')" id="alergic">
                                                    </div>
                                                </div>
                                                @if($alergic)
                                                    <div class="col-12">
                                                        <h6 class="mt-3 mb-2"></h6>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="alergy_precision" wire:model="alergy_precision" style="height: 100px;"></textarea>
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
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('special_diet')" id="special_diet">
                                                    </div>
                                                </div>

                                                @if($special_diet)
                                                    <div class="col-12">
                                                        <h6 class="mt-3 mb-2">Précisez le régime</h6>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="special_diet_precision" wire:model="special_diet_precision" style="height: 100px;"></textarea>
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
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('special_treatment')" id="special_treatment">
                                                    </div>
                                                </div>

                                                @if($special_treatment)
                                                    <div class="col-12">
                                                        <h6 class="mt-3 mb-2">Précisez les traitements</h6>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="special_medical_treatment" wire:model="special_medical_treatment" style="height: 100px;"></textarea>
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
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('tetanus_vaccine')" id="tetanus_vaccine">
                                                    </div>
                                                </div>

                                                @if($tetanus_vaccine)
                                                    <div class="col-12 mt-3">
                                                        <label for="tetanus_vaccine_date" class="form-label">Date du dernier rappel de vaccination tétanos</label>
                                                        <input type="date" class="form-control" id="tetanus_vaccine_date" wire:model="tetanus_vaccine_date" placeholder="">
                                                    </div>
                                                @endif

                                                <hr/>

                                                <div class="col-md-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label" for="tetanus_serum">
                                                            Avez-vous récu le sérum antitétanique ? Oui / Non (en quelle année)
                                                        </label>
                                                    <input class="form-check-input" type="checkbox" wire:click="toggleProperties('tetanus_serum')" id="tetanus_serum">
                                                    </div>
                                                </div>

                                                @if($tetanus_serum)
                                                    <div class="col-12 mt-3">
                                                        <label for="tetanus_serum_date" class="form-label">Année / Date</label>
                                                        <input type="date" class="form-control" id="tetanus_serum_date" wire:model="tetanus_serum_date" placeholder="">
                                                    </div>
                                                @endif

                                                <hr/>

                                                <div class="col-12 mt-3">
                                                    <label for="blood_group" class="form-label">Groupe sangin</label>
                                                    <input type="text" class="form-control" id="blood_group" wire:model="blood_group" placeholder="">
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <label for="Rhesus" class="form-label">Rhésus</label>
                                                    <input type="text" class="form-control" id="Rhesus" wire:model="Rhesus" placeholder="">
                                                </div>
                                                <div class="col-12">
                                                    <h6 class="mt-3 mb-2">Remarques éventuelles</h6>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Si oui, lesquelles ?" id="possible_remarks" wire:model="possible_remarks" style="height: 100px;"></textarea>
                                                    <label for="possible_remarks">Remarques...</label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Archiver</button>
                                    <button type="button" class="btn btn-secondary" wire:click="resetInputs" data-bs-dismiss="modal">Annuler</button>
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
      @endif

      {{-- <section>
        <div class="row">
                <!-- Large Modal -->
                <div wire:ignore.self class="modal fade" id="deleteMedicalCardModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Supprimer un hopital</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                    </div>

                    <form wire:submit.prevent="destroyHospital">
                    <div class="modal-body">
                        <h4>Vous êtes sûr de vouloir supprimer cette information ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="resetInputs" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Oui, Supprimer</button>
                    </div>

                    </form><!-- End General Form Elements -->

                    </div>
                </div>
                </div><!-- End Large Modal-->

            </div>
      </section> --}}

    </main><!-- End #main -->


    @if(!empty($patient->medicalCard->qr_code))
        <main id="main" class="main">

            <div class="pagetitle">
            <h1></h1>
            </div><!-- End Page Title -->

            <section class="section">
            <div class="row">

                <div class="col">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">
                        Informations médicales du patient {{ $patient->first_name }} {{ $patient->last_name }}
                    </h5>

                    <!-- Table with hoverable rows -->
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code Qr</th>
                            <th scope="col">Nom du contact d'urgence 1</th>
                            <th scope="col">Adresse du contact d'urgence 1</th>
                            <th scope="col">Téléphone du contact d'urgence 1</th>
                            <th scope="col">Fiche medical</th>


                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $patient->id }}</th>
                                <td><img width="250" src="{{ asset('storage/'.$patient->medicalCard->qr_code) }}"/></td>
                                <td>{{ $patient->medicalCard->urgency_contact1_full_name }}</td>
                                <td>{{ $patient->medicalCard->urgency_contact1_phone }}</td>
                                <td>{{ $patient->medicalCard->urgency_contact1_address }}</td>
                                <td><a href="{{ route('patient.medicalCard.pdf.view', $patient->id) }}">Afficher</a></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <
                    <!-- End Table with hoverable rows -->

                    </div>
                </div>

                </div>
            </div>
            </section>

        </main><!-- End #main -->
    @endif
</div>
