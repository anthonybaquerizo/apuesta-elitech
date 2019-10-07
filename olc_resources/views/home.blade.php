@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="app" >
                <app></app>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
