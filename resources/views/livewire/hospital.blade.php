<div>
    <main id="main" class="main">

      <div class="pagetitle">
        <h1>Hopitaux parténaires</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
            <li class="breadcrumb-item">Hopitaux</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->


      <section class="section">
        <div class="row">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Retrouver un hopital</h5>

                @if (session()->has('message'))
                    <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
                @endif



            {{-- <div class="search-bar">
                <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                </form>
            </div><!-- End Search Bar --> --}}
            <form class="col-md-4 mx-auto d-flex" role="search" wire:submit="search">
                <input class="form-control me-2" type="search" placeholder="Trouver..." aria-label="Search" wire:model="search">
                <button class="btn btn-outline-success" type="submit">Trouver</button>
            </form>

              </div>
            </div>
          </div>
      </section>

      <section class="section">
        <div class="row">

            <div class="card">
              <div class="card-body">

                {{-- @if (Session::has('message'))
                    <h5 class="alert alert-success text-center">{{ session('message') }}</h5>
                @endif --}}


                <!-- Large Modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" wire:click="resetInputs" data-bs-target="#hospitalModal">
                  Nouveau hopital
                </button>

                <div wire:ignore.self class="modal fade" id="hospitalModal" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Ajouter un hopital</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                      </div>

                      <form wire:submit.prevent="saveHospital">
                      <div class="modal-body">

                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title">Informations générales</h5>

                            <!-- General Form Elements -->
                              <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nom de l'établissement</label>
                                <div class="col-sm-10">
                                  <input wire:model="name" type="text" class="form-control">
                                  @error('name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>

                              <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                  <select wire:model="type" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le type</option>
                                    <option value="cscom">CSCOM</option>
                                    <option value="autre">...</option>
                                  </select>
                                  @error('type') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                <div class="col-sm-10">
                                  <input wire:model="address" type="text" class="form-control">
                                  @error('address') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>
                              {{-- <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                  <input class="form-control" type="file" id="formFile">
                                </div>
                              </div> --}}
                              <div class="row mb-3">
                                <label for="contact" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-10">
                                  <input wire:model="contact" type="text" class="form-control">
                                  @error('contact') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                              </div>


                              {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Soumission</label>
                                <div class="col-sm-10">
                                  <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                              </div> --}}

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
      <section>
        <div class="row">
                <!-- Large Modal -->
                <div wire:ignore.self class="modal fade" id="updateHospitalModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Mise à jour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetInputs" aria-label="Close"></button>
                    </div>

                    <form wire:submit.prevent="updateHospital">
                    <div class="modal-body">

                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informations générales</h5>

                            <!-- General Form Elements -->
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Nom de l'établissement</label>
                                <div class="col-sm-10">
                                <input wire:model="name" type="text" class="form-control">
                                @error('name') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                <select wire:model="type" class="form-select" aria-label="Default select example">
                                    <option value="" selected>Sélectionner le type</option>
                                    <option value="cscom">CSCOM</option>
                                    <option value="autre">...</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                <div class="col-sm-10">
                                <input wire:model="address" type="text" class="form-control">
                                @error('address') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFile">
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label for="contact" class="col-sm-2 col-form-label">Contact</label>
                                <div class="col-sm-10">
                                <input wire:model="contact" type="text" class="form-control">
                                @error('contact') <span class="text-danger">{{ $message="Champ obligatoire" }}</span> @enderror
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Soumission</label>
                                <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                            </div> --}}

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
      </section>


      <section>
        <div class="row">
                <!-- Large Modal -->
                <div wire:ignore.self class="modal fade" id="deleteHospitalModal" tabindex="-1">
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
      </section>

    </main><!-- End #main -->



    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Listes des hopitaux</h1>
        </div><!-- End Page Title -->

        <section class="section">
          <div class="row">

            <div class="col">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Hopitaux partenaires</h5>

                  <!-- Table with hoverable rows -->
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Etablissement</th>
                        <th scope="col">Type</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($hospitals as $hospital)
                            <tr>
                            <th scope="row">{{ $hospital->id }}</th>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->type }}</td>
                            <td>{{ $hospital->address }}</td>
                            <td>{{ $hospital->contact }}</td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateHospitalModal" wire:click="editHospital({{ $hospital->id }})" class="btn btn-primary">Modifier</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteHospitalModal" wire:click="deleteHospital({{ $hospital->id }})" class="btn btn-danger">Supprimer</button>
                            </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                Aucune reponse trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                  </table>
                  <div class="my-1">
                    {{ $hospitals->links() }}
                  </div>
                  <!-- End Table with hoverable rows -->

                </div>
              </div>

            </div>
          </div>
        </section>

    </main><!-- End #main -->
</div>
