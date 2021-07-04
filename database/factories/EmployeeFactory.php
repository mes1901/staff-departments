<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rateType = $this->faker->randomElement([
            Employee::TYPE_HOURLY_PAYMENT,
            Employee::TYPE_RATE
        ]);
        $amount = $this->faker->randomFloat(0,1000,2500);
        $workingHours = null;
        if ($rateType === Employee::TYPE_HOURLY_PAYMENT) {
            $amount = $this->faker->randomFloat(0,5,10);
            $workingHours = $this->faker->randomFloat(0,100,200);
        }
        return [
            'year' => $this->faker->year(),
            'month' => $this->faker->month,
            'full_name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'birthday' => $this->faker->date(),
            'department_id' => Department::all()->random()->id,
            'position' => $this->faker->randomElement([
                'PM',
                'Developer',
                'HR',
                'Team Lead'
            ]),
            'type' => $rateType,
            'amount' => $amount,
            'working_hours' => $workingHours
        ];
    }
}
