@extends('layouts.admin.dash')

@section('content')
    @livewire('patient')
@endsection

@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#patientModal').modal('hide');
        $('#updatePatientModal').modal('hide');
        $('#deletePatientModal').modal('hide');

    });



    window.livewire.on('profil_pic_chosen', () => {

        let inputField = document.getElementById("profil_pic");
        let file = inputField.files[0];
        let reader = new FileReader();
        // console.log(reader);
        reader.onloadend = () => {
            // console.log(reader.result);
            window.livewire.emit('profil_pic_uploaded', reader.result);
        }
        // reader.readAsDataurl(file);
        if (reader.readAsDataURL) {reader.readAsDataURL(file);}
        else if (reader.readAsDataurl) {reader.readAsDataurl(file);}

    });


    window.livewire.on('id_card_chosen', () => {

        let inputField = document.getElementById("id_card");
        let file = inputField.files[0];
        let reader = new FileReader();
        // console.log(reader);
        reader.onloadend = () => {
            // console.log(reader.result);
            window.livewire.emit('id_card_uploaded', reader.result);
        }
        // reader.readAsDataurl(file);
        if (reader.readAsDataURL) {reader.readAsDataURL(file);}
        else if (reader.readAsDataurl) {reader.readAsDataurl(file);}

    });


</script>
@endsection
