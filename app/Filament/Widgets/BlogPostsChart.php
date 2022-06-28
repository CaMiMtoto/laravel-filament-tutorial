<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use JetBrains\PhpStorm\ArrayShape;

class BlogPostsChart extends LineChartWidget
{
    public ?string $filter = 'today';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getHeading(): string
    {
        return 'Blog posts';
    }

    #[ArrayShape(['datasets' => "array[]", 'labels' => "string[]"])] protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
