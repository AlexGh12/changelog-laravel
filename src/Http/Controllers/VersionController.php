<?php

namespace AlexGh12\ChangeLog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AlexGh12\ChangeLog\Models\ChangeLog;
use Illuminate\Support\Facades\Validator;
use AlexGh12\ChangeLog\Http\Requests\StoreChangesRequest;
use AlexGh12\ChangeLog\Http\Requests\UpdateChangesRequest;

class VersionController extends Controller
{
    public $string = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate magnam voluptates libero minima aliquam ab aspernatur distinctio. Quasi dignissimos, magni commodi accusantium dolor deleniti sapiente corporis repellat quae et eveniet, earum neque, dolore vel. In quis, molestiae recusandae blanditiis voluptas non sunt eius expedita itaque reiciendis hic aliquam iusto soluta animi laudantium incidunt exercitationem reprehenderit amet laborum sapiente alias ad. Dolores cum ut cumque laborum expedita voluptas, ad vero nulla, modi pariatur labore doloremque veritatis aperiam eum quod dicta doloribus impedit reiciendis consequatur tenetur quos minus, est non. Delectus sapiente natus labore esse iste, optio tempore! Saepe pariatur ullam quibusdam assumenda vero exercitationem tempora voluptas, nam expedita quo! Dolor error necessitatibus dolorem doloremque placeat obcaecati tempore provident eveniet, sunt ratione et repellendus expedita vitae accusantium laborum labore dicta ipsum aliquam impedit, suscipit libero. Ut aspernatur dolore voluptates placeat dolores adipisci dolor veniam asperiores possimus suscipit, doloremque provident cum corporis deleniti similique itaque unde, eaque, eum inventore nesciunt. Dignissimos tempora, magnam facilis aliquid voluptas porro culpa similique eum excepturi, error assumenda blanditiis suscipit iste ea itaque nulla laboriosam, labore cum perferendis? Enim non laudantium, beatae vero laboriosam eligendi maxime expedita quo? Velit numquam ipsam ipsum unde, iusto laboriosam, harum et eos ut culpa suscipit dolorem doloribus molestias facilis accusantium cupiditate aut doloremque nihil laudantium. Ex culpa, iure fuga aliquid iusto id sint consequuntur minus ullam porro nemo pariatur recusandae officia dignissimos explicabo eligendi neque provident enim, repudiandae quas suscipit! Unde doloremque adipisci quis impedit quibusdam perspiciatis dolorem rerum quos dolore, officiis modi, neque et officia hic. Id praesentium quos fuga exercitationem facere temporibus officiis natus enim modi voluptates quas vero consectetur, inventore, molestias asperiores nostrum? Iste eum expedita culpa corrupti laudantium repellat quasi tenetur aliquid, aut eos perspiciatis explicabo accusamus. Facilis cupiditate possimus ducimus voluptatem a nesciunt dolor labore sint. Soluta odit tempore dicta, eaque aliquam recusandae dignissimos totam ut enim corrupti nihil commodi saepe vero ipsum doloremque explicabo. Ad, officiis. Voluptates, non! Eveniet labore laboriosam error quasi ducimus tenetur temporibus accusantium ea. Harum, molestiae sequi tempora vitae magni sit tempore ea nisi quam non quas ad iusto delectus possimus enim voluptates error impedit! Consequatur aliquam incidunt alias saepe ipsam voluptatibus iure veniam eaque tenetur perspiciatis reprehenderit cum laboriosam, nisi quo dicta. Tenetur tempora temporibus dignissimos nostrum! In, dicta pariatur porro dignissimos non aliquid at architecto eligendi maxime illo ullam iste, dolorem commodi iusto enim, quam sint voluptas nostrum incidunt sequi!';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$data = ChangeLog::fetchAll();
        return redirect()->route('ChangeLog::index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
		return view('ChangeLog::create');
    }

    /**
     * Store a newly created resource in storage.
     */
  	public function store(StoreChangeRequest $request)
    {
		$data = $request->all();
        ChangeLog::storeNew($data);

		session()->flash('alert', [
        	'status'  => 'success',
        	'mensaje' => 'Commit agregado exitosamente!',
    	]);
        return redirect()->route('version.index');
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
        return view('ChangeLog::edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChangeRequest $request, $id)
    {
        $change = ChangeLog::findOrFail($id);
        $change->modify($request->all());

		session()->flash('alert', [
        	'status'  => 'success',
        	'mensaje' => 'Commit actualizado exitosamente!',
    	]);
        return redirect()->route('version.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ChangeLog::findOrFail($id);
		$data->remove();

		session()->flash('alert', [
			'status'  => 'success',
			'mensaje' => 'Commit eliminado exitosamente!',
			'console' => 'Sin problema'
   		]);
		return redirect()->route('version.index');
    }
}
