@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        {!! Button::primary('Novo Usuário')->asLinkTo(route('admin.users.create')) !!}
        <br><br>
        {!! Table::withContents($users->items())->striped()->bordered()
            ->callback('Ações', function($field, $user){
                $linkEdit = route('admin.users.edit', ['user' => $user->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit);
            })
        !!}
    </div>

    {!! $users->links() !!}
</div>
@endsection
