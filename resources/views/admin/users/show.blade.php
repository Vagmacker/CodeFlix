@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Visualizar usuário</h3>
            {!! Button::primary(Icon::create('pencil'))->asLinkTo(route('admin.users.edit', ['user' => $user->id])) !!}
            {!! Button::danger(Icon::create('remove'))
                    ->asLinkTo(route('admin.users.destroy', ['user' => $user->id]))
                    ->addAttributes(['onclick' => "event.preventDefault();document.getElementById(\"form-delete\").submit()"])
            !!}
            <?php
                $formDelete = FormBuilder::plain([
                    'id' => 'form-delete',
                    'route' => ['admin.users.destroy', 'user' => $user->id],
                    'method' => 'DELETE',
                    'style' => 'display:none'
                ]);
            ?>
            {!! form($formDelete) !!}
            <br><br>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>{{$user->id}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nome</th>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de cadastro</th>
                        <td>{{date_format($user->created_at,'d-m-Y')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
