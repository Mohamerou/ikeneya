@extends('layouts.admin.dash')

@section('content')
    @livewire('medical-card')
@endsection

@section('script')
<script>

    window.addEventListener('close-modal', event => {

        $('#medicalCardModal').modal('hide');
        $('#updateMedicalCardModal').modal('hide');
        $('#deleteMedicalCardModal').modal('hide');

    });



    </script>
@endsection
