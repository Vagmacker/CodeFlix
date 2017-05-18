@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="row">
            {!! Form::model(compact('search'),['class' => 'form-inline', 'method' => 'GET']) !!}
                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search', 'style' => 'width:93%']) !!}
                {!! Button::info('Search')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        {!! Button::primary('Novo Usuário')->asLinkTo(route('admin.users.create')) !!}
        <br><br>
        {!! Table::withContents($users->items())->striped()->bordered()
            ->callback('Ações', function($field, $user){
                $linkEdit = route('admin.users.edit', ['user' => $user->id]);
                $linkShow = route('admin.users.show', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit) . '|'.
                       Button::link(Icon::create('eye-open'))->asLinkTo($linkShow);
            })
        !!}
    </div>

    {!! $users->links() !!}
</div>
@endsection
