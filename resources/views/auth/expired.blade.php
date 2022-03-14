@extends('_layout.form._template') 

@section('form')

<div class="back_to_web">
  <a href="{{ route('home') }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
    </svg>
  </a>
</div>

<div class="container">
  <div class="modal-container row g-0">
    <div class="verification-box">
      <div class="box-header">
        <h1 class="modal-title">{{ $title }}</h1>
      </div>
      <div class="item-content">
        <img src="img/web/expired.jpg" class="img-center">
        <p>Hi, email aktivasi anda tidak berlaku lagi. Email aktivasi hanya berlaku 1 jam dan hanya dapat digunakan sekali.</p>
      </div>
    </div>
  </div>
</div>

@endSection
