<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\FreteRequest;
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
        $fretes = $this->frete->paginate('10');

        return response()->json($fretes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FreteRequest $request)
    {
        $data = $request->all();

        try {

            $frete = $this->frete->create($data);

            return response()->json(['data' => [
                'msg' => 'O Frete foi cadastrado com sucesso '
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

            $frete = $this->frete->findOrFail($id);

            return response()->json([
                'data' => $frete
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

            $frete = $this->frete->findOrFail($id);
            $frete->update($data);

            return response()->json(['data' => [
                'msg' => 'O Frete foi atualizado com sucesso '
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

            $frete = $this->frete->findOrFail($id);
            $frete->delete();

            return response()->json(['data' => [
                'msg' => 'O Frete foi removido com sucesso ']
            ]
            , 200);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
		    return response()->json($message->getMessage(), 401);
        }

    }
}
