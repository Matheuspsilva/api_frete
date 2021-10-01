<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Frete;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class FreteController extends Controller
{

    private $frete;

    public function __construct(Frete $frete)
    {
        $this->frete = $frete;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fretes = $this->frete->all();

        return response()->json($fretes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $frete = $this->frete->create($data);

            return response()->json($frete);

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frete = $this->frete->find($id);
        return response()->json($frete);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $frete = $this->frete->find($id);
        $frete->update($data);


        return response()->json($frete);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frete = $this->frete->find($id);
        $frete->delete();

        return response()->json(['data' => ['msg' => 'O Frete foi removido com sucesso ']]);
    }
}
