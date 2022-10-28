@extends('layouts.admin.dash')

@section('content')
    @livewire('hospital')
@endsection

@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#hospitalModal').modal('hide');
        $('#updateHospitalModal').modal('hide');
        $('#deleteHospitalModal').modal('hide');

    });

    // window.addEventListener('show-editModal', event => {

    //     $('#updateHospitalModal').modal('show');

    // });


    </script>
@endsection
