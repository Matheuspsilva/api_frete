<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{

    private $veiculo;
    public function __construct(Veiculo $veiculo)
    {
        $this->veiculo = $veiculo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $veiculos = $this->veiculo->paginate('10');

        return response()->json($veiculos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        try {

            $veiculo = $this->veiculo->create($data);

            return response()->json(['data' => [
                'msg' => 'O Veículo foi cadastrado com sucesso '
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
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
        try {

            $veiculo= $this->veiculo->findOrFail($id);

            return response()->json([
                'data' => $veiculo
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
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

        try {

            $veiculo = $this->veiculo->findOrFail($id);
            $veiculo->update($data);

            return response()->json(['data' => [
                'msg' => 'O Veículo foi atualizado com sucesso '
                ]
            ], 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $veiculo = $this->veiculo->findOrFail($id);
            $veiculo->delete();

            return response()->json(['data' => [
                'msg' => 'O Veículo foi removido com sucesso ']
            ]
            , 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }
    }
}
