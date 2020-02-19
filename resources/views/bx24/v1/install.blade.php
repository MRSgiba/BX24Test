@extends('layouts.bx24.v1.app')

@if ($isInstalledSuccessfully)
    @section('scripts')
        <script src="{{ mix('js/bx24/v1/install.js') }}" defer></script>
    @endsection
@endif


