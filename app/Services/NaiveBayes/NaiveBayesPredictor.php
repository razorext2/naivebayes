<?php

namespace App\Services\NaiveBayes;

use App\Models\DataMining\ClassPrior;
use App\Models\DataMining\Likelihood;
use App\Models\DataMining\Model;
use App\Models\DataMining\Prediction;

class NaiveBayesPredictor
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function predict(array $input): array
    {
        $classPriors = ClassPrior::where('model_id', $this->model->id)->get();

        $results = [];

        foreach ($classPriors as $classPrior) {

            $score = $classPrior->probability;

            foreach ($input as $featureId => $value) {

                $likelihood = Likelihood::where([
                    'model_id' => $this->model->id,
                    'feature_id' => $featureId,
                    'class_label_id' => $classPrior->class_label_id,
                    'feature_value' => $value,
                ])->first();

                if ($likelihood) {
                    $score *= $likelihood->probability;
                } else {
                    // jika nilai belum pernah muncul
                    $score *= 1e-6;
                }
            }

            $results[$classPrior->class_label_id] = $score;
        }

        arsort($results);

        $predictedClassId = array_key_first($results);
        $probability = $results[$predictedClassId];

        Prediction::create([
            'model_id' => $this->model->id,
            'input_data' => $input,
            'predicted_class_id' => $predictedClassId,
            'probability' => $probability,
        ]);

        return [
            'class_id' => $predictedClassId,
            'scores' => $results,
        ];
    }
}
