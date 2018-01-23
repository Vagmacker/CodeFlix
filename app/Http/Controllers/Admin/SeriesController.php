<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\SerieForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Models\Serie;
use CodeFlix\Repositories\SerieRepository;
use Illuminate\Database\Eloquent\Model;

class SeriesController extends Controller
{
    /**
     * @var SerieRepository
     */
    private $repository;

    /**
     * SeriesController constructor.
     * @param SerieRepository $repository
     */
    public function __construct(SerieRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = $this->repository->paginate();
        return view('admin.series.index', compact('series'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route('admin.series.store'),
            'method' => 'POST'
        ]);

        return view('admin.series.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $form = \FormBuilder::create(SerieForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();

        $data['thumb'] = 'thumb.jpg';
        Model::unguard();
        $this->repository->create($data);

        session()->flash('message', 'Série criada com sucesso.');
        return redirect()->route('admin.series.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Serie $series
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $series)
    {
        return view('admin.series.show', compact('series'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Serie $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series)
    {
        $form = \FormBuilder::create(SerieForm::class, [
            'url' => route( 'admin.series.update', ['serie' => $series->id]),
            'method' => 'PUT',
            'model' => $series,
            'data' => ['id' => $series->id]
        ]);

        return view('admin.series.edit', compact('form'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param Serie $serie
     */
    public function update($id)
    {
        $form = \FormBuilder::create(SerieForm::class,[
            'data' => ['id' => $id]
        ]);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = array_except($form->getFieldValues(),'thumb');
        $this->repository->update($data, $id);

        session()->flash('message', 'Série alterada com sucesso.');
        return redirect()->route('admin.series.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Serie $serie
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        session()->flash('message', 'Série excluída com sucesso.');
        return redirect()->route('admin.series.index');
    }

    /**
     * @param Serie $series
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function thumbAsset(Serie $series)
    {
        return response()->download($series->thumb_path);
    }

    /**
     * @param Serie $series
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function thumbSmallAsset(Serie $series)
    {
        return response()->download($series->thumb_small_path);
    }
}