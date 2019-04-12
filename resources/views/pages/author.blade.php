@extends('layouts/template')

@section('title')
Autor Nemanja
@endsection

@section('content')
    <div class="container">
        <div class="row" style="margin-top:100px; margin-bottom:150px;">
            <div class='col-sm-5'>
                <img src="{{asset('/')}}images/autor.jpg" style="height:400px; width:400px; border: 1px solid"/>
            </div>
            <div class='col-sm-4 mt-5'>
                <p>
                    Moje ime je Nemanja Radaković, rođenj sam 28.01.1995. Student sam Visoke skole strukovnih studija za informacione i komunikacione tehnologije
                    u Beogradu, gde sam trenutno na zavrsnoj godini studija. Ovaj projekat je radjen za predmet PHP 2.<br/><br/>
                    <b>e-mail:</b> nemanja.radakovic.25.14@ict.edu.rs<br/><br/>
                </p>
            </div>
        </div>
    </div>
@endsection