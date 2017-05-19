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
        {!! Button::primary('Nova Categoria')->asLinkTo(route('admin.categories.create')) !!}
        <br><br>
        {!! Table::withContents($categories->items())->striped()->bordered()
            ->callback('Ações', function($field, $category){
                $linkEdit = route('admin.categories.edit', ['category' => $category->id]);
                $linkShow = route('admin.categories.show', ['category' => $category->id]);
                return Button::link(Icon::create('pencil'))->asLinkTo($linkEdit) . '|'.
                       Button::link(Icon::create('eye-open'))->asLinkTo($linkShow);
            })
        !!}
    </div>

    {!! $categories->links() !!}
</div>
@endsection
