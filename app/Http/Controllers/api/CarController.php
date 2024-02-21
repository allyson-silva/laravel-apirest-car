<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\Car;
use App\Models\api\CarCategory;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    protected $messages = [
        'car_category_id.required' => 'O campo car_category_id é obrigatório.',
        'car_category_id.exists' => 'O car_category_id especificado não existe na tabela car_categories.',
        'name.unique' => 'O nome deve ser único quando não estiver excluído.'
    ];

    protected function getValidationRules($car = null)
    {
        return [
            'car_category_id' => ['required', 'exists:car_category,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('car')->whereNull('deleted_at')->ignore($car)
            ]
        ];
    }

    protected function getCarOrFail($id)
    {
        return Car::findOrFail($id);
    }

    public function create()
    {
        $car_category = CarCategory::whereNull('deleted_at')->get();
        return response()->json(compact('car_category'));
    }

    public function edit($id)
    {   
        $car = $this->getCarOrFail($id);
        $car_category = CarCategory::whereNull('deleted_at')->get();
        return response()->json(compact('car', 'car_category'));
    }

    public function index()
    {
        return Car::orderBy('created_at', 'desc')->wherenull('deleted_at')->paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules(), $this->messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Car::create($validator->validated());
        return response()->json(['message' => 'Car created successfully'], 201);
    }

    public function update(Request $request, Car $car)
    {
        $validator = Validator::make($request->all(), $this->getValidationRules($car), $this->messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $car->update($validator->validated());
        return response()->json(['message' => 'Car updated successfully'], 200);
    }

    public function show($id)
    {
        return $this->getCarOrFail($id);
    }

    public function destroy(string $id)
    {
        $car = $this->getCarOrFail($id);
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully'], 200);
    }
}
