<div>
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Nos médécins</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
            <li class="breadcrumb-item">Médécin</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->


      <section class="section">
        <div class="row">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Retrouver un médécin</h5>

                @if (session()->has('message'))
                    <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
                @endif


      <form class="col-md-4 mx-auto d-flex" role="search" wire:submit="search">
        <input class="form-control me-2" type="search" placeholder="Trouver..." aria-label="Search" wire:model="search">
        <button class="btn btn-outline-success" type="submit">Trouver</button>
      </form>

              </div>
            </div>
          </div>
      </section>

      <section class="section">
        <div class="col-lg-6">

            <div class="card">
              <div class="card-body">

                {{-- @if (Session::has('message'))
                    <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
                @endif --}}


                <!-- Large Modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" wire:click="resetInputs" data-bs-target="#doctorModal">
                  Nouveau Médécin
                </button>

                <div wire:ignore.self class="modal fade" id="doctorModal" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter un médécin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                      </div>

                      <form wire:submit.prevent="saveDoctor">
                      <div class="modal-body">

                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Informations générales</h5>

                            <!-- General Form Elements -->
                              <div class="row mb-3">
                                <label for="last_name" class="col-sm-2 col-form-label">Nom de famille</label>
                                <div class="col-sm-10">
                                  <input wire:model="last_name" type="text" class="form-control">
                                  @error('last_name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="first_name" class="col-sm-2 col-form-label">Prénom</label>
                                <div class="col-sm-10">
                                  <input wire:model="first_name" type="text" class="form-control">
                                  @error('first_name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-10">
                                  <input wire:model="phone" type="number" class="form-control">
                                  @error('phone') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input wire:model="email" type="email" class="form-control">
                                  @error('email') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Genre</label>
                                <div class="col-sm-10">
                                  <select wire:model="gender" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le Genre</option>
                                    <option value="h">Homme</option>
                                    <option value="f">Femme</option>
                                  </select>
                                  @error('gender') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="profil_pic" class="col-sm-2 col-form-label">Photo de profil</label>
                                        <div class="col-sm-10">
                                        <input wire:model="profil_pic" type="file"  id="profil_pic" class="form-control">
                                        @error('profil_pic') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                        </div>
                                    </div>

                                    @if($profil_pic)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title"></h5>

                                                <img id="" src="{{ $profil_pic->temporaryUrl() }}" class="img-fluid" >
                                                <div class="card-body">
                                                <h5 class="card-title">Prévisualisation</h5>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="id_card" class="col-sm-2 col-form-label">Carte d'identité</label>
                                    <div class="col-sm-10">
                                      <input wire:model="id_card" type="file" id="id_card" class="form-control">
                                      @error('id_card') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                    </div>
                                </div>



                                @if($id_card)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>
                                            <img id="" src="{{  $id_card->temporaryUrl()  }}" class="img-fluid" >
                                            <div class="card-body">
                                                <h5 class="card-title">Prévisualisation</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                              </div>

                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Hopital affilié</label>
                                <div class="col-sm-10">
                                  <select wire:model="hospital" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner un hopital</option>
                                    <option value="hopital1">Hopital 1</option>
                                    <option value="hopital2">Hopital 2</option>
                                  </select>
                                  @error('hospital') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Type de médécin</label>
                                <div class="col-sm-10">
                                  <select wire:model="type" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le type</option>
                                    <option value="generalist">Généraliste</option>
                                    <option value="cardiology">Cardiologue</option>
                                    <option value="respiratory">Respiration</option>
                                    <option value="dermatology">Dermatologue</option>
                                    <option value="genicology">Genicologue</option>
                                    <option value="dental">Dentiste</option>
                                  </select>
                                  @error('type') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="doctor_card" class="col-sm-2 col-form-label">Carte médécin</label>
                                    <div class="col-sm-10">
                                      <input wire:model="doctor_card" type="file" id="doctor_card" class="form-control">
                                      @error('doctor_card') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                    </div>
                                </div>

                                @if($doctor_card)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>

                                            <img  src="{{ $doctor_card->temporaryUrl() }}" class="img-fluid" >
                                            <div class="card-body">
                                            <h5 class="card-title">Prévisualisation</h5>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                @endif
                              </div>

                              <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                <div class="col-sm-10">
                                  <input wire:model="address" type="text" class="form-control">
                                  @error('address') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="resetInputs" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                      </div>

                    </form><!-- End General Form Elements -->

                    </div>
                  </div>
                </div><!-- End Large Modal-->

              </div>
            </div>
          </div>
      </section>


      {{-- /////////////////////////////////////// MOdifier les donnees du medecin        --}}



      <section class="section">
        <div class="col-lg-6">

            <div class="card">
              <div class="card-body">

                {{-- @if (Session::has('message'))
                    <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
                @endif --}}


                {{-- <!-- Large Modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" wire:click="resetInputs" data-bs-target="#doctorModal">
                  Modifier les informations du Médécin
                </button> --}}

                <div wire:ignore.self class="modal fade" id="updateDoctorModal" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Mise à jour d'information médécin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                      </div>

                      <form wire:submit.prevent="updateDoctor">
                      <div class="modal-body">

                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Informations générales</h5>

                            <!-- General Form Elements -->
                              <div class="row mb-3">
                                <label for="last_name" class="col-sm-2 col-form-label">Nom de famille</label>
                                <div class="col-sm-10">
                                  <input wire:model="last_name" type="text" class="form-control">
                                  @error('last_name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="first_name" class="col-sm-2 col-form-label">Prénom</label>
                                <div class="col-sm-10">
                                  <input wire:model="first_name" type="text" class="form-control">
                                  @error('first_name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-10">
                                  <input wire:model="phone" type="number" class="form-control">
                                  @error('phone') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                  <input wire:model="email" type="email" class="form-control">
                                  @error('email') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Genre</label>
                                <div class="col-sm-10">
                                  <select wire:model="gender" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le Genre</option>
                                    <option value="h">Homme</option>
                                    <option value="f">Femme</option>
                                  </select>
                                  @error('gender') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>


                              <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                <div class="col-sm-10">
                                  <input wire:model="address" type="text" class="form-control">
                                  @error('address') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="profil_pic" class="col-sm-2 col-form-label">Photo de profil</label>
                                        <div class="col-sm-10">
                                        <input wire:model="profil_pic" type="file"  id="profil_pic" class="form-control">
                                        @error('profil_pic') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                        </div>
                                    </div>


                                    @if ($profil_pic)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                <h5 class="card-title"></h5>

                                                    <img  src="{{ $profil_pic->temporaryUrl() }}" class="img-fluid" >
                                                    <div class="card-body">
                                                    <h5 class="card-title">Prévisualisation de la nouvelle photo de profil</h5>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                @if(!is_null($old_profil_pic_frame))
                                    <div class="col-md-6 row mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                            <h5 class="card-title"></h5>

                                                <img  src="{{ asset('storage/'.$old_profil_pic_frame) }}" class="img-fluid" >
                                                <div class="card-body">
                                                <h5 class="card-title">Ancienne photo de profil</h5>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endif

                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="id_card" class="col-sm-2 col-form-label">Carte d'identité</label>
                                    <div class="col-sm-10">
                                      <input wire:model="id_card" type="file" id="id_card" class="form-control">
                                      @error('id_card') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                    </div>
                                </div>

                                @if ($id_card)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>

                                            <img  src="{{ $id_card->temporaryUrl() }}" class="img-fluid" >
                                            <div class="card-body">
                                            <h5 class="card-title">Prévisualisation de la nouvelle pièce d'identité</h5>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                @endif

                              </div>

                              @if(!is_null($old_id_card_frame))
                              <div class="col-md-6 row mb-3">
                                  <div class="card">
                                      <div class="card-body">
                                      <h5 class="card-title"></h5>

                                          <img  src="{{ asset('storage/'.$old_id_card_frame) }}" class="img-fluid" >
                                          <div class="card-body">
                                          <h5 class="card-title">Ancienne pièce d'identité</h5>
                                          </div>


                                      </div>
                                  </div>
                              </div>
                            @endif

                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Hopital affilié</label>
                                <div class="col-sm-10">
                                  <select wire:model="hospital" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner un hopital</option>
                                    <option value="hopital1">Hopital 1</option>
                                    <option value="hopital2">Hopital 2</option>
                                  </select>
                                  @error('hospital') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Type de médécin</label>
                                <div class="col-sm-10">
                                  <select wire:model="type" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le type</option>
                                    <option value="generalist">Généraliste</option>
                                    <option value="cardiology">Cardiologue</option>
                                    <option value="respiratory">Respiration</option>
                                    <option value="dermatology">Dermatologue</option>
                                    <option value="genicology">Genicologue</option>
                                    <option value="dental">Dentiste</option>
                                  </select>
                                  </select>
                                  @error('type') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                              <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="doctor_card" class="col-sm-2 col-form-label">Carte médécin</label>
                                    <div class="col-sm-10">
                                      <input wire:model="doctor_card" type="file" id="doctor_card" class="form-control">
                                      @error('doctor_card') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                    </div>
                                </div>


                                @if ($doctor_card)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                        <h5 class="card-title"></h5>

                                            <img  src="{{ $doctor_card->temporaryUrl() }}" class="img-fluid" >
                                            <div class="card-body">
                                            <h5 class="card-title">Prévisualisation de la nouvelle pièce d'identité</h5>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                @endif
                              </div>

                              @if(!is_null($old_doctor_card_frame))
                              <div class="col-md-6 row mb-3">
                                  <div class="card">
                                      <div class="card-body">
                                      <h5 class="card-title"></h5>

                                          <img  src="{{ asset('storage/'.$old_doctor_card_frame) }}" class="img-fluid" >
                                          <div class="card-body">
                                          <h5 class="card-title">Ancienne carte médecin</h5>
                                          </div>


                                      </div>
                                  </div>
                              </div>
                            @endif

                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="resetInputs" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                      </div>

                    </form><!-- End General Form Elements -->

                    </div>
                  </div>
                </div><!-- End Large Modal-->

              </div>
            </div>
          </div>
      </section>


      <section>
        <div class="row">
                <!-- Large Modal -->
                <div wire:ignore.self class="modal fade" id="deleteDoctorModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Supprimer un médécin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                    </div>

                    <form wire:submit.prevent="destroyDoctor">
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
      </section>

    </main><!-- End #main -->



    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Listes des médécins</h1>
        </div><!-- End Page Title -->

        <section class="section">
          <div class="row">

            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Médécins partenaires</h5>

                  <!-- Table with hoverable rows -->
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Profil</th>
                        <th scope="col">Carte médécin</th>
                        <th scope="col">Type</th>
                        <th scope="col">Hopital</th>
                        <th scope="col">Domaine</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                      </tr>
                    </thead>
                    <tbody>
                            @forelse ($users as $user)
                                @if (!is_null($user->doctor))
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->doctor->code }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><img width="100px" height="100px" src="{{ asset('storage/'.$user->doctor->profil_pic) }}" alt="Photo de profil"></td>
                                        <td><img width="100px" height="100px" src="{{ asset('storage/'.$user->doctor->doctor_card) }}" alt="carte médécin"></td>
                                        <td>{{ $user->doctor->hospital }}</td>
                                        <td>{{ $user->doctor->category }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateDoctorModal" wire:click="editDoctor({{ $user->id }})" class="btn btn-primary">Modifier</button>
                                        </td>
                                        <td>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteDoctorModal" wire:click="deleteDoctor({{ $user->id }})" class="btn btn-danger">Supprimer</button>
                                        </td>
                                    </tr>
                                @endif
                        @empty
                        <tr>
                            <td colspan="5">
                                Aucune reponse trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
                    @if(!is_null($users))
                    <div class="my-1">
                        {{ $users->links() }}
                    </div>
                    @endif
                  <!-- End Table with hoverable rows -->

                </div>
              </div>

            </div>
          </div>
        </section>

    </main><!-- End #main -->
</div>

