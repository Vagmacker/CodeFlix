@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar usuário</h3>
            {!!
                form($form->add('salve', 'submit', [
                    'attr' => ['class' => 'btn btn-primary btn-block'],
                    'label' => Icon::create('pencil')
                ]))
            !!}
            {!! Button::success(Icon::create('circle-arrow-left'))->block() !!}
        </div>
    </div>
@endsection
