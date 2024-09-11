<?php
return [
    'module' => [
        [
            'user_role' => [],
            'title' => 'Báo Cáo',
            'icon' => 'fa fa-chart-line',
            'route' => ['system.index'],
            'subModule' => [
                [
                    'title' => 'Báo Cáo',
                    'route' => 'report.index',
                    'icon' => 'fa fa-flag',
                    'user_role' => []
                ],
            ]
        ],
        [
            'user_role' => [],
            'title' => 'Thông Báo',
            'icon' => 'fa fa-bell',
            'route' => ['notification.index'],
            'subModule' => [
                [
                    'title' => 'Danh Sách Thông Báo',
                    'route' => 'notification.index',
                    'icon' => 'fa fa-bell',
                    'user_role' => []
                ],
            ]
        ],
    ]
];
