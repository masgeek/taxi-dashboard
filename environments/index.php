<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'writable' => [
 *             // list of directories that should be set writable
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => 'dev',
        'writable' => [
            'backend/runtime',
            'backend/assets',
            'frontend/runtime',
            'frontend/assets',
            'frontend/images',
            'backend/images'
        ],
        'createSymlink' => [
            // link               =>   real folder
            'frontend/images' => 'common/images',
            'backend/images' => 'common/images',
        ],
        'executable' => [
            'yii',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'writable' => [
            'backend/runtime',
            'backend//assets',
            'frontend/runtime',
            'frontend/assets',
            'frontend/images',
            'backend/images'
        ],
        'executable' => [
            'yii',
        ],
    ],
];
