@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel">
                <h1 class="text-center">Alterar senha</h1>
                <div class="panel-body">
                    <div class="panel-content">
                        {!!
                            form($form->add('Alterar minha senha', 'submit',[
                                'attr' => ['class' => 'btn btn-primary', 'title'=>'Alterar minha senha'],
                                'label' => 'Alterar '
                            ]))
                        !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection