<?php

namespace AlexGh12\ChangeLog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AlexGh12\ChangeLog\Models\ChangeLog;
use Illuminate\Support\Facades\Validator;

class VersionController extends Controller
{
    public $string = 'Loremui!';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if( isset($request->alert) ) {

            switch ($request->alert) {
                case '1':
                    $status = 'éxito';
                    $mensaje = 'Se guardo version existosamente';
                break;
                case '2':
                    $status = 'éxito';
                    $mensaje = 'Se actualizo version existosamente';
                break;
                case '3':
                    $status = 'éxito';
                    $mensaje = 'Se elimino version existosamente';
                break;
            }
            session()->flash('alert', [
                'status'  => $status,
                'mensaje' => $mensaje,
            ]);
        }

        $data = ChangeLog::fetchAll();
        return view('ChangeLog::index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
		session()->exists('error') ? session()->forget('error') : null;
		return view('ChangeLog::create');
    }

    /**
     * Store a newly created resource in storage.
     */
  	public function store(Request $request)
    {
        $this->validateGroup();

		$validator = Validator::make($request->all(), [
            'version'     => 'required|string',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ],[
            'version.required'     => 'El campo versión es requerido.',
            'version.regex'        => 'El campo versión debe tener el formato "v.X" donde X es un número.',
            'title.required'       => 'El campo título es requerido.',
            'description.required' => 'El campo descripción es requerido.',
        ]);

        if($validator->fails()){
            $params['error'] = $validator->errors()->toArray();
            $params['old'] = $request->all();
            return view('ChangeLog::create',$params);
        }

		$data = $request->all();
        ChangeLog::storeNew($data);

        return redirect(route('version.index')."?alert=1");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$data = ChangeLog::fetchById($id);
        session()->exists('error') ? session()->forget('error') : null;
        return view('ChangeLog::edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validateGroup();

        $validator = Validator::make($request->all(), [
            'version'     => 'required|string',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ],[
            'version.required'     => 'El campo versión es requerido.',
            'version.regex'        => 'El campo versión debe tener el formato "v.X" donde X es un número.',
            'title.required'       => 'El campo título es requerido.',
            'description.required' => 'El campo descripción es requerido.',
        ]);

        if($validator->fails()){
            $data = ChangeLog::fetchById($id);
            $params['error'] = $validator->errors()->toArray();
            $params['old'] = $request->all();
            $params['data'] = $data;
            return view('ChangeLog::edit',$params);
        }

	    $change = ChangeLog::findOrFail($id);
        $change->modify($request->all());

        return redirect(route('version.index')."?alert=2");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ChangeLog::remove($id);

		session()->flash('alert', [
			'status'  => 'success',
			'mensaje' => 'Commit eliminado exitosamente!',
   		]);
        return redirect(route('version.index')."?alert=3");

    }

    private function validateGroup()
    {
        $archivo = base_path('database/changelog.sqlite');
        $grupo_nombre = posix_getgrgid(filegroup($archivo))['name'];

        if ( $grupo_nombre != 'www-data' ) {
            // Cambiamos el grupo del archivo
            try {
                if (!chgrp($archivo, 'www-data')) {
                    throw new \Exception("Fallo al cambiar el grupo.");
                }
            } catch (\Exception $e) {
                throw new \Exception("Ejecuta en raiz del proyecto: [ sudo chown :www-data database/changelog.sqlite ]");
            }
        }
    }
}
