@extends('layouts.login')

@section('content')
    
    <app-component
    	:auth="'{{ $authHeader }}'"
    	:ip="'{{ $ip }}'"
    >
    </app-component>
    
@endsection