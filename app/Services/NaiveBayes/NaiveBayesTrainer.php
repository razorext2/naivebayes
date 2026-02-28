<?php

namespace App\Services\NaiveBayes;

use App\Models\DataMining\ClassPrior;
use App\Models\DataMining\Dataset;
use App\Models\DataMining\Likelihood;
use App\Models\DataMining\Model;
use Illuminate\Support\Facades\DB;

class NaiveBayesTrainer
{
    protected Model $model;

    protected Dataset $dataset;

    public function __construct(Model $model, Dataset $dataset)
    {
        $this->model = $model;
        $this->dataset = $dataset;
    }

    public function train(): void
    {
        DB::transaction(function () {

            $this->calculateClassPriors();
            $this->calculateLikelihoods();

        });
    }

    protected function calculateClassPriors(): void
    {
        ClassPrior::where('model_id', $this->model->id)->delete();

        $totalRecords = $this->dataset->records()->count();

        $classCounts = $this->dataset->records()
            ->selectRaw('class_label_id, COUNT(*) as total')
            ->groupBy('class_label_id')
            ->get();

        foreach ($classCounts as $row) {

            ClassPrior::create([
                'model_id' => $this->model->id,
                'class_label_id' => $row->class_label_id,
                'total_count' => $row->total,
                'probability' => $row->total / $totalRecords,
            ]);
        }
    }

    protected function calculateLikelihoods(): void
    {
        Likelihood::where('model_id', $this->model->id)->delete();

        $features = $this->model->features;
        $classPriors = ClassPrior::where('model_id', $this->model->id)->get();

        foreach ($features as $feature) {

            // ambil semua nilai unik fitur (untuk k)
            $uniqueValues = DB::table('feature_values')
                ->where('feature_id', $feature->id)
                ->distinct()
                ->pluck('value');

            $k = $uniqueValues->count();

            foreach ($classPriors as $classPrior) {

                $classCount = $classPrior->total_count;

                foreach ($uniqueValues as $value) {

                    $count = DB::table('feature_values')
                        ->join('dataset_records', 'feature_values.dataset_record_id', '=', 'dataset_records.id')
                        ->where('dataset_records.class_label_id', $classPrior->class_label_id)
                        ->where('feature_values.feature_id', $feature->id)
                        ->where('feature_values.value', $value)
                        ->count();

                    // Laplace smoothing
                    $probability = ($count + 1) / ($classCount + $k);

                    Likelihood::create([
                        'model_id' => $this->model->id,
                        'feature_id' => $feature->id,
                        'class_label_id' => $classPrior->class_label_id,
                        'feature_value' => $value,
                        'total_count' => $count,
                        'probability' => $probability,
                    ]);
                }
            }
        }
    }
}
